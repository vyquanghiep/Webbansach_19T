<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Console\Presets\React;

session_start();

class CheckoutController extends Controller
{
    public function payment(Request $request){
        //insert order
        $data_order = array();
        $data_order['userid'] = Session::get('user')->userid;
        $data_order['receivername'] = $request->name;
        $data_order['phone'] = $request->phone;
        $data_order['address'] = $request->address;
        $data_order['totalmoney'] = Cart::subtotal()." đ";
        $data_order['orderstatus'] = 0;
        $orderid = Db::table('orders')->insertGetId($data_order);

        //insert order details

        $data = array();
        $content = Cart::content();
        foreach($content as $v_content){
            $data['orderid'] = $orderid;
            $data['bookid'] = $v_content->id;
            $data['amount'] = $v_content->price;
            $data['qtyordered'] = $v_content->qty;
            Db::table('ordersdetails')->insert($data);
        }
        Cart::destroy();
        return view('pages.cart.checkout_complete');

    }
}
