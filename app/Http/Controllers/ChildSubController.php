<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DataTables;
use App\Models\ChildSub;


class ChildSubController extends Controller
{
 /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        //  model name
        $this->model_name = 'ChildSub';
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $model_name = $this->model_name;


        $columnArray = ['child','parent','service', 'subscription' ];
        if ($request->ajax()) {
            $data =DB::select('select child_subs.id as id, children.name as child ,users.name as parent,services.name as service ,subscriptions.name as subscription  from child_subs join children on children.id = child_subs.childid join services on  services.id = child_subs.serviceid join subscriptions on  subscriptions.id = child_subs.subscriptionid  join users on  children.userid = users.id');


            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '

                       <a href="#" data-id="' . $row->id . '"
                       class="btn btn-danger   delete" data-toggle="modal" title="حذف الخدمة" data-target="#removemodal"><i class="fa fa-trash"></i></a>

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
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

            $childSub = new ChildSub;
            $childSub->childid = $request->childid;
            $childSub->subscriptionid = $request->subid;
            $childSub->serviceid = $request->serviceid;

           $childSub->save();
            return  back();

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $childSub = ChildSub::find($request->id);

        $save = $childSub->save();
        echo json_encode(array('response' => $save, 'data' => $childSub));
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
        $childSub = ChildSub::find($request->id);
        $save = $childSub->save();
        echo json_encode(array('response' => $save, 'data' => $childSub));
        die();
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $childSub = ChildSub::find($request->id);
        $save = $childSub->delete();
        echo json_encode(array('response' => $save, 'data' => $childSub));
        die();
    }
}
