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
        $data =array();
        $data['c_id']= $request->session()->get('LoginID');
        $data['qty']= Cart::count();
        $data['sub_total']= Cart::subtotal();
        $data['total']= Cart::total();
        $data['status']= '1';
        $data['type']= 'cod';
        $data['note']= $request->shipping_note;
        $data['address']= $request->shipping_address;
        $data['phone']= $request->shipping_phone;
        $data['name']= $request->shipping_name;

        $order_id= DB::table('orders')->insertGetId($data);

        $content= Cart::content(); 
        foreach ($content as $v_content) {
            $data2 =array();
            $data2['pro_id']= $v_content->id;
            $data2['qty']= $v_content->qty;
            $data2['o_id']= $order_id;
            DB::table('order_details')->insertGetId($data2);
          }
        
        Cart::destroy();
        Session::put('order_id',$order_id);
        return redirect('/home');
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
