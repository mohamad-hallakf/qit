<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Payment;
use DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {


        //  model name
        $this->model_name = 'Payment';
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $model_name = $this->model_name;


        $columnArray = ['type','amount', 'paydate', 'notes'];
        if ($request->ajax()) {
            $data = Payment::latest();


            return Datatables::of($data)
                ->addIndexColumn()
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
        if ($request->ajax()) {
            $payment = new Payment;
            $payment->amount = $request->amount;
            $payment->paydate = $request->paydate;
            $payment->notes = $request->notes;
            $payment->type = $request->type;
            $save = $payment->save();
            echo json_encode(array('response' => $save, 'data' => $payment));
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
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $payment = Payment::find($request->id);

        $save = $payment->save();
        echo json_encode(array('response' => $save, 'data' => $payment));
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
        $payment = Payment::find($request->id);
        $payment->notes = $request->notes;

        $save = $payment->save();
        echo json_encode(array('response' => $save, 'data' => $payment));
        die();
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        $payment = Payment::find($request->id);
        $date =  date('Y-m-d');
        $payment->paydate = $date;

        $save = $payment->save();
        echo json_encode(array('response' => $save, 'data' => $payment));
        die();
    }
}
