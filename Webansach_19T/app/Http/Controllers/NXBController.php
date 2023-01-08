<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class NXBController extends Controller
{   
    public function auth_login_admin() {
            $admin_id = Session::get('user')->isadmin; 
            if($admin_id == 1){ 
                return Redirect::to('dashboard'); 
            }else{ 
                return Redirect::to('admin')->send(); 
            } 
        } 

    public function show_all_NXB() {
        $this->auth_login_admin();
        $listNXB = DB::table('nxb')->get();
        return view('admin.AllNxb')->with('list_nxb', $listNXB);
    }

    public function show_form_add_NXB() {
        $this->auth_login_admin();
        return view('admin.AddNxb');
    }

    public function show_form_edit_NXB($id) {
        $this->auth_login_admin();
        $nxb = DB::table('nxb')->where('nxbid', $id)->get();
        $manager_nxb = view('admin.EditNxb')
                            ->with('nxb', $nxb);
        return $manager_nxb;
    }

    public function update_NXB(Request $request) {
        $this->auth_login_admin();
        if($request->nxb_id) {
            $nxb = array();
            $nxb['nxb'] = trim($request->nxb_name);
            DB::table('nxb')
                ->where('nxbid', $request->nxb_id)
                ->update($nxb);
            Session::put('message', 'Update nhà xuất bảng thành công');
            return Redirect::to('all_nxb');
        }
    }

    public function add_NXB(Request $request) {
        $this->auth_login_admin();
        $nxbName = $request->nxb_name;
        if($nxbName) {
            $dataNxb = array();
            $dataNxb['nxb'] = $nxbName;
            DB::table('nxb')->insert($dataNxb);
            Session::put('message', 'Đã thêm nxb thành công');
            return Redirect::to('all_nxb');
        }
        return view('admin.add_nxb');
    }

    public function delete_NXB($id) {
        $this->auth_login_admin();
        DB::table('nxb')->where('nxbid', $id)->delete();
        Session::put('message', 'Đã thêm nxb thành công');
        return Redirect::to('all_nxb');
    }

}

