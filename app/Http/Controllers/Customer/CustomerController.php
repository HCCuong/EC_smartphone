<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;
use App\Models\Category;


class CustomerController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    public function index(){
        return view('frontend.pages.index', [
            'title'=>'Trang chủ',
            'categories'=>$this->categoryService->getAll()      
        ]);
    }

    public function cart(){
        return view('frontend.pages.shop-cart');
    }

    public function product(Request $request){
        if($request->keyword)
        {
            return view('frontend.pages.shop-product',['keyWord'=>$request->keyword,'cateID'=>'']);
        }
        if($request->cateID)
        {
            return view('frontend.pages.shop-product',['keyWord'=>'','cateID'=>$request->cateID]);
        }
        return view('frontend.pages.shop-product',['keyWord'=>'','cateID'=>'']);

    }

    public function product_detail($idProduct){
        //$product=Product::find($idProduct);
        return view('frontend.pages.shop-product-detail',['productID'=>$idProduct]);
    }
    
    public function contact(){
        return view('frontend.pages.shop-contact');
    }
}
