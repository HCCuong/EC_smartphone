<?php

namespace App\Http\Services\Product;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService
{
    public function create($request){
       try{
            Product::create([
                'name' => (string) $request->input('name'),
                'price' => (int) $request->input('price'),
                'price_sale' => (int) $request->input('price_sale'),
                'cate_id' => (int) $request->input('cate_id'),
                'packet' => (string) $request->input('packet'),
                'review' => (string) $request->input('review'),
                'images' => (string) $request->input('file'),
                'active' => (string) $request->input('active'),
                'quantity' => (int) $request->input('quantity'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
            Session::flash('success', 'Tạo sản phẩm thành công');
       } catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
       }
       return true;
    }

    public function get()
    {
        return Product::with('category')->orderbyDesc('id', 0)->cursorPaginate(1000);
        //return Product::orderbyDesc('id', '>', 100)->cursorPaginate(15);
    }

    public function getAll()
    {
        return Product::with('category')->orderbyDesc('id', 0)->simplePaginate(9);
        //return Product::orderbyDesc('id', '>', 100)->cursorPaginate(15);
    }

    protected function isValidPrice($request){
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
        && $request->input('price_sale') <= $request->input('price')){
            Session::flash('error', 'Giá bán phải lớn hơn giá gốc của sản phẩm !');
            return false;
        }

        if ((int)$request->input('price') == 0 && $request->input('price_sale') != 0){
            Session::flash('error', 'Vui lòng nhập giá gốc !');
            return false;
        }
        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if (!$isValidPrice) return false;
        //dd($request->all());
        try {
            $request->except('_token');
            Product::create([
                'name' => (string) $request->input('name'),
                'price' => (int) $request->input('price'),
                'price_sale' => (int) $request->input('price_sale'),
                'cate_id' => (int) $request->input('cate_id'),
                'packet' => (string) $request->input('packet'),
                'review' => (string) $request->input('review'),
                'images' => (string) $request->input('file'),
                'active' => (string) $request->input('active'),
                'quantity' => (int) $request->input('quantity'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);

            $id = Product::where('name', $request->input('name'))->first()->id;

            ProductDetail::create([
                'cpu' => (string) $request->input('cpu'),
                'ram' => (string) $request->input('ram'),
                'screen' => (string) $request->input('screen'),
                'storage' => (string) $request->input('storage'),
                'exten_memmory' => (string) $request->input('exten_memmory'),
                'cam1' => (string) $request->input('cam1'),
                'cam2' => (string) $request->input('cam2'),
                'sim' => (string) $request->input('sim'),
                'connect' => (string) $request->input('connect'),
                'pin' => (string) $request->input('pin'),
                'os' => (string) $request->input('os'),
                'note' => (string) $request->input('review'),
                'pro_id' => (int) $id
            ]);

            Session::flash('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $err){
            Session::flash('error', 'Thêm sản phẩm không thành công !!!');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($product, $request){
        $isValidPrice = $this->isValidPrice($request);
        if (!$isValidPrice) return false;
        try {
            $id = (int) ProductDetail::where('pro_id', $product->id)->first()->id;
            $product->fill($request->input());
            $product->save();
            $productdetail = ProductDetail::find($id);
            $productdetail->fill([
                'cpu' => (string) $request->input('cpu'),
                'ram' => (string) $request->input('ram'),
                'screen' => (string) $request->input('screen'),
                'storage' => (string) $request->input('storage'),
                'exten_memmory' => (string) $request->input('exten_memmory'),
                'cam1' => (string) $request->input('cam1'),
                'cam2' => (string) $request->input('cam2'),
                'sim' => (string) $request->input('sim'),
                'connect' => (string) $request->input('connect'),
                'pin' => (string) $request->input('pin'),
                'os' => (string) $request->input('os'),
                'note' => '',
                'pro_id' => (int) $product->id
            ]);
            $productdetail->save();
            Session::flash('success', 'Câp nhật sản phẩm thành công.');
        } catch (\Exception $err){
            Session::flash('error', 'Cập nhật sản phẩm thất bại !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();
        $productdetail = ProductDetail::where('pro_id', $request->input('id'))->first();
        if($product && $productdetail){
            $product->delete();
            $productdetail->delete();
            return true;
        }
        return false;
    }

    
    public function count(){
        return Product::query()->count();
    }

    public function getDetail($request){
        return ProductDetail::where('pro_id', $request)->first();
    }

    public function lastProduct()
    {
        return Product::latest()->take(3)->get();
    }
    public function rateProduct()
    {
        return Product::inRandomOrder()->take(3)->get();
    }
    public function reviewProduct()
    {
        return Product::inRandomOrder()->take(3)->get();
    }
    public function relatedProduct()
    {
        return Product::inRandomOrder()->take(3)->get();
    }

    public function getByCategory($request){
        return Product::with('category')->where('cate_id', $request)->simplePaginate(9);
    }

    public function getProductSale(){
        return Product::with('category')->where('price_sale', '<>', NULL)->get();
    }


    public function fill($request)
    {
        //console.log($request->keyword);
        if($request->sort){
            return Product::where('slug','like','%'.$request->keyword.'%')  
            ->orWhere('name','like','%'.$request->keyword.'%')
            ->orderBy('name',$request->sort)
            ->simplePaginate(9);
        }
        else{
            return Product::where('slug','like','%'.$request->keyword.'%')  
            ->orWhere('name','like','%'.$request->keyword.'%')
            ->simplePaginate(9);
        }         
    }
}
