<?php

namespace App\Http\Services\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderDetailService
{
    public function create($id, $request){
        try{
             OrderDetail::create([                
                 'pro_id' => (int) $request->input('product_id'),
                 'qty' => (int) $request->input('qty'),
                 'o_id' => (int) $id
             ]);
             Session::flash('success', 'Đã thêm sản phẩm vào giỏ hàng');
        } catch (\Exception $err){
             Session::flash('error', $err->getMessage());
             return false;
        }
        return true;
    }

    public function update($request){
        try {
            $detail = OrderDetail::find($request->id);
            $detail->qty = $request->quantity;
            $rs = $detail->save();
            if($rs){
                Session::flash('success', 'Câp nhật số lượng thành công.');
                return true;
            }          
        } catch (\Exception $err){
            Session::flash('error', 'Cập nhật số lượng thất bại !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }


    public function delete($request){
        $detail = OrderDetail::where('id', $request->input('id'))->delete();
        if($detail) return true;
        return false;
    }

    public function deleteAll($o_id){
        $details = OrderDetail::where('id', $o_id)->delete();
        if($details) return true;
        return false;
    }

    public function get($request){
        return OrderDetail::with('product')->where('o_id', $request)->get();
    }

    public function count($request){
        return OrderDetail::with('product')->where('o_id', $request)->count();
    }
}
