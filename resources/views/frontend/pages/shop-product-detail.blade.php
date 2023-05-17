@extends('FrontEnd.layouts.master')
@section('main-content')
<!-- Hero Section Begin -->
<section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            @foreach($categories as $key => $category)
                                <li>
                                    <a href="{{ url('product?cateID='.$category->id) }}">{{$category->name}}</a>
                                </li>
                            @endforeach                        
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ url('product') }}">
                                <input type="text" name="keyword" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+98 983 675 461</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="hero__item set-bg" data-setbg="{{('public/frontend/img/hero/banner-1.jpg')}}"> -->
                    <div class="hero__item set-bg" data-setbg="../../public/frontend/{{$banner[2]->url}}">
                        <div class="hero__text">
                            <!--<span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>-->
                            <a href="{{ url('/product') }}" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                        <h2>Product Detail</h2>
                        <div class="">
                            <a href="{{route('index')}}">Home</a>
                            <span>Product Detail</span>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{$product->images}}" alt="">
                                
                            <!--<img class="product__details__pic__item--large"
                                src="../{{$ur}}public/frontend/img/product/details/product-details-1.jpg" alt="">-->
                               
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{$product->image2}}"
                                src="{{$product->image2}}" alt="">
                            <img data-imgbigurl="{{$product->image3}}"
                                src="{{$product->image2}}" alt="">
                            <img data-imgbigurl="{{$product->images}}"
                                src="{{$product->image2}}" alt="">
                            <!--<img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="../{{$ur}}public/frontend/img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="../{{$ur}}public/frontend/img/product/details/thumb-4.jpg" alt=""> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="product__details__text">
                        <form action="{{ url('addtocart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <h3>{{$product->name}}</h3>
                            <h5>{{$product->category->name}}</h5><br>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(18 reviews)</span>
                            </div>
                            <div class="product__details__price">{{number_format($product->price)}} VND</div>
                            <p>{{$product->r_intro}}</p>
                            <div class="product__details__quantity mt-1">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input name="qty" type="text" value="1" min="1" max="5">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">ADD TO CARD</button>
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        </form>
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-sm-3"> <b>Quantity sold</b></div>
                                    <div class="col-sm-9"><span></span></div>
                                </div>                              
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-3"> <b>Packet</b></div>
                                    <div class="col-sm-9"><span>{{$product->packet}}</span></div>
                                </div>                              
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-3"> <b>Promo</b></div>
                                    <div class="col-sm-9">
                                        <span>{{$product->promo1}}</span><br>
                                        <span>{{$product->promo2}}</span><br>
                                        <span>{{$product->promo3}}</span>
                                    </div>
                                </div>                              
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-3"><b>Shipping</b> </div>
                                    <div class="col-sm-9"><span>01 day shipping. <samp>Free pickup today</samp></span></div>
                                </div>                              
                            </li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Description</h6>
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <p><b>CPU:</b> {{$product_detail->cpu}}</p>
                                            <p><b>RAM:</b> {{$product_detail->ram}}</p>
                                            <p><b>Màn hình:</b> {{$product_detail->screen}}</p>
                                            <p><b>Bộ nhớ lưu trữ:</b> {{$product_detail->storage}}</p>
                                            <p><b>Bộ nhớ mở rộng:</b> {{$product_detail->exten_memmory}}</p>
                                            <p><b>Kết nối mạng:</b> {{$product_detail->connect}}</p>
                                        </div>
                                        <div class='col-md-6 pl-2'>
                                            <p><b>Camera trước:</b> {{$product_detail->cam1}}</p>
                                            <p><b>Camera sau:</b> {{$product_detail->cam2}}</p>
                                            <p><b>Sim:</b> {{$product_detail->sim}}</p>
                                            <p><b>Dung lượng pin:</b> {{$product_detail->pin}}</p>
                                            <p><b>Hệ điều hành:</b> {{$product_detail->os}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Review</h6>
                                    <p>{{$product->review}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($relate_products as $key => $relate_product)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{$relate_product->images}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ url('product-detail/'.$relate_product->id) }}">{{$relate_product->name}}</a></h6>
                            <h5>{{$relate_product->price}}đ</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
    @endsection