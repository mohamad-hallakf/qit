<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

use Illuminate\Routing\Controller;
use App\Models\Chart;
use DataTables;
use phpDocumentor\Reflection\Types\Float_;

class ChartController extends Controller
{

    public function __construct()
    {
        //  model name
        $this->model_name = 'Chart';
    }
    public  $perfectValus = [["x" => 3.3, "y" => 49.8], ["x" => 4.4, "y" => 54.4], ["x" => 5.6, "y" => 58.8], ["x" => 6.4, "y" => 61.4], ["x" => 7, "y" => 64], ["x" => 7.5, "y" => 66], ["x" => 7.9, "y" => 67.5], ["x" => 8.3, "y" => 69], ["x" => 8.6, "y" => 70.6], ["x" => 8.9, "y" => 71.8], ["x" => 9.1, "y" => 73.1], ["x" => 9.4, "y" => 74.4]];

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $model_name = $this->model_name;


        $columnArray = ['height', 'weight'];
        if ($request->ajax()) {
            $data = Chart::latest();


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

        $count = Chart::where('childid', $request->childid)->count('*');

        if ($count < 12) {

            $chart = new Chart;
            $chart->height = $request->height;
            $chart->weight = $request->weight;
            $chart->childid = $request->childid;
            $chart->weightEval =  $this->weightEvaluation($request->weight, $count);
            $chart->heightEval =  $this->heightEvaluation($request->height, $count);
            $chart->save();
        }
        return redirect()->route('Chart.child', $request->childid);
    }

    public function weightEvaluation($eval, $count)
    {
        $eval = (float) $eval;
        $compareValue = $this->perfectValus[$count]['x'];
        if ($count == 0) {
            $compareNextValue = $this->perfectValus[$count + 1]['x'];
            if (($compareValue - 1) <= $eval && $eval <= $compareNextValue)
                return "وزن جيد";
            elseif ($eval > $compareNextValue)
                return "وزن زائد";
            else
                return "وزن منخفض";
        } elseif ($count == 11) {

            $comparePreviousValue = $this->perfectValus[$count - 1]['x'];
            if (($compareValue + 1) >= $eval && $eval >= $comparePreviousValue)
                return "وزن جيد";
            elseif ($eval < $comparePreviousValue)
                return "وزن منخفض";
            else
                return "وزن زائد";
        } else {
            $compareNextValue = $this->perfectValus[$count + 1]['x'];
            $comparePreviousValue = $this->perfectValus[$count - 1]['x'];
            if ($compareNextValue >= $eval && $eval >= $comparePreviousValue)
                return "وزن جيد";
            elseif ($eval < $comparePreviousValue)
                return "وزن منخفض";
            else
                return "وزن زائد";
        }
    }

    public function heightEvaluation($eval, $count)
    {
        $eval = (float) $eval;
        $compareValue = $this->perfectValus[$count]['y'];
        if ($count == 0) {
            $compareNextValue = $this->perfectValus[$count + 1]['y'];
            if (($compareValue - 10) <= $eval && $eval <= $compareNextValue)
                return "طول جيد";
            elseif ($eval > $compareNextValue)
                return "طول زائد";
            else
                return "طول منخفض";
        } elseif ($count == 11) {

            $comparePreviousValue = $this->perfectValus[$count - 1]['y'];
            if (($compareValue + 10) >= $eval && $eval >= $comparePreviousValue)
                return "طول جيد";
            elseif ($eval < $comparePreviousValue)
                return "طول منخفض";
            else
                return "طول زائد";
        } else {
            $compareNextValue = $this->perfectValus[$count + 1]['y'];
            $comparePreviousValue = $this->perfectValus[$count - 1]['y'];
            if ($compareNextValue >= $eval && $eval >= $comparePreviousValue)
                return "طول جيد";
            elseif ($eval < $comparePreviousValue)
                return "طول منخفض";
            else
                return "طول زائد";
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function child(Request $request, $id)
    {
        $count = Chart::where('childid', $id)->count('*');
        $data = Chart::where('childid', $id)->get();

        return view("chart.chart", compact('id', 'data', 'count'));
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
    }
}
