<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DataTables;
use App\Models\Subscription;
use App\Models\Service_Subscription;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        //  model name
        $this->model_name = 'Subscription';

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $model_name = $this->model_name;

        $columnArray=['name'];
        if ($request->ajax()) {
            $data = Subscription::latest();


            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = ' <a  href="#" class="btn  btn-info edit" title="edit subscripe " data-id="'.$row->id.'"  data-toggle="modal" data-target="#editmodal"  >
                               <i class="fas fa-wrench" ></i>
                           </a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

       return view("$model_name.index",compact( 'model_name',"columnArray"));
    }




    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $subscripe = new Subscription;
            $subscripe->name=$request->name;

            $save = $subscripe->save();
            echo json_encode(array('response' => $save, 'data' => $subscripe));
            die();
        }
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
     * @param int $id subsType
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $subscripe =Subscription::find($request->id);
        $save = $subscripe->save();
        echo json_encode(array('response'=>$save, 'data'=>$subscripe));
        die();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function subsType(Request $request)
    {

        $subscriptions=DB::table('subscriptions')->join('service_subscriptions','subscriptions.id','service_subscriptions.subscriptionid')->join('services','service_subscriptions.serviceid','services.id')->where('services.id',$request->id)->select("subscriptions.id","subscriptions.name","service_subscriptions.price")->distinct()->get();

        echo json_encode(array('response'=>true, 'data'=>$subscriptions));
        die();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request )
    {
        $subscripe = Subscription::find($request->id);


        $subscripe->name=$request->name;
        $save = $subscripe->save();
        echo json_encode(array('response'=>$save, 'data'=>$subscripe));
        die();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request )
    {
        $subscripe = Subscription::find($request->id);
        $delete = $subscripe->delete();
        echo json_encode(array('response'=>$delete, 'data'=>$subscripe));
        die();
    }
}
