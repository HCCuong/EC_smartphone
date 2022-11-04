<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderDetailService;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Order\OrderService;
use App\Http\Requests;


class OrderController extends Controller
{
    protected $orderService;
    protected $orderDetailService;

    public function __construct(OrderService $orderService, OrderDetailService $orderDetailService){
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order_list', [
            'title'=>'Danh sách đơn hàng',
            'orders'=>$this->orderService->getAll(),
            'ur'=>''
        ]);
    }

    public function get_list_new()
    {
        return view('admin.order_list', [
            
            'title'=>'Danh sách đơn hàng mới',
            'orders'=>$this->orderService->getAll(),
            'ur'=>''
        ]);
    }

    public function get_list_cancel()
    {
        return view('admin.order_list', [
            'title'=>'Danh sách đơn hàng đã hủy',
            'orders'=>$this->orderService->getAll(),
            'ur'=>''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(){
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order_detail', [
            'title'=>'Chi tiết hóa đơn:  ' . $order->id,
            'order'=>$order,
            'order_details'=>$this->orderDetailService->get($order->id),
            'ur'=>'../'
        ]);
    }
    public function showmodal(Order $order)
    {
        return view('admin.modal.order_detail', [
            'title'=>'Chi tiết hóa đơn:  ' . $order->id,
            'order'=>$order,
            'order_details'=>$this->orderDetailService->get($order->id),
            'ur'=>'../'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(){
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse{
        $result = $this->orderService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa đơn hàng thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }


    public function getOrderDetails($orderid = 0){
        $order = Order::with('user')->where('id', $orderid)->get();
        $orderdetails = $this->orderDetailService->get($orderid);
        $html = "<tr>
                <td width='30%'><b>ID:</b></td>
                <td width='70%'></td>
             </tr>
             ";
        //if(!empty($order)){
        //   $html = "<tr>
        //        <td width='30%'><b>ID:</b></td>
        //        <td width='70%'> ".$order->id."</td>
        //     </tr>
        //     <tr>
        //        <td width='30%'><b>Username:</b></td>
        //        <td width='70%'> ".$order->user->name."</td>
        //     </tr>
        //     <tr>
        //        <td width='30%'><b>Phone:</b></td>
        //        <td width='70%'> ".$order->phone."</td>
        //     </tr>
        //     <tr>
        //        <td width='30%'><b>Address:</b></td>
        //        <td width='70%'> ".$order->address."</td>
        //     </tr>
        //     <tr>
        //        <td width='30%'><b>Total:</b></td>
        //        <td width='70%'> ".$order->total."</td>
        //    </tr>";
        //}
         return response()->json([
            'html' => $html
        ]);
     }
}
