@extends('welcome')
@section('content')
    <!-- trang detail  -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/product-item.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


 <!-- thanh "danh muc sach" đã được ẩn bên trong + hotline + ho tro truc tuyen -->
 <section class="duoinavbar">
        <div class="container text-white">
            <div class="row justify">
                <div class="col-lg-3 col-md-5">
                    <div class="categoryheader">
                        <div class="noidungheader text-white">
                            <i class="fa fa-bars"></i>
                            <span class="text-uppercase font-weight-bold ml-1">Danh mục sách</span>
                        </div>
                        <!-- CATEGORIES -->
                        <div class="categorycontent">
                        <ul >
                            @foreach($category as $key => $cate)
                            <li> <a href="{{URL::to('/danh-muc-san-pham/'.$cate->categoryid)}}">{{$cate->categoryname}}</a><i class="fa fa-chevron-right float-right"></i>
                              <ul>
                                    <li class="liheader"><a href="#" class="header text-uppercase">{{$cate->categoryname}}</a></li>
                                @foreach($sub_cate as $key => $sub)    
                                    @if($sub->parent == $cate->categoryid)                
                                        <li style="margin-left:50px"><a href="{{URL::to('/danh-muc-san-pham/'.$sub->categoryid)}}">{{$sub->categoryname}}</a></li>
                                    @endif
                                @endforeach    
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-md-5 ml-auto contact d-none d-md-block">
                    <div class="benphai float-right">
                        <div class="hotline">
                            <i class="fa fa-phone"></i>
                            <span>Hotline:<b>1900 1999</b> </span>
                        </div>
                        <i class="fas fa-comments-dollar"></i>
                        <a href="#">Hỗ trợ trực tuyến </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- nội dung của trang  -->
