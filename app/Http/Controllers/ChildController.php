<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Child;
use App\Models\Child_Disease;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function __construct()
    {
        //  model name
        $this->model_name = 'child';
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {


        $model_name = $this->model_name;

        $columnArray = ['name', 'type', "description"];

        if ($request->ajax()) {
            $data = Child::latest()->get();


            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                           <a  href="#" class="btn  btn-info edit" title="edit child " data-id="' . $row->id . '"  data-toggle="modal" data-target="#editmodal"  >
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

        $child = new Child;
        $child->name = $request->name;
        $child->userid = Auth::id();
        $child->dateofbirth = $request->dateofbirth;
        $path = $request->file('image')->store('images', ['disk' => 'public']);
        $child->image = $path;
        $save = $child->save();
        if ($request->autism) {
            $cd = new Child_Disease;
            $cd->childid = $child->id;
            $cd->diseaseid = $request->autism;
        }
        if ($request->autism) {
            $cd = new Child_Disease;
            $cd->childid = $child->id;
            $cd->diseaseid = $request->autism;
        }
        if ($request->down) {
            $cd = new Child_Disease;
            $cd->childid = $child->id;
            $cd->diseaseid = $request->down;
        }

        return redirect()->route('child.mychildren');
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
        $child = Child::find($request->id);

        echo json_encode(array('response' => true, 'data' => $child));
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
        $child = Child::find($request->id);
        $child->name = $request->name;

        $child->type = $request->type;
        $path = $request->file('image')->store('images');
        $child->image = $path;
        $save = $child->save();
        echo json_encode(array('response' => $save, 'data' => $child));
        die();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $child = Child::find($request->id);
        $delete = $child->delete();
        echo json_encode(array('response' => $delete, 'data' => $child));
        die();
    }


    public function mychildren()
    {


        $model_name = $this->model_name;

        $id = Auth::id();
        $children = Child::where('userid', $id)->get();

        return view("$model_name.mychildren", compact('children'));
    }
}
