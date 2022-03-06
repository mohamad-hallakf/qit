<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Questions;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

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

        $columnArray = ['name','type',"description" ];

        if ($request->ajax()) {
            $data = Questions::latest()->get();


            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                           <a  href="#" class="btn  btn-info edit" title="edit question " data-id="' . $row->id . '"  data-toggle="modal" data-target="#editmodal"  >
                               <i class="fas fa-wrench" ></i>
                           </a>
                           <a href="#" data-id="' . $row->id . '"
                           class="btn btn-danger   delete" data-toggle="modal" title="' . __('clients.delete') . '" data-target="#removemodal"><i class="fa fa-trash"></i></a>

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
    public function create()
    {
        return view('clients::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

                $request->validate([
                    'name' => 'required|max:15',
                ]);
            $question = new Questions;
            $question->name = $request->name;
            $question->description = $request->description;
            $question->type = $request->type;
            $path = $request->file('image')->store('images', ['disk' => 'public']);
            $question->image = $path;
             $question->save();

            return redirect()->route('question.index');


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
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
        $question->name = $request->name;
        $question->description = $request->description;
        $question->type = $request->type;
        $path = $request->file('image')->store('images');
        $question->image = $path;
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
}