<section class="product-page mb-4">
        <div class="container">
            <!-- chi tiết 1 sản phẩm -->
            @foreach($product_details as $key =>$value)

            <div class="product-detail bg-white p-4">
                <div class="row">
                    <!-- ảnh  -->
                    <div class="col-md-5 khoianh">
                        <div class="anhto mb-4">
                            <a class="active" href="{{URL::to('./public/frontend/images/'.$value->bookimageurl)}}" data-fancybox="thumb-img">
                                <img class="product-image" src="{{URL::to('./public/frontend/images/'.$value->bookimageurl)}}"  style="width: 100%;">
                            </a>
                            <a href="{{URL::to('./public/frontend/images/'.$value->bookimageurl)}}" data-fancybox="thumb-img"></a>
                        </div>
                       <div class="list-anhchitiet d-flex mb-4" style="margin-left: 2rem;">
                            <img class="thumb-img thumb1 mr-3" src="{{URL::to('./public/frontend/images/'.$value->bookimageurl)}}" class="img-fluid" >
                            <img class="thumb-img thumb2" src="{{URL::to('./public/frontend/images/'.$value->bookimageurl)}}" class="img-fluid" >
                        </div>
                    </div> 
                    <!-- thông tin sản phẩm: tên, giá bìa giá bán tiết kiệm, các khuyến mãi, nút chọn mua.... -->
                    <div class="col-md-7 khoithongtin">
                        <div class="row">
                            <div class="col-md-12 header">
                                <h4 class="ten">{{$value->bookname}}</h4>
                                <div class="rate">
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star active"></i>
                                    <i class="fa fa-star "></i>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-7">
                                <div class="gia">
                                    <div class="giabia">Giá bìa:<span class="giacu ml-2">139.000 ₫</span></div>
                                    <div class="giaban">Giá bán tại DealBooks: <span
                                            class="giamoi font-weight-bold">{{number_format($value->price)}} </span><span class="donvitien">₫</span></div>
                                    <div class="tietkiem">Tiết kiệm: <b>27.800 ₫</b> <span class="sale" style="width:34px;">-20%</span>
                                    </div>
                                </div>
                                <div class="uudai my-3">
                                    <h6 class="header font-weight-bold">Khuyến mãi & Ưu đãi tại DealBook:</h6>
                                    <ul>
                                        <li><b>Miễn phí giao hàng </b>cho đơn hàng từ 150.000đ ở TP.HCM và 300.000đ ở
                                            Tỉnh/Thành khác <a href="#">>> Chi tiết</a></li>
                                        <li><b>Combo sách HOT - GIẢM 25% </b><a href="#">>>Xem ngay</a></li>
                                        <li>Tặng Bookmark cho mỗi đơn hàng</li>
                                        <li>Bao sách miễn phí (theo yêu cầu)</li>
                                    </ul>
                                </div>
                            <form action="{{URL::to('/save-cart')}}" method="POST">
                                {{csrf_field()}}
                               
                                <div class="soluong d-flex">
                                    <label class="font-weight-bold">Số lượng: </label>
                                    <div class="input-number input-group mb-3">
                                       <!-- <div class="input-group-prepend">
                                            <span class="input-group-text btn-spin btn-dec">-</span>
                                        </div> -->
                                        <input type="number"  min ="1" value="1" class="soluongsp  text-center" name ="qty" >
                                        <input type="hidden"   value="{{$value->bookid}}"  name ="product_id_hidden" >
                                        <!--<div class="input-group-append">
                                            <span class="input-group-text btn-spin btn-inc">+</span>
                                        </div> -->
                                    </div>
                                </div>
                                <button class="nutmua btn w-100 text-uppercase" type="submit">
                                    <i> Chọn mua </i>
                                </button>
                            </form>
                                
                                <div class="fb-like" data-href="https://www.facebook.com/DealBook-110745443947730/"
                                    data-width="300px" data-layout="button" data-action="like" data-size="small"
                                    data-share="true"></div>
                            </div>
                            <!-- thông tin khác của sản phẩm:  tác giả, ngày xuất bản, kích thước ....  -->
                            <div class="col-md-5">
                                <div class="thongtinsach">

                                        <li>Ngày xuất bản: <b>{{$value->releasedate}}</b></li>                   
                                        <li>Nhà xuất bản: {{$value->nxb}}</li>
                                        <li>Hình thức bìa: <b>Bìa mềm</b></li>
                                        <li>Số trang: <b>{{$value->bookpages}}</b></li>
                                        <li>Cân nặng: <b>{{$value->bookweight}}</b></li>
                                        <li>Số lượng còn: <b>{{$value->quantity}}</b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- decripstion của 1 sản phẩm: giới thiệu , đánh giá độc giả  -->
                    <div class="product-description col-md-9">
                        <!-- 2 tab ở trên  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active text-uppercase" id="nav-gioithieu-tab"
                                    data-toggle="tab" href="#nav-gioithieu" role="tab" aria-controls="nav-gioithieu"
                                    aria-selected="true">Giới thiệu
                                </a>
                                <a class="nav-item nav-link  text-uppercase" id="nav-docthu-tab"
                                    data-toggle="tab" href="#nav-docthu" role="tab" aria-controls="nav-docthu"
                                    aria-selected="false">Đọc thử
                                </a>
                                <a class="nav-item nav-link text-uppercase" id="nav-danhgia-tab" data-toggle="tab"
                                    href="#nav-binhluan" role="tab" aria-controls="nav-danhgia"
                                    aria-selected="false">Bình luận
                                </a>
                                <!-- <a class="nav-item nav-link text-uppercase" id="nav-danhgia-tab" data-toggle="tab"
                                    href="#nav-danhgia" role="tab" aria-controls="nav-danhgia"
                                    aria-selected="false">Đánh
                                    giá của độc giả
                                </a> -->
                            </div>
                        </nav>
                        <!-- nội dung của từng tab  -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active ml-3" id="nav-gioithieu" role="tabpanel"
                                aria-labelledby="nav-gioithieu-tab">
                                <h6 class="tieude font-weight-bold">{{$value->bookname}}</h6>
                                <p>
                                    <span>Khi bắt đầu thành lập doanh nghiệp hay mở rộng quy mô hoạt động, lập ra một
                                        bản kế hoạch kinh doanh là bước đi đầu tiên không thể thiếu. Bản kế hoạch kinh
                                        doanh càng được chuẩn bị kỹ lưỡng và lôi cuốn bao nhiêu, cơ hội ghi điểm trước
                                        các nhà đầu tư càng lớn bấy nhiêu. Phải chăng, thông qua bản kế hoạch kinh
                                        doanh, bạn muốn người đọc:
                                    </span>
                                </p>
                                <p>
                                    <span>- Đầu tư vào một ý tưởng kinh doanh mới hay một doanh nghiệp đang hoạt
                                        động?</span>
                                </p>
                                <p>
                                    <span>- Mua lại doanh nghiệp của bạn?</span>
                                </p>
                                <p>
                                    <span>- Tham gia liên doanh với bạn?</span>
                                </p>
                                <p>
                                    <span>- Chấp nhận đề nghị của bạn để thực hiện hợp đồng?</span>
                                </p>
                                <p>
                                    <span>- Cấp cho bạn một khoản hỗ trợ hoặc phê duyệt theo quy định?</span>
                                </p>
                                <p>
                                    <span>- Thuyết phục hội đồng quản trị thay đổi phương hướng hoạt động doanh nghiệp
                                        của bạn?</span>
                                </p>
                                <p>
                                    <span>Cuốn sách “Lập kế hoạch kinh doanh hiệu quả” sẽ hướng dẫn bạn cách để tạo ra
                                        bản kế hoạch kinh doanh thu hút mọi tổ chức tài chính, khiến họ phải đáp ứng
                                        mong muốn của bạn và hỗ trợ bạn tới cùng trong công việc kinh doanh. Thông qua
                                        cuốn sách, bạn sẽ biết cách:</span>
                                </p>
                                <p>
                                    <span>Tạo ra bản kế hoạch kinh doanh hoàn chỉnh Xây dựng chiến lược hoạt động cho
                                        doanh nghiệp.</span>
                                </p>
                                <p>
                                    <span>Đưa ra dự báo kinh doanh sát với thực tế.</span>
                                </p>
                                <p>
                                    <span>Nắm rõ các thông tin tài chính ảnh hưởng lớn tới doanh nghiệp.</span>
                                </p>
                                <p>
                                    <span>Trong quá trình xây dựng kế hoạch, việc tham khảo ý kiến chuyên gia là điều
                                        cần thiết nhưng bạn phải là người đóng góp chính và hiểu tường tận mỗi chi tiết
                                        có trong đó. Hãy xem việc lập kế hoạch giống như việc truyền đạt câu chuyện của
                                        mình nhằm thuyết phục người đọc đồng hành cùng bạn trên con đường chinh phục mục
                                        tiêu kinh doanh.</span>
                                </p>
                                <p>
                                    <span>Bạn chỉ có một cơ hội duy nhất để tạo ấn tượng đầu tiên tốt đẹp. Đừng để nó
                                        vụt mất. Hãy trình bày một văn bản có tính thuyết phục cao, bố cục đẹp mắt,
                                        không mắc lỗi chính tả, ngữ pháp, bao gồm các vấn đề trọng tâm và cuối cùng là
                                        chứa các thông tin bổ trợ cần thiết.</span>
                                </p>
                                <p>
                                    <span>Bằng kiến thức, kinh nghiệm của mình, Brian Finch - một chuyên gia trong lĩnh
                                        vực tư vấn lập kế hoạch kinh doanh và quản lý tài chính - chắc chắn sẽ giúp bạn
                                        xây dựng thành công kế hoạch kinh doanh của riêng mình.</span>
                                </p>
                            </div>

                            <!-- Đọc thử -->
                            <div class="tab-pane fade ml-3" id="nav-docthu" role="tabpanel"
                                aria-labelledby="nav-docthu-tab">
                                <h6 class="tieude font-weight-bold">{{$value->bookname}}</h6>
                                <label for="">Chọn chương:</label>
                                <select name="" id="select_chapter" class="custom-select" style="margin:0 30px 30px 0px;">
                                @foreach($product_summary as $key => $chapter)
                                    <option class="chap_options" value="{{$chapter->noidung}}">{{$chapter->chuong}}</option>
                                @endforeach
                                </select>

                                <p class="chapter">
                                </p>

                            </div>

                            <!-- nav-binhluan -->
                            <div class="tab-pane fade" id="nav-binhluan" role="tabpanel"
                                aria-labelledby="nav-gioithieu-tab">
                                <!-- hienthi binhluan -->
                                <style type="text/css">
                                    .style_comment{
                                        border: 1px solid #ddd;
                                        border-radius: 10px;
                                        background:#F0F0E9;
                                    }
                                </style>    
                                <form>
                                @csrf
                                    <div id="comment_show"></div>
                                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->bookid}}">

                                
                                </form>
                            
                            
                                <!-- them binh luan -->
                                
                                <div class="col-md-5" style="margin-left:150px">
                                        <div class="tiledanhgia text-center">
                                            
                                            <div class="btn vietdanhgia mt-3">Viết bình luận của bạn</div>
                                        </div>
                                        <!-- nội dung của form đánh giá  -->
                                        <form action="#">
                                        
                                        <div class="formdanhgia">
                                        <div id="notify_comment"></div>
                                            <h6 class="tieude text-uppercase">GỬI BÌNH LUẬN CỦA BẠN</h6>
                                            <span class="danhgiacuaban">Bình luận của bạn về sản phẩm này:</span>
                                        
                                            <div class="form-group">
                                                <input type="text" class="comment_name" placeholder="Mời bạn nhập tên">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="comment_email" placeholder="Mời bạn nhập email">
                                            </div>
                                            <div class="form-group" >
                                                <textarea name="binhluan" style="width:300px;height:120px" class="comment_content" > </textarea>
                                            </div>
                                            <button type="button" class="btn nutguibl send-comment">  Gửi bình luận</button>
                                            
                                        </div> 
                                        </form>
                                </div>
                                    
                            </div>

                        </div>
                        <!-- het tab-content  -->
                    </div>
                    <!-- het product-description -->
                </div>
                <!-- het row  -->
            </div>
            <!-- het product-detail -->
        </div>
        @endforeach
        <!-- het container  -->
    </section>
    <script>
        $('.chapter').html( $('.chap_options').val())
        $('#select_chapter').on('change', function(e) {
            $('.chapter').html( $(this).val())
        })
        
    </script>

    @endsection