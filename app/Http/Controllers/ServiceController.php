<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\Service_Subscription;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{


    public function __construct()
    {
        //  model name
        $this->model_name = 'service';
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
            $data = Service::latest()->get();


            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                           <a  href="#" class="btn  btn-info edit" title="edit service " data-id="' . $row->id . '"  data-toggle="modal" data-target="#editmodal"  >
                               <i class="fas fa-wrench" ></i>
                           </a>
                           <a href="#" data-id="' . $row->id . '"
                           class="btn btn-danger   delete" data-toggle="modal" title="حذف الخدمة" data-target="#removemodal"><i class="fa fa-trash"></i></a>
                           <a href="#" data-id="' . $row->id . '"
                           class="btn btn-primary   link" data-toggle="modal" title="ربط مع الاشتراكات" data-target="#linkmodal"><i class="fa fa-link"></i></a>

                        ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $subscriptions = Subscription::all();
        return view("$model_name.index", compact('model_name', "columnArray", "subscriptions"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function linkSub(Request $request)
    {
        $subscriptions = $request->sub;
        $prices = $request->price;
        $serviceid = $request->id;
        for ($i=0 ; $i<sizeof($prices);$i++) {
            if(isset($subscriptions[$i]) && !is_null($prices[$i])){
            $s_s = new Service_Subscription;
            $s_s->subscriptionid=$subscriptions[$i];
            $s_s->price=$prices[$i];
            $s_s->serviceid=$serviceid;
             $s_s->save();
            }
        }
        echo json_encode(array('response' => true, 'data' => ''));
        die();
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


        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->type = $request->type;
        $service->link = 'http://127.0.0.1:8000/question/questions';
        $path = $request->file('image')->store('images', ['disk' => 'public']);
        $service->image = $path;
        $service->save();

        return redirect()->route('service.index');
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
     * @param int $id getSubscription
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $service = Service::find($request->id);

        echo json_encode(array('response' => true, 'data' => $service));
        die();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function getSubscription(Request $request)
    {
        $subscriptions=DB::table('subscriptions')->join('service_subscriptions','subscriptions.id','service_subscriptions.subscriptionid')->join('services','service_subscriptions.serviceid','services.id')->select("subscriptions.id","subscriptions.name")->get();
        dd($subscriptions);
        echo json_encode(array('response' => true, 'data' => $subscriptions));
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
        $service = Service::find($request->id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->type = $request->type;
        $path = $request->file('image')->store('images');
        $service->image = $path;
        $save = $service->save();
        echo json_encode(array('response' => $save, 'data' => $service));
        die();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $service = Service::find($request->id);
        $delete = $service->delete();
        echo json_encode(array('response' => $delete, 'data' => $service));
        die();
    }
}
