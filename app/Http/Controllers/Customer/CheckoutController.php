<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Order\OrderDetailService;
use App\Http\Services\Category\CategoryService;
use App\Http\Requests\Order\CreateFormRequest;
use Illuminate\Support\Facades\Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
    protected $orderService;
    protected $orderDetailService;
    protected $categoryService;
    public function __construct(OrderService $orderService, OrderDetailService $orderDetailService, CategoryService $categoryService){
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->categoryService = $categoryService;
    }
    public function show_checkout(){
        if(Session::has('LoginID')){
            $id = Session::get('LoginID');
            $order = $this->orderService->getOrderByUser($id);
            //dd($order->id);
            session()->put('orderID',$order->id); 
            return view('frontend.pages.shop-checkout',[
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
    public function save_checkout_cus(CreateFormRequest $request){
        //dd($request->input());
        $result = $this->orderService->checkout($request);
        if($result) return redirect('cart');
        return redirect()->back();
    }
    public function check_login_checkout(Request $request){

        $data=[];
        if(Session::has('LoginID')){
            if(Session::has('orderID')){
                $amountproduct = $this->orderDetailService->count(Session::get('orderID'));
                if ( $amountproduct <= 0 ) {
                    $message = "Giỏ hàng trống!!";
                    echo "<script type='text/javascript'>
                        if(confirm('$message'))
                        {
                            location.href = '/showcart';
                        }
                        else{
                            location.href = '/showcart';
                        }
                        </script>";
                } else {
                    return redirect('/checkout');
                }
            }
            else{
                return redirect('/checkout');
            }          
           
        }
        else{
            return redirect('/showlogin');          
            
        }   
    }
}
