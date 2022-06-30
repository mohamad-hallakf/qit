<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userTest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    public function __construct()
    {
        //  model name
        $this->model_name = 'user';
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $model_name = $this->model_name;
        $columnArray = ['name', 'email', "username"];
        if ($request->ajax()) {
            $data = User::where('id', '<>', auth()->id())->latest()->get();
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
    public function marks(Request $request)
    {

         $model_name = $this->model_name;
        $columnArray = ['student', 'test', "result", "mark","date"];
        if ($request->ajax()) {
            $data = DB::table('users')
                ->join('user_tests', 'users.id', '=', 'user_tests.user_id')
                ->join('tests', 'tests.id', '=', 'user_tests.test_id')
                ->select('user_tests.id', 'users.name as student', 'tests.name as test', 'user_tests.result', 'user_tests.mark', 'user_tests.date')
                ->get();
            return Datatables::of($data)
                ->make(true);
        }
        return view("$model_name.marks", compact('model_name', "columnArray"));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        if ($validate->fails()) {
            echo json_encode(array('response' => false, 'message'=> $validate->errors()));
            die();
         }

        $user = new User;
        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        echo json_encode(array('response' => $save));
        die();
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id getSubscription
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        echo json_encode(array('response' => true, 'data' => $user));
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
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
         ]);

        if ($validate->fails()) {
            echo json_encode(array('response' => false, 'message' => $validate->errors()));
            die();
        }
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
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
        $user = User::find($request->id);
        $delete = $user->delete();
        echo json_encode(array('response' => $delete, 'data' => $user));
        die();
    }


}
