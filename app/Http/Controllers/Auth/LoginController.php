<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //Login view
    public function Login()
    {
        if (Auth::check() == false) {
            return view('auth.user-signin');
        } else {
            return redirect('dashboard');
        }
    }

    public function UserLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            return redirect()->intended(route('dashboard'))->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid.');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('index');
        }
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }



    public function getUsers(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'refferal_code',
            5 => 'action'
        );

        $totalDataRecord = User::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $User_data = User::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $User_data =  User::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('title', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();

            $totalFilteredRecord = User::where('name', 'LIKE', "%{$search_text}%")
                ->orWhere('title', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = array();
        if (!empty($User_data)) {
            foreach ($User_data as $user_val) {
                $datashow =  route('Users_table.show', $user_val->id);
                $dataedit =  route('Users_table.edit', $user_val->id);

                $UsernestedData['id'] = $user_val->id;
                $UsernestedData['name'] = $user_val->name;
                $UsernestedData['email'] = $user_val->email;
                $UsernestedData['phone'] = $user_val->phone;
                $UsernestedData['refferal_code'] = $user_val->refferal_code;
                $UsernestedData['action'] = "&emsp;<a href='{$datashow}'class='showdata' title='SHOW DATA' ><span class='showdata glyphicon glyphicon-list'></span></a>&emsp;<a href='{$dataedit}' class='editdata' title='EDIT DATA' ><span class='editdata glyphicon glyphicon-edit'></span></a>";
                $data_val[] = $UsernestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );

        echo json_encode($get_json_data);
    }
}
