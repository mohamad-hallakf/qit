<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Questions;
use App\Models\User;
use App\Models\Answers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $columnArray = ['content', 'status', "privacy",'common'];

        if ($request->ajax()) {
            $data = Questions::latest()->get();
            foreach($data as $q){
               if($q->common) $q->common="شائع";
               else $q->common="غير شائع";

               if($q->status) $q->status="معلق";
               else $q->status="مقبول";
            }

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                           <a  href="#" class="btn  btn-info edit" title="edit question " data-id="' . $row->id . '"  data-toggle="modal" data-target="#editmodal"  >
                               <i class="fas fa-wrench" ></i>
                           </a>
                           <a href="#" data-id="' . $row->id . '"
                           class="btn btn-danger   delete" data-toggle="modal" title="' . __('clients.delete') . '" data-target="#removemodal"><i class="fa fa-trash"></i></a>
                           <a href="#" data-id="' . $row->id . '"
                           class="btn btn-success   accept" data-toggle="modal" title="' . __('clients.add') . '" data-target=""><i class="fa fa-check"></i></a>

                        ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("$model_name.index", compact('model_name', "columnArray"));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function accept(Request $request)
    {

        $question = Questions::find($request->id);
        $question->status=0;
        $question->save();
        echo json_encode(array('response' => true, 'data' => $question));
        die();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $question = new Questions;
        $question->content = $request->content;
        $question->privacy = $request->privacy;
        $question->userid = Auth::id();
        if ($request->file('image')) {
            $path = $request->file('image')->store('images', ['disk' => 'public']);
            $question->image = $path;
        }

        $question->save();

        return redirect()->route('question.questions');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function answer(Request $request)
    {

        $answer=new Answers;
        $answer->questionid=$request->questionid;
        $answer->content=$request->answer;
        $answer->answerby=Auth::id();
        $answer->save();
        $question = Questions::find($answer->questionid);
        $doctor=User::find($answer->answerby);
        $user=User::find($question->userid);

        $arr['dname']= $doctor->name;
        $arr['uname']= $user->name;
        $arr['qcontent']= $question->content;
        $arr['acontent']=$answer->content;
        $user->notify(new NewAnswer($arr));

        return redirect()->route('question.questions');
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

        $question = Questions::find($request->id);
        $question->common = $request->common;
        $save = $question->save();
        echo json_encode(array('response' => $save, 'data' => $question));
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


    public function questions(Request $request)
    {
        $model_name = $this->model_name;
        $questions = Questions::latest()->with('answers','user')->get();
        return view("$model_name.questions", compact('questions'));
    }
}
