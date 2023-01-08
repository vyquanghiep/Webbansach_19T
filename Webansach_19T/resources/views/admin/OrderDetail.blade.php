@extends('AdminLayout') 
@section('admin_content') 

<div 
    class="panel panel-primary">
    <div class="panel-heading"
        style="
            font-size: 1.3rem;
            position: relative;
            height: 37px;
            line-height: 37px;
            letter-spacing: 0.2px;
            color: #000;
            font-size: 18px;
            font-weight: 400;
            padding: 0 16px;
            background: #ddede0;
            border-top-right-radius: 2px;
            border-top-left-radius: 2px;">
      Thông tin người nhận
    </div> 
   
    <div class="table-responsive" > 
      <table class="table table-striped b-t b-light" id="myTable"> 
        <thead> 
          <tr> 
            <th>Họ tên</th> 
            <th>Số điện thoại</th> 
            <th>Địa chỉ</th> 
            <!-- <th style="width:30px;"></th>  -->
          </tr> 
        </thead> 
            <tr> 
                <td>{{$order_info->receivername}}</td> 
                <td>{{$order_info->phone}}</td>
                <td>{{$order_info->address}}</td>
                <td></td>
            </tr> 
        <tbody class="user__list"> 
       
        </tbody> 
      </table> 
    </div> 
</div> 

<br><br>


<div 
    class="panel panel-primary">
    <div class="panel-heading"
        style="
            font-size: 1.3rem;
            position: relative;
            height: 37px;
            line-height: 37px;
            letter-spacing: 0.2px;
            color: #000;
            font-size: 18px;
            font-weight: 400;
            padding: 0 16px;
            background: #ddede0;
            border-top-right-radius: 2px;
            border-top-left-radius: 2px;">
      Chi tiết đơn hàng
    </div> 
   
    <div class="table-responsive" > 
      <table class="table table-striped b-t b-light" id="myTable"> 
        <thead> 
          <tr> 
            <th>STT</th>
            <!-- <th></th> -->
            <th>Tên sách</th> 
            <th>Giá bán (VND)</th>
            <th>Số lượng</th> 
            <th>Đơn giá (VND)</th>
            <!-- <th style="width:30px;"></th>  -->
          </tr> 
        </thead> 
        <tbody class="user__list"> 
            <!-- {{$id=1}} -->
        @foreach($order_list as $key=>$product)
            <tr> 
                <td>{{$id++}}</td>
                <td>{{$product->bookname}}</td> 
                <td>{{number_format($product->price)}}</td>
                <td>{{$product->qtyordered}}</td>
                <td>{{number_format($product->amount)}}</td>
            </tr> 
        @endforeach
        
        </tbody> 
      </table> 
    <div class="order_execute">
        <div class="actions" style="display: flex; align-items: center;">
            @if($order_info->orderstatus == 0)
              <button data-order__id="{{$order_info->orderid}}" class="order__submit btn btn-success">Xác nhận</button>
              <button style="display: none;" data-order__id="{{$order_info->orderid}}" class="order__success btn btn-info">
                Giao hàng thành công
              </button>
            @elseif($order_info->orderstatus == 1)
              <button data-order__id="{{$order_info->orderid}}" class="order__success btn btn-info">
                  Giao hàng thành công
              </button> 
            @elseif($order_info->orderstatus == 2)
              <h4 >Đã giao vào lúc: {{ date("h:i:sa d/m/Y ", strtotime($order_info->timestamp))  }}</h4>
            @endif
            <button data-order__id="{{$order_info->orderid}}" style="margin-left: 20px;" class="order__delete btn btn-danger">
              Xóa
            </button>
        </div>
        <div class="total">
            <h3>Tổng tiền: {{$order_info->totalmoney}}</h3>
        </div>
    </div>
    </div> 
</div> 

<br><br>
<style>
    .order_execute {
        display: flex;
        width: 100%;
        padding: 20px 30px;
        box-sizing: border-box;
        justify-content: space-between;
    }
</style>

<script>
    $(document).on('click', '.order__submit', function() {
        if(confirm('Bạn có muốn xác nhận đơn hàng này?')) {
           let orderId = $(this).data('order__id')
           $.ajax({
                url: "{{url('/order_confirm')}}",
                method: 'post',
                data: {
                    orderId: orderId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $.notify('Đã xác nhận đơn hàng thành công', 'success')
                    $('.order__submit').css('display', 'none')
                    $('.order__success').css('display', 'block')
                }
           })
        }
    })

    $(document).on('click', '.order__success', function() {
      if(confirm('Đơn hàng đã được giao?')) {
        let orderId = $(this).data('order__id')
           $.ajax({
                url: "{{url('/order_success')}}",
                method: 'post',
                data: {
                    orderId: orderId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  if(data == 'success') {
                    $.notify('Cập nhật đơn hàng thành công', 'success')
                    window.location.replace("{{url('/all_orders')}}");
                  }
                }
           })
      }
    })

    $(document).on('click', '.order__delete', function() {
      if(confirm('Bạn có muốn xóa đơn hàng này?')) {
        let orderId = $(this).data('order__id')
           $.ajax({
                url: "{{url('/order_delete')}}",
                method: 'post',
                data: {
                    orderId: orderId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  if(data == 'success') {
                    $.notify('Đã xóa đơn hàng thành công', 'success')
                    window.location.replace("{{url('/all_orders')}}");
                  } 

                  if(data == 'failure')
                    $.notify('Cập nhật thất bại', 'warning')
                }
           })
      }
    })
</script>

@endsection()
