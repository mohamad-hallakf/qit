<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Questions;
use App\Models\User;
use App\Models\Answers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Notifications\NewAnswer;
class QuestionsController extends Controller
{

    public function __construct()
    {
        //  model name
        $this->model_name = 'question';
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {


        $model_name = $this->model_name;

        $columnArray = ['content', 'right'];

        if ($request->ajax()) {
            $data = Questions::latest()->get();


            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                                <a  href="#" class="btn  btn-info edit" title="edit " data-id="' . $row->id . '"  data-toggle="modal" data-target="#editmodal"  >
                               <i class="fas fa-wrench" ></i>
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
            'content' => ['required', 'string', 'max:255'],
            'right' => ['required', 'string', 'max:255'],
            'wrong1' => ['required', 'string', 'max:255'],
            'wrong2' => ['required', 'string', 'max:255'],
            'wrong3' => ['required', 'string', 'max:255'],
        ]);

        if ($validate->fails()) {
            echo json_encode(array('response' => false, 'message' => $validate->errors()));
            die();
        }

        $user = new Questions;
        $user->content = $request->content;
        $user->right = $request->right;
        $user->wrong1 = $request->wrong1;
        $user->wrong2 = $request->wrong2;
        $user->wrong3 = $request->wrong3;
         $save = $user->save();

        echo json_encode(array('response' => $save));
        die();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $question = Questions::find($request->id);

        echo json_encode(array('response' => true, 'data' => $question));
        die();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'content' => ['required', 'string', 'max:255'],
            'right' => ['required', 'string', 'max:255'],
            'wrong1' => ['required', 'string', 'max:255'],
            'wrong2' => ['required', 'string', 'max:255'],
            'wrong3' => ['required', 'string', 'max:255'],
        ]);


        if ($validate->fails()) {
            echo json_encode(array('response' => false, 'message' => $validate->errors()));
            die();
        }
        $user = Questions::find($request->id);
        $user->content = $request->content;
        $user->right = $request->right;
        $user->wrong1 = $request->wrong1;
        $user->wrong2 = $request->wrong2;
        $user->wrong3 = $request->wrong3;
        $save = $user->save();
        echo json_encode(array('response' => $save));
        die();

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $question = Questions::find($request->id);
        $delete = $question->delete();
        echo json_encode(array('response' => $delete, 'data' => $question));
        die();
    }



}
