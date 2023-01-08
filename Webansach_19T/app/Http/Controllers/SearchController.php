<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    //user
    public function show_search_results(Request $request){
        $searchKey = $request->search_key;
        $cate_product = DB::table('categories')->where('categories.parent',1)->get(); 
        $sub_cate = DB::table('categories')->where('categories.parent','!=',1)->get();
        $search_results = DB::table('books')->where('bookname','like', '%'.$searchKey.'%')->paginate(12);
        return view('pages.searchresult.search_result')
                    ->with('category',$cate_product)
                    ->with('search_key',$searchKey)
                    ->with('sub_cate',$sub_cate)
                    ->with('search_results',$search_results);                    
    }

    public function show_suggestion (Request $request) {
        $data = $request->all();
        $results  = DB::table('books')->where('bookname','like', '%'.$data['searchKey'].'%')->limit(2)->get();
        $output = '';
        
        foreach($results as $key => $product) {
            $output .= '<li class="input-resultlist">
                            <a class="row input-result__item" href="http://localhost:8080/BookStore2/chi-tiet-san-pham/'.$product->bookid.'">
                                <img src="http://localhost:8080/Bookstore2/public/frontend/images/'.$product->bookimageurl.'" alt="" class="col-lg-32 col-md-2 col-xs-2">
                                <div class="info row">
                                    <h4 class=" col-lg-12 col-md-12 col-xs-12">'.$product->bookname.'</h4>
                                    <h5>'.number_format($product->price).'đ</h5>
                                </div>
                            </a>
                        </li>';
        }
        echo $output;

                
    }
    
    
}
