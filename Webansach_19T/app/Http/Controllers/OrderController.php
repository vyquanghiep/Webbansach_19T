<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //user
    public function show_all_orders(){
        $list_orders = DB::table('orders')
        ->join('users', 'orders.userid',  '=', 'users.userid')->get();
        return view('admin.AllOrder')->with('list_orders', $list_orders);   
    }

    public function filter_orders(Request $request) {
        $filter = $request->filter;
        if($filter == "1") {
            $list_orders = DB::table('orders')
            ->join('users', 'orders.userid',  '=', 'users.userid')->where('orderstatus', 0)->get();
            return view('admin.AllOrder')->with('list_orders', $list_orders);  
        }

        if($filter == "2") {
            $list_orders = DB::table('orders')
            ->join('users', 'orders.userid',  '=', 'users.userid')->where('orderstatus', 1)->get();
            return view('admin.AllOrder')->with('list_orders', $list_orders); 
        }

        if($filter == "3") {
            $list_orders = DB::table('orders')
            ->join('users', 'orders.userid',  '=', 'users.userid')->where('orderstatus', 2)->get();
            return view('admin.AllOrder')->with('list_orders', $list_orders); 
        }

        return Redirect::to('all_orders');
    }

    public function show_order_details($id) {
        $order_info = DB::table('orders')->where('orderid', $id)->get();
        $order_list = DB::table('ordersdetails')
            ->join('books', 'ordersdetails.bookid', '=', 'books.bookid')
            ->where('orderid', $id)
            ->get();
        return view('admin.OrderDetail')
            ->with('order_info', $order_info[0])
            ->with('order_list', $order_list);
    }

    public function confirm_order(Request $request) {
        $data = $request->all();
        $order = array();
        $order['orderstatus'] = 1;
        if(DB::table('orders')->where('orderid', $data['orderId'])->update($order)) {
            echo 'success';
        } else {
            echo 'fail';
        }
        
    }

    public function success_order(Request $request) {
        $order_id = $request->orderId;
        $d=strtotime("today");
        $order = array();
        $order['orderstatus'] = 2;
        $order['timestamp'] = date("Y-m-d h:i", $d);
        if(DB::table('orders')->where('orderid', $order_id )->update($order)) {
            echo 'success'; 
        } else {
            echo 'failure';
        }
    }

    public function delete_order(Request $request) {
        $order_id = $request->orderId;
        if(DB::table('orders')->where('orderid', $order_id)->delete()) {
            echo 'success'; 
        } else {
            echo 'failure';
        }
    }
}
