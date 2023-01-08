@extends('AdminLayout') 
@section('admin_content') 
    <div class="row"> 
        <div class="col-lg-12"> 
            <div class="panel panel-primary">
                <div class="panel-heading"
                    style="font-size: 2rem;">
                    Thêm mới nhà xuất bản
                </div>
                <div class="panel-body"> 
                    <div class="position-center"> 
                        <form 
                            role="form" 
                            method="post" 
                            action="{{URL::to('/save_nxb')}}"
                        >   
                            {{ csrf_field() }}
                            <div class="form-group"> 
                                <label for="nxb_name">Tên nhà xuất bản</label> 
                                <input type="text" class="form-control" name="nxb_name"> 
                            </div> 

                            <button type="submit" class="btn btn-info">Thêm</button> 
                        </form> 
                    </div> 
                </div> 
            </section> 
        </div>    
@endsection