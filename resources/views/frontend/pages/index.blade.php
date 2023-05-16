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
                    <div class="hero__item set-bg" data-setbg="../public/frontend/{{$banner[2]->url}}">
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

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row" >
                <div  class="categories__slider owl-carousel" >
                    @foreach($categories as $key => $cate)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{$cate->img}}"  >
                                <h5><a href="#">{{$cate->name}}</a></h5>
                            </div>
                        </div>      
                    @endforeach                   
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <!-- <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul >
                            <li class="active" data-filter="*">All</li>
                            <li ng-repeat="cate in categories" ng-if="cate.parent_id!=0" data-filter=".category@{{cate.id}}">@{{cate.name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter" >
                <div ng-repeat="pro in productsAll" class="col-lg-3 col-md-4 col-sm-6 mix category@{{pro.cate_id}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="@{{pro.images}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="/product-detail">@{{pro.name}}</a></h6>
                            <h5>@{{pro.price}}đ</h5>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>-->
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner mt-4">
        <div class="container">
            <p>Chương trình khuyến mãi</p>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="../public/frontend/{{$banner[0]->url}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="../public/frontend/{{$banner[1]->url}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($latests as $key => $latest)
                                <a href="{{ url('product-detail/'.$latest->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{$latest->images}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$latest->name}}</h6>
                                        <span>{{$latest->price}} vnd</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($topRateds as $key => $topRated)
                                <a href="{{ url('product-detail/'.$topRated->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{$topRated->images}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topRated->name}}</h6>
                                        <span>{{$topRated->price}}đ</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($reviews as $key => $review)
                                <a href="{{ url('product-detail/'.$review->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{$review->images}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$review->name}}</h6>
                                        <span>{{$review->price}}đ</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    

    
    @endsection