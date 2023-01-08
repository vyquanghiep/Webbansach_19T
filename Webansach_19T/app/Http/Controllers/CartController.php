<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Support\Facades\Redirect;
use App\User;
session_start();
use Exception;





class CartController extends Controller
{
    public function save_cart(Request $request){
        //$cate_product = DB::table('categories')->get(); 
        //$all_product = DB::table('books')->get();
        
        $productid = $request->product_id_hidden;
        $qty = $request->qty;

        $product_info  = DB::table('books')->where('bookid',$productid)->first();

        $data['id'] = $product_info ->bookid;
        $data['name'] = $product_info ->bookname;
        $data['price'] = $product_info ->price;
        $data['weight'] = $product_info ->bookweight;
        $data['options']['image'] = $product_info ->bookimageurl;
        $data['qty'] = $qty;
        Cart::add($data);

        return Redirect::to('/show-cart');
    }
    public function show_cart(){
        $cate_product = DB::table('categories')->where('categories.parent',1)->get();
        $sub_cate = DB::table('categories')->where('categories.parent','!=',1)->get();
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('sub_cate',$sub_cate);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request->rowid;
        $qty = $request->cart_quantity;

        
        Cart::update($rowId,$qty);
          
        return Redirect::to('/show-cart');
        
    }

    public function login_cart(Request $request) {
        $email = $request -> email;
        $password = $request -> password;
        if(Auth::attempt(['email'=>$email, 'password'=>$password])) {
            Session::put('user', Auth::user());
        } 
        return Redirect::to('/show-cart'); 
    }
    public function signin_cart(Request $request) {
        try {
            User::create([
                'fullname' => $request -> fullname,
                'email' => $request -> email,
                'phone' => $request -> phone,
                'password' =>bcrypt($request -> password) 
                ]);
        } catch(Exception $e) {

        }   
        if(Auth::attempt(['email'=>$request -> email, 'password'=>$request -> password])) {
            Session::put('user', Auth::user());
        }  
        return Redirect::to('/show-cart'); 
    }
}
