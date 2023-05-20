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

    <!-- Breadcrumb Section Begin -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                        <h2>Shopping Cart</h2>
                        <div class="">
                            <a href="{{route('index')}}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <?php $total = 0; ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                    @empty(Session::get('orderID')) 
                        <center><h3>You have no products in your shopping cart</h3></center>                
                    @endempty
                    @if(Session::has('orderID'))                      
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $key => $detail)
                                    <?php $total += ($detail->product->price * $detail->qty); ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="https://cdn.tgdd.vn/Products/Images/42/269831/Xiaomi-redmi-note-11-black-600x600.jpeg" width="100px" height="100px" alt="">
                                            <h5>{{$detail->product->name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{number_format($detail->product->price)}}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <form action="{{ url('updateQty') }}" method="post" >
                                                @csrf
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" name="quantity" value="{{$detail->qty}}">
                                                        <input type="hidden" name="id" value="{{$detail->id}}">  
                                                    </div>
                                                    <button type="submit" name="update_qty" value="cập nhật" class="primary-btn">Update</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{number_format($detail->product->price*$detail->qty)}}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <form action="{{ url('delete-to-cart') }}" method="delete"  onsubmit="deleteProduct()">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$detail->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm"><span class="icon_close"></span></button>   
                                            </form>
                                        </td>
                                    </tr>                              
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    </div>
                </div>
            </div>
            <a href="{{ url('product') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
            @if(Session::has('orderID'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>{{number_format($total)}} VND</span></li>
                            <li>Total <span>{{number_format($total)}} VND</span></li>
                        </ul>
                        <a href="{{ url('check-login-checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- Shoping Cart Section End -->


    <!-- List order -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <h5>Order dilivering</h5>

                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deliverings as $key => $order)
                                <tr>
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        {{$order->user->name}}
                                    </td>
                                    <td>
                                        {{$order->address}}
                                    </td>
                                    <td>
                                        {{number_format($order->total)}} VND
                                    </td>
                                    <td>
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    function deleteProduct() {
        confirm("Xóa sẽ không thể khôi phục - Bạn có muốn xóa không ?");
    }
</script>

    @endsection