<header id="js">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/elegant-icons.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/style.css")}}" type="text/css">
</header>
<div class="product__details__pic">
    <div class="product__details__pic__left product__thumb nice-scroll">
        @foreach ($image as $item)
        <a class="pt {{$loop->index==0?'active':''}}" href="#product-{{$loop->index+1}}">
            <img src="{{asset("images/product/".$item->url)}}" alt="">
        </a>
        @endforeach
    </div>
    <div class="product__details__slider__content">
        <div class="product__details__pic__slider owl-carousel">
            @foreach ($image as $item)
            <img data-hash="product-{{$loop->index+1}}" class="product__big__img"
                src="{{asset("images/product/".$item->url)}}" alt="">
            @endforeach
        </div>
    </div>
</div>
<div id="js">
    <script type="text/javascript" src="{{asset("js/jquery-3.3.1.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/jquery.slicknav.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/owl.carousel.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/jquery.nicescroll.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/main.js")}}"></script>
</div>
