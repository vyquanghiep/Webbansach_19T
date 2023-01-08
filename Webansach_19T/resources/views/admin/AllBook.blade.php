@extends('AdminLayout') 
@section('admin_content') 
<!-- <h1>davaddsf</h1> -->
<div class="panel panel-primary">
    <div class="panel-heading"
        style="font-size: 2rem;">
      Liệt kê danh mục sản phẩm 
    </div> 
    <div class="row w3-res-tb"> 
      <div class="col-sm-5 m-b-xs"> 
        <select class="input-sm form-control w-sm inline v-middle"> 
          <option value="1">Xóa các danh mục đã chọn</option> 
          <option value="0">Chọn tất cả</option> 
          <option value="2">Bỏ chọn tất cả</option> 
          <option value="3">Xuất</option> 
        </select> 
        <button class="btn btn-sm btn-default">Apply</button>                 
      </div> 
      <div class="col-sm-4"> 
      </div> 
      <div class="col-sm-3"> 
        <div class="input-group"> 
          <input type="text" class="input-sm form-control" placeholder="Search"> 
          <span class="input-group-btn"> 
            <button class="btn btn-sm btn-default" type="button">Go!</button> 
          </span> 
        </div> 
      </div> 
    </div> 
    <div class="table-responsive"> 
      <table class="table table-striped b-t b-light"> 
        <thead> 
          <tr> 
            <th style="width:20px;">
            </th> 
            <th>Tên sách</th> 
            <th>Số trang</th>
            <th>Nhà xuất bảng</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th></th> 
          </tr> 
        </thead> 

        <tbody> 
          @foreach($list_books as $key=>$book)
          <tr> 
            <td>
                <img style="width: 150px; height: 150px" src="{{URL::to('public/frontend/images/'.$book->bookimageurl)}}" alt="">
            </td> 
            <td>{{$book->bookname}}</td> 
            <td>{{$book->bookpages}}</td> 
            <td>{{$book->nxb}}</td> 
            <td>{{$book->quantity}}</td> 
            <td>{{$book->price}}</td> 
            <td>
              <button class="btn btn-warning">
                <a href="{{URL::to('update_book/'.$book->bookid)}}">Sửa</a>
              </button>
              <button class="btn btn-danger">
                <a href="{{URL::to('/delete_book/'.$book->bookid)}}">Xóa</a>
              </button>
            </td>
          </tr> 
          @endforeach
        </tbody> 
      </table> 
    </div> 
    <footer class="panel-footer"> 
      <div class="row"> 
         
        <!-- <div class="col-sm-5 text-center"> 
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> 
        </div> 
        <div class="col-sm-7 text-right text-center-xs">                 
          <ul class="pagination pagination-sm m-t-none m-b-none"> 
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li> 
            <li><a href="">1</a></li> 
            <li><a href="">2</a></li> 
            <li><a href="">3</a></li> 
            <li><a href="">4</a></li> 
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li> 
          </ul> 
        </div>  -->
      </div> 
    </footer> 
  </div> 
@endsection()
