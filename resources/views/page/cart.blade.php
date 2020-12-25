@extends('index')
@section('page')
@php
$Cart = Session("Cart")??null;
$sum=0;
@endphp
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @csrf
                            @if (isset($Cart))
                            @foreach ($Cart as $key => $value)
                            @php
                            $sumproduct=0;
                            $image=$value['image'];
                            @endphp
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset("images/product/$image")}}" alt="" style="width: 20%;height: 6%;">
                                    <div class="cart__product__item__title">
                                        <a href="{{url('sanpham',$value['url'])}}">
                                            <h6>{{$value['Titleproduct']}}</h6>
                                        </a>
                                    </div>
                                </td>
                                <td class="cart__price">{{number_format($value['price'],0,'','.')}}</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="{{$value['Amount']}}" min="1"
                                            id="sanpham{{$loop->index}}">
                                    </div>
                                </td>
                                @php
                                $sum += $value['price'] * $value['Amount'];
                                $sumproduct =$value['price'] * $value['Amount'];
                                @endphp

                                <td class="cart__total">{{number_format($sumproduct,0,'','.')}}</td>
                                <td class="cart__close">
                                    <a href="removeCart?key={{$key}}"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{url('/')}}">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="javascript:void(0)" id="loading"><span class="icon_loading"></span> Update cart</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>{{number_format($sum,0,'','.')}}</span></li>
                        <li>Total <span>{{number_format($sum,0,'','.')}}</span></li>
                    </ul>

                    @if ($sum>0)
                    <a href="{{url('checkout')}}" class="primary-btn">Proceed to checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Cart Section End -->

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
    if(!alertify.errorAlert){
        alertify.dialog('errorAlert',function factory(){
            return{
                    build:function(){
                        var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                        +    'style="vertical-align:middle;color:#e10000;">'
                        + '</span> Lỗi ';
                        this.setHeader(errorHeader);
                    }
                };
            },true,'alert');
    }
    var count = {{Session("Cart")?count(Session("Cart")):0}};
    $("#loading").bind("click",function(){
        alertify
        .confirm('Cập nhập giỏ hàng',"Bạn muốn cập nhập mới giỏ hàng.",
        function(){

            var fd = new FormData();
            for (let index = 0; index < count; index++) {
                fd.append( 'soluong[]', $("#sanpham"+index).val());;
            }
            fd.append( '_token', $("input[name='_token']").val());
            $.ajax({
            url:'{{url("updateCart")}}',
            data:fd,
            processData:false,
            contentType:false,
            method:'POST',
            success: function(data){
                alertify
                    .alert("Cập nhập giỏ hàng","Cập nhập giỏ hàng thành công.", function(){
                    location.reload();

                });
            },
            error: function(data){
                alertify
                    .errorAlert("Cập nhập giỏ hàng thất bại.</br> Số lượng sản phẩm là số và lớn hơn 1", function(){
                    location.reload();
                });
            }
            });
            },
        function(){
            alertify.error('Cancel');
        });
    });
});
</script>
@endsection
