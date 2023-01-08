@extends('AdminLayout') 
@section('admin_content') 
    <div class="row"> 
        <div class="col-lg-12"> 
            <div class="panel panel-primary">
                <div class="panel-heading"
                    style="font-size: 2rem;">
                    Thêm danh mục sản phẩm
                </div>
                <div class="panel-body"> 
                    <div class="position-center"> 
                        <form 
                            role="form" 
                            method="post" 
                            action="#"
                        > {{ csrf_field() }}
                            <div class="form-group"> 
                                <label for="category_name">Tên sách</label> 
                                <input type="text" class="form-control" name="category_name"> 
                            </div> 

                            <div class="form-group"> 
                                <label for="">Số trang</label> 
                                <input type="text" class="form-control" name=""> 
                            </div> 

                            <div class="form-group"> 
                                <label for="">Cân nặng</label> 
                                <input type="text" class="form-control" name=""> 
                            </div> 

                            <div class="form-group"> 
                                <label for="">Số lượng</label> 
                                <input type="text" class="form-control" name=""> 
                            </div> 

                            <div class="form-group"> 
                                <label for="">Ngày xuất bản</label> 
                                <input type="text" class="form-control" name=""> 
                            </div> 

                            <div class="form-group"> 
                                <label for="">Giá</label> 
                                <input type="text" class="form-control" name=""> 
                            </div> 

                            <div class="form-group"> 
                                <label for="">Nhà xuất bảng</label> 
                                <select name="" id="">
                                    @foreach($list_nxb as $key => $nxb)
                                        <option value="">{{$nxb->nxb}}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group"> 
                                <label for="">Danh mục</label> 
                                <select name="" id="">
                                    @foreach($list_danhmuc as $key => $danhmuc)
                                        <option value="">{{$danhmuc->categoryname}}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <button type="submit" class="btn btn-info">Thêm</button> 
                        </form> 
                    </div> 
                </div> 
            </div> 
        </div>    
@endsection
