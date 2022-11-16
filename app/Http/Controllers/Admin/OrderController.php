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
        return view('admin.order_list_done', [
            'title'=>'Danh sách đơn hàng',
            'orders'=>$this->orderService->getListDone(),
            'ur'=>''
        ]);
    }

    public function get_list_new()
    {
        return view('admin.order_list_new', [
            
            'title'=>'Danh sách đơn hàng mới',
            'orders'=>$this->orderService->getAll(),
            'ur'=>''
        ]);
    }

    public function get_list_cancel()
    {
        return view('admin.order_list_cancel', [
            'title'=>'Danh sách đơn hàng đã hủy',
            'orders'=>$this->orderService->getListCancel(),
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
        $order = Order::find($orderid);
        //$orderdetails = OrderDetail::find($orderid);
        $orderdetails = $this->orderDetailService->get($orderid);
        $html = "";
        if(!empty($orderdetails)){
            $html .= "
                <tr>
                    <td width='40%'><b>Tên khách hàng: </b></td>
                    <td width='60%'>".$order->user->name."</td>
                </tr>
                <tr>
                    <td width='40%'><b>Số loại sản phẩm: </b></td>
                    <td width='60%'>".$order->qty."</td>
                </tr>
                <tr>
                    <td width='40%'><b>Thành tiền: </b></td>
                    <td width='60%'>".$order->total. " đ</p>
                </tr>
                <tr>
                    <td width='40%'><b>Thanh toán: </b></td>
                    <td width='60%'>".$order->type."</td>
                </tr>
                <tr>
                    <td width='40%'><b>Ghi chú: </b></td>
                    <td width='60%'>".$order->note."</td>
                </tr>
                <tr>
                    <td width='40%'><b>SDT: </b></td>
                    <td width='60%'>".$order->phone."</td>
                </tr>
                <tr>
                    <td width='40%'><b>Địa chỉ: </b></td>
                    <td width='60%'>".$order->address."</td>
                </tr>
                <tr>
                    <td width='40%'><b>Ngày lập: </b></td>
                    <td width='60%'>".$order->created_at."</td>
                </tr>
                <tr>
                    <td width='20%'><b>Sản phẩm</b></td>
                    <td width='20%'><b>Hình ảnh</b></td>
                    <td width='30%'><b>Đơn giá</b></td>
                    <td width='30%'><b>Số lượng</b></td>
                </tr>";
            foreach($orderdetails as $val){
            $html .= "<tr>
                    <td width='20%'>".$val->product->name."</td>
                    <td width='20%'><image width='100px' height='100px' src='https://www.beeart.vn/uploads/file/images/blog/apple/bee_art_logo_apple_2%20copy.jpg'></td>
                    <td width='30%'>".$val->product->price."</td>
                    <td width='30%'>".$val->qty."</td>     
                    </tr>";
            }
        }
         return response()->json([
            'html' => $html
        ]);
     }
}
