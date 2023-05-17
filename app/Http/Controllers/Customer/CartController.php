<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Order\OrderDetailService;
use App\Http\Services\Category\CategoryService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use DB;
#use Session;
use App\Http\Requests;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Redirect;
use Cart;
#session_start();
class CartController extends Controller
{

    protected $orderService;
    protected $orderDetailService;
    protected $categoryService;
    public function __construct(OrderService $orderService, OrderDetailService $orderDetailService, CategoryService $categoryService){
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->categoryService = $categoryService;
    }
    public function cart(){
        if(Session::has('LoginID')){
            $id = Session::get('LoginID');
            $order = $this->orderService->getOrderByUser($id);
            //dd($order->id);
            session()->put('orderID',$order->id); 
            return view('frontend.pages.shop-cart',[
                'order'=>$order,
                'details'=> $this->orderDetailService->get($order->id),
                'categories'=>$this->categoryService->getAll(),
                'ur'=>'',
            ]); 
        }
        else{
            return redirect("showlogin");
        }
        
    }
    public function save_cart(Request $request){
        $productid=$request->productid_hidden;
        $quantity=$request->qty;

        $product_infor = DB::table('products')->where('id',$productid)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id'] = $product_infor->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_infor->name;
        $data['weight'] = $product_infor->price;
        if($product_infor->price_sale!=null){
            $data['price'] = $product_infor->price_sale;
        }
        else{
            $data['price'] = $product_infor->price;
        }
        $data['options']['image']= $product_infor->images;
        Cart::add($data);
        //Cart::destroy();
        return Redirect::to('showcart');
    }

    public function update_cart_qty(OrderDetail $detail, Request $request){
        //dd($request);
        $result = $this->orderDetailService->update($detail, $request);
        if($result) return redirect('cart');
        return redirect()->back();
    }

    public function delete_to_cart(Request $request){
        $result = $this->orderDetailService->delete($request);
        if($result){
            return redirect('cart');
        }
        return redirect()->back();
    }

    public function addToCart(Request $request){
        if(Session::has('LoginID')){
            $id = Session::get('LoginID');
            if(!Session::has('orderID')){
                $order = $this->orderService->getOrderByUser($id);
                session()->put('orderID',$order->id);
            }
            $o_id = Session::get('orderID');
            $result = $this->orderDetailService->create($o_id, $request);
            if($result) return redirect('cart');
            return redirect()->back();
        }
        else{
            return redirect("showlogin");
        }      
    }

}
