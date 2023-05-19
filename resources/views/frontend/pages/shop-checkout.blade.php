@extends('FrontEnd.layouts.master')
@section('main-content')


    <!-- Hero Section Begin -->
<section class="hero hero-normal">
        <div class="container">
            <div class="row">
            <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul ng-repeat="cat in categories" ng-if="cat.parent_id==0">
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="/product" method="get">
                                <input type="text" placeholder="What do you need?" ng-model="key" name="keyword">
                                <button type="submit" ng-click="keyword(key)" class="site-btn">SEARCH</button>
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
                        <h2>Check out</h2>
                        <div class="">
                            <a href="{{route('index')}}">Home</a>
                            <span>Check out</span>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <?php $total = 0; ?>
                <h4>Billing Details</h4>
                <form action="{{ url('save-checkout-cus') }}" method="post">
                    @csrf
                    <div class="row">
                        <form action="">
                            <div class="col-lg-6 col-md-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="checkout__input">
                                            <p>Name<span>*</span></p>
                                            <input type="text" name="fullname">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" class="checkout__input__add" name="address">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Phone<span>*</span></p>
                                            <input type="text"  name="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email</p>
                                            <input type="text"  name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Order notes</p>
                                    <input type="text"  name="note"
                                        placeholder="Notes about your order, e.g. special notes for delivery.">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout__order">
                                    <h4>Your Order</h4>
                                    
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                        @foreach($details as $key => $detail)
                                        <?php $total += ($detail->product->price * $detail->qty); ?>
                                        <li>
                                            {{$detail->product->name}}<span>{{number_format($detail->product->price*$detail->qty)}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="checkout__order__subtotal">Subtotal <span>{{number_format($total)}} VND</span></div>
                                    <div class="checkout__order__total">Total <span>{{number_format($total)}} VND</span></div>
                        
                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                            Check Payment
                                            <input type="checkbox" id="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            Paypal
                                            <input type="checkbox" id="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <input type="hidden" name="total" value="{{$total}}">
                                    <input type="hidden" name="id" value="{{Session::get('orderID')}}">
                                    <button type="submit" class="site-btn">PLACE ORDER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    @endsection