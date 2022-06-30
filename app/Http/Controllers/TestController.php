<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use App\Models\Questions;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\TestApplied;
use App\Notifications\NewAnswer;
class TestController extends Controller
{

    public function __construct()
    {
        //  model name
        $this->model_name = 'test';
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $model_name = $this->model_name;
        $columnArray = ['name'];
        if ($request->ajax()) {
            $data = Test::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                           <a  href="#" class="btn  btn-info edit" title="show " data-id="' . $row->id . '"  data-toggle="modal" data-target="#editmodal"  >
                               <i class="fas fa-eye" ></i>
                           </a>
                           <a href="#" data-id="' . $row->id . '"
                           class="btn btn-danger   delete" data-toggle="modal" title="delete" data-target="#removemodal"><i class="fa fa-trash"></i></a>

                        ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("$model_name.index", compact('model_name', "columnArray"));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {


        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:25'],
            'questions' => ['required'],

        ]);

        if ($validate->fails()) {
            echo json_encode(array('response' => false, 'message' => $validate->errors()));
            die();
        }

        $test = new Test;
        $test->name = $request->name;
        try {
            $save = $test->save();

            $questions = $request->questions;
            for ($i = 0; $i < sizeOf($questions); $i++) {
                $test->questions()->attach($questions[$i]);
            }
        } catch (QueryException $e) {
            return response()->json(array('response' => false, 'errors' => $e->getMessage()));
        };
        echo json_encode(array('response' => $save));
        die();
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id getSubscription
     * @return Renderable
     */
    public function show(Request $request)
    {
        $test = Test::with('questions')->find($request->id);
        echo json_encode(array('response' => true, 'data' => $test));
        die();
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $test = Test::find($request->id);
        $test->questions()->detach();
        $delete = $test->delete();
        echo json_encode(array('response' => $delete, 'data' => $test));
        die();
    }


    public function getQuestion()
    {
        $question = Questions::get();
        echo json_encode(array('response' => !empty($question), 'data' => $question));
        die();
    }


    public function apply($id)
    {
        $test = Test::with('questions')->find($id);

        return view('test.test', compact('test'));
    }

    public function applyTest(Request $request)
    {
        $data = $request->except('testID');

        $correctCounter = 0;
        foreach ($data as $key => $value) {
            $str = explode("-", $key);
            $questionID = $str[1];
            $question = Questions::find($questionID);
            if ($question->right == $value)  $correctCounter++;
        }
        // $NRQ number of right question
        $test = Test::with('questions')->find($request->testID);
        $NRQ = $correctCounter / sizeof($test->questions);
        $wrongAns = sizeof($test->questions) - $correctCounter;
        $user = Auth::user();
        $admin=User::first();
        $arr['test']=$test->name;
        $arr['date']= Carbon::now();
        $arr['user'] =$user->name;
        $admin->notify(new TestApplied($arr));
        $arr['mark'] = $NRQ * 100;
        $user->notify(new NewAnswer($arr));
        if ($NRQ > 0.5) {
            $user->tests()->attach($test->id, ['mark' => $NRQ * 100, 'date' => Carbon::now(), 'result' => 'success']);
            echo json_encode(array('response' => true, 'data' => ['result' => 'success', 'wrongAns' => $wrongAns]));
            die();
        } else {
            $user->tests()->attach($test->id, ['mark' => $NRQ * 100, 'date' => Carbon::now(), 'result' => 'fail']);

            echo json_encode(array('response' => true, 'data' => ['result' => 'fail', 'wrongAns' => $wrongAns]));
            die();
        }
        return view('test.test', compact('test'));
    }
}
