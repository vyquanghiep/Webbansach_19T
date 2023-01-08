<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
session_start();

class UsersController extends Controller
{   

    public function show_all_users() {
        return view('admin.AllUsers');
    }
    public function get_all_users() {
        $list_users = User::get_all();
        $i = 1;
        foreach($list_users as $key=> $user) {
            $output =  '   <tr> 
            <!-- tên user -->
            <td>
            '.$i++.'
            </td> 

            <!-- tên user -->
            <td>
            '.$user->fullname.'
            </td> 

            <!-- Số điện thoại -->
            <td>
            '.$user->phone.'
            </td>

            <!-- Email -->
            <td>
            '.$user->email.'
            </td>';

            if($user->male == 1)
                $output .= '<td>Nam</td>';
            else
                $output .= '<td>Nữ</td>';  

            $output .=  '<td>
                            '.$user->address.'
                         </td>';

            if($user->isadmin == 1)
                $output .= '<td><input data-user_name="'.$user->fullname.'" checked class="isadmin" type="checkbox" name="isadmin" data-user_id="'.$user->userid.'"></td>';
            else
                $output .= '<td><input data-user_name="'.$user->fullname.'" class="isadmin" type="checkbox" name="isadmin" data-user_id="'.$user->userid.'"></td>';

            if($user->isdisable == 1)
                $output .= '<td><input data-user_name="'.$user->fullname.'" checked class="isdisable" type="checkbox" name="isdisable" data-user_id="'.$user->userid.'"></td>';
            else
                $output .= '<td><input data-user_name="'.$user->fullname.'" class="isdisable" type="checkbox" name="isdisable" data-user_id="'.$user->userid.'"></td>';
            $output .= '<td>
                            <button data-user_id="'.$user->userid.'" data-user_name="'.$user->fullname.'" class="btn btn-danger" id="delete">Xóa</button>
                        </td>';
            echo $output;
        }
    }
    public function remove_user(Request $request) {
        $data = $request->all();
        User::remove($data['userId']);
    }
    public function enableAdmin(Request $request) {
        $data = $request->all();
        User::enable_admin($data['userId']);
    }

    public function disableAdmin(Request $request) {
        $data = $request->all();
        User::disable_admin($data['userId']);
    }

    public function disableUser(Request $request) {
        $data = $request->all();
        User::disable_user($data['userId']);
    }

    public function enableUser(Request $request) {
        $data = $request->all();
        User::enable_user($data['userId']);
    }
}