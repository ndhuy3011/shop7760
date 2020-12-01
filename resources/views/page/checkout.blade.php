@extends('index')
@section('page')

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                    here to enter your code.</h6>
            </div>
        </div>
        <form action="{{url('checkout')}}" class="checkout__form" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Tên của bạn</p>
                                <input type="text" disabled value="{{Auth::user()->name}}" >
                            </div>
                            <div class="checkout__form__input">
                                <p>Địa chỉ <span>*</span></p>
                                <input type="text" placeholder="Địa chỉ nhà / Tên đường / Phường / Quận / Thành Phố"
                                    value="{{Auth::user()->address}}" name="diachi">
                            </div>
                            <div class="checkout__form__input">
                                <p>Số điện thoại <span>*</span></p>
                                <input type="text" value="{{Auth::user()->phonenumber}}" name="sodienthoai">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                @php
                                $Cart = Session("Cart")??null;
                                $sum=0;
                                @endphp
                                @if (isset($Cart))
                                @foreach ($Cart as $key => $value)
                                @php
                                $sumproduct=0;
                                $sum += $value['price'] * $value['Amount'];
                                $sumproduct =$value['price'] * $value['Amount'];
                                @endphp
                                <li>{{$loop->index+1}}.
                                    {{$value['Titleproduct']}}<span>{{number_format($sumproduct,0,'','.')}}</span></li>

                                @endforeach
                                @endif

                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>{{number_format($sum,0,'','.')}}</span></li>
                                <li>Total <span>{{number_format($sum,0,'','.')}}</span></li>
                            </ul>
                        </div>
                        <button type="submit" class="site-btn">Place oder</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->
@endsection

