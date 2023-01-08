<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryProduct extends Controller
{
    // BEGIN ADMIN
    public function auth_login_admin() {
            $admin_id = Session::get('user')->isadmin; 
            if($admin_id == 1){ 
                return Redirect::to('dashboard'); 
            }else{ 
                return Redirect::to('admin')->send(); 
            } 
        } 

    public function show_all_category() {
        $this->auth_login_admin();
        $list_category = DB::table('categories')->get();
        $manager_category = view('admin.AllCategoryProduct')
                            ->with('list_category', $list_category);
        // return view('AdminLayout')->with('admin.all_category', $manager_category);
        return $manager_category;
    }

    public function show_form_add_category() {
        $this->auth_login_admin();
        return view('admin.AddCategoryProduct');
    }

    public function show_form_edit_category($id) {
        $this->auth_login_admin();
        $category = DB::table('categories')->where('categoryid', $id)->get();
        $manager_category = view('admin.EditCategory')
                            ->with('category', $category);
        return $manager_category;
    }

    public function add_category(Request $request) {
        $this->auth_login_admin();
        if($request->category_name) {
            $category = array();
            $category['categoryname'] = trim($request->category_name);
            $category['parent'] = trim($request->category_pid);
            DB::table('categories')->insert($category);
            Session::put('message', 'Đã thêm thành công');
            return Redirect::to('all_category');
        }
        return Redirect::to('add_category');
    }

    public function delete_category($id) {
        $this->auth_login_admin();
        DB::table('categories')->where('categoryid', $id)->delete();
        Session::put('message','Xóa danh mục thành công'); 
        return Redirect::to('all_category');
    }

    public function update_category(Request $request) {
        $this->auth_login_admin();
        if($request->category_id) {
            $category = array();
            $category['categoryname'] = trim($request->category_name);
            // $category['parentId'] = trim($request->category_pid);
            DB::table('categories')
                ->where('categoryid', $request->category_id)
                ->update($category);
            Session::put('message', 'Update danh mục thành công');
            return Redirect::to('all_category');
        }
    }

    // END ADMIN

    //user
    public  function show_category_home($categoryid){
        
        $cate_product = DB::table('categories')->where('categories.parent',1)->get(); 
        $sub_cate = DB::table('categories')->where('categories.parent','!=',1)->get();
        $category_by_id_cha = DB::table('books')->join('categories','books.categoryid','=','categories.categoryid')
        ->join('nxb','nxb.nxbid','=','books.nxbid')->where('books.categoryid',$categoryid)->get();
        $category_by_sub_id   = DB::table('books')->join('categories','books.categoryid','=','categories.categoryid')
        ->join('nxb','nxb.nxbid','=','books.nxbid')->where('categories.parent',$categoryid)->get();
        
        $category_name = DB::table('categories')->where('categories.categoryid',$categoryid)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_product)->with('category_by_id',$category_by_id_cha)
        ->with('category_by_sub_id',$category_by_sub_id)->with('category_name',$category_name)->with('sub_cate',$sub_cate);
    }
    
}
