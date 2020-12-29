@extends('index')

@section('page')

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Tìm kiếm</h4>
                    <p class="pull-left">Tìm thấy {{count($product)}} sản phẩm</p>
                </div>
            </div>
            
        </div>
        
        <div class="col-lg-9 col-md-9">
            <div class="row"> 
                @foreach ($product as $c)
                <div class="col-lg-4 col-md-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" >
                            <a href="#">
                                 <img src="{{asset("image/product/$c->urlimage")}}" >
                            </a>
                              <div class="label new">New</div>
                                <ul class="product__hover">
                                    <li><a href="{{asset("image/product/$c->urlimage")}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                        </div>
                        <div class="product__item__text">
                        <h6><a href="./{{$c->title}}">{{$c->title}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        <div class="product__price">{{number_format($c->price)}}₫</div>
                        </div>
                    </div>
                </div>
        @endforeach       
                
                
                
                
                
               
                
                <div class="col-lg-12 text-center">
                    <div class="pagination__option">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    
            
            
            
            
            
            
        </div>
       
    </div>
    </section>


@endsection

