<?php

namespace App\Http\Services\Order;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class OrderService
{

    public function create($c_id){
        try{
             Order::create([
                 'c_id' => (int) $c_id,
                 'qty' => (int) 1,
                 'sub_total' => (int) 0,
                 'total' => (int) 0,
                 'status' => (int) 1,
                 'type' => (string) "cod",
                 'note' => (string) "Không",
                 'address' => (string) "",
                 'phone' => (int) 0
             ]);
             Session::flash('success', 'Tạo sản phẩm thành công');
        } catch (\Exception $err){
             Session::flash('error', $err->getMessage());
             return false;
        }
        return true;
    }

    public function getAll()
    {
        return Order::with('user')->where('status', '=', 1)->orWhere('status', '=', 2)->paginate(100);
        //return Order::orderbyDesc('id', '>', 100)->cursorPaginate(10);
    }

    //Lấy danh sách đơn hàng đã giao
    public function getListDone()
    {
        return Order::with('user')->where('status','=', 3)->paginate(100);
    }

    public function getDelivering($id)
    {
        return Order::with('user')->where('status', '=', 2)->Where('c_id', $id)->simplePaginate(9);
    }

    //Lấy danh sách đơn hàng đã bị hủy
    public function getListCancel()
    {
        return Order::with('user')->where('status', 0)->paginate(100);
    }

    public function getById($request)
    {
        return Order::with('user')->where('id', $request)->get();
    }

    public function getOrderByUser($id)
    {
        return Order::with('user')->where('status', 1)->Where('c_id', $id)->first();
        //return Order::orderbyDesc('id', '>', 100)->cursorPaginate(10);
    }

    
    public function getOrderDoneByUser($id)
    {
        return Order::with('user')->where('status', '=', 3)->Where('c_id', $id)->simplePaginate(9);
        //return Order::orderbyDesc('id', '>', 100)->cursorPaginate(10);
    }


    public function insert($request){
        //dd($request->all());
        try {
            $request->except('_token');
            Order::create([
                'name' => (string) $request->input('name'),
                'price' => (int) $request->input('price'),
                'price_sale' => (int) $request->input('price_sale'),
                'cate_id' => (int) $request->input('cate_id'),
                'packet' => (string) $request->input('packet'),
                'review' => (string) $request->input('review'),
                'images' => (string) $request->input('file'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
            Session::flash('success', 'Tạo sản phẩm thành công');
        } catch (\Exception $err){
            Session::flash('error', 'Thêm sản phẩm lỗi !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($order, $request){
        //dd($request->all());
        try {
            $order->fill($request->input());
            $order->save();
            Session::flash('success', 'Câp nhật đơn hàng thành công');
        } catch (\Exception $err){
            Session::flash('error', 'Cập nhật đơn hàng thất bại !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){
        $order = Order::where('id', $request->input('id'))->first();
        $order_detail = OrderDetail::where('o_id', $request->input('id'));
        if($order && $order_detail){
            $order->delete();
            $order_detail->delete();
            return true;
        }
        return false;
    }

    public function checkout($request){
        try {
            $order = Order::find($request->id);
            $order->total = $request->total;
            $order->sub_total = $request->total;
            $order->note = $request->note;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->status = (int) 2;
            $order->type = (string) "cod";
            $rs = $order->save();
            if($rs){
                Session::flash('success', 'Đặt hàng thành công.');
                return true;
            }          
        } catch (\Exception $err){
            Session::flash('error', 'Đặt hàng không thành công !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}
