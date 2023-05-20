@extends('FrontEnd.layouts.master')
@section('main-content')
<!-- Hero Section Begin -->
<section class="hero hero-normal" ng-init="getproduct()">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                   
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
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
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
                        <h2>Product</h2>
                        <div class="">
                            <a href="{{route('index')}}">Home</a>
                            <span>Product</span>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="{{ url('product') }}">All</a></li>  
                            </ul>
                            <ul>
                                @foreach($categories as $key => $category)
                                    <li>
                                        <a href="{{ url('product?cateID='.$category->id) }}">{{$category->name}}</a>
                                    </li>
                                @endforeach   
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="0" data-max="5000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white" ng-click="keyword('white')">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray" ng-click="keyword('gray')">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red" ng-click="keyword('red')">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black" ng-click="keyword('black')">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue" ng-click="keyword('blue')">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green" ng-click="keyword('green')">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Ram</h4>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    4GB
                                    <input type="radio" id="tiny" ng-click="keyword('4gb')">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    6GB
                                    <input type="radio" id="small" ng-click="keyword('6gb')">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    8GB
                                    <input type="radio" id="medium" ng-click="keyword('8gb')">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    12GB
                                    <input type="radio" id="large" ng-click="keyword('12gb')">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="exlarge">
                                    16GB
                                    <input type="radio" id="exlarge" ng-click="keyword('16gb')">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
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
                                                <span>{{number_format($latest->price)}} vnd</span>
                                            </div>
                                        </a>
                                    @endforeach
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($product_sales as $key => $product_sale)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{$product_sale->images}}">
                                            <div class="product__discount__percent"> {{ceil(100-($product_sale->price_sale/$product_sale->price*100))}}%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{$product_sale->category->name}}</span>
                                            <h5><a href="{{ url('product-detail/'.$product_sale->id) }}">{{$product_sale->name}}</a></h5>
                                            <div class="product__item__price">{{number_format($product_sale->price)}}đ <span>{{number_format($product_sale->price_sale)}} đ</span></div>
                                        </div>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-5 col-md-4">
                                <div class="filter__found">
                                    <h6><span></span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By: </span>
                                    <div class="sidebar__item__size">
                                        <label for="sort1">
                                            Default
                                            <input type="radio" id="sort1" ng-click="getSort('')">
                                        </label>
                                    </div>
                                    <div class="sidebar__item__size">
                                        <label for="sort2">
                                            A-Z
                                            <input type="radio" id="sort2" ng-click="getSort('name')">
                                        </label>
                                    </div>
                                    <div class="sidebar__item__size">
                                        <label for="sort3">
                                            Z-A
                                            <input type="radio" id="sort3" ng-click="getSort('name')">
                                        </label>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $key => $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{$product->images}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ url('product-detail/'.$product->id) }}">{{$product->name}}</a></h6>
                                    <h5>{{number_format($product->price)}} vnd</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $products->links() }}                     
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-push-4 product__pagination">
                            <posts-pagination class="text-center"></posts-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    @endsection
