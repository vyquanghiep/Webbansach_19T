<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();
class HomeController extends Controller
{

    public function index(){
        $cate_product = DB::table('categories')->where('categories.parent',1)->get(); 
        $sub_cate = DB::table('categories')->where('categories.parent','!=',1)->get();
        $all_product1 = DB::table('books')->join('nxb','books.nxbid','=','nxb.nxbid')->where('books.type',1)->get();
        $all_product2 = DB::table('books')->join('nxb','books.nxbid','=','nxb.nxbid')->where('books.type',2)->get();
        $all_product3 = DB::table('books')->join('nxb','books.nxbid','=','nxb.nxbid')->where('books.type',3)->get();
        $all_product4 = DB::table('books')->join('nxb','books.nxbid','=','nxb.nxbid')->where('books.type',4)->get();
        
        
        // $cate_child = DB::table('categories')->where('categories.parent',$categoryid)->get();
        return view('pages.home')->with('category',$cate_product)->with('all_product',$all_product1)->with('sub_cate',$sub_cate)
        ->with('all_product2',$all_product2)->with('all_product3',$all_product3)->with('all_product4',$all_product4);
    }

    

    public function postDangKy(Request $request) {
        try {
            User::create([
                'fullname' => $request -> fullname,
                'email' => $request -> email,
                'phone' => $request -> phone,
                'male' => '0',
                'address' => 'huế',
                'password' =>bcrypt($request -> password) 
                ]);
        } catch(Exception $e) {

        }   
        if(Auth::attempt(['email'=>$request -> email, 'password'=>$request -> password])) {
            Session::put('user', Auth::user());
            echo 'success';
        }  else{
            echo 'fail';
        }
        
    }

    public function postDangNhap(Request $request) {
        $email = $request -> email;
        $password = $request -> password;
        if(Auth::attempt(['email'=>$email, 'password'=>$password])) {
            if(Auth::user()->isdisable == 1) {
                echo 'disabled';
            } else {
                Session::put('user', Auth::user());
                echo 'success';
            }
        } else {
            echo 'fail';
        }
    }

    public function getDangXuat(Request $request) {
        Session::remove('user');
        return Redirect::to('/'); 
    }

    public function changedPassword(Request $request) {
        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];
        $userid = $data['userId'];
        $data = array();
        $data['password'] = bcrypt($request->newPassword);
        if (Auth::attempt(['email'=>$email, 'password'=>$password])) { 
            if(User::updateUser($userid, $data)) {
                echo 'Cập nhật thành công';
            } else {
                echo 'Cập nhật thất bại';
            }
        } else {
                echo 'Mật khẩu chưa chính xác';
        }
    }
}
 