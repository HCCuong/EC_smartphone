<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Banner\BannerService;
use App\Http\Services\Product\ProductService;
use App\Models\Category;


class CustomerController extends Controller
{
    protected $categoryService;
    protected $bannerService;
    protected $productService;

    public function __construct(CategoryService $categoryService, BannerService $bannerService, ProductService $productService){
        $this->categoryService = $categoryService;
        $this->bannerService = $bannerService;
        $this->productService = $productService;
    }
    public function index(){
        return view('frontend.pages.index', [
            'title'=>'Trang chủ',
            'categories'=>$this->categoryService->getAll(),
            'banner'=>$this->bannerService->getAll(),
            'latests'=>$this->productService->lastProduct(),
            'topRateds'=>$this->productService->rateProduct(),
            'reviews'=>$this->productService->reviewProduct(),
        ]);
    }

    public function cart(){
        return view('frontend.pages.shop-cart');
    }

    public function product(Request $request){
        if($request->keyword)
        {
            return view('frontend.pages.shop-product', [
                'keyWord'=>$request->keyword,
                'cateID'=>'',
                'categories'=>$this->categoryService->getAll(),
                'latests'=>$this->productService->lastProduct()
            ]);
        }
        if($request->cateID)
        {
            return view('frontend.pages.shop-product', [
                'keyWord'=>'',
                'cateID'=>$request->cateID,
                'categories'=>$this->categoryService->getAll(),
                'latests'=>$this->productService->lastProduct()
            ]);
        }
        return view('frontend.pages.shop-product', [
            'keyWord'=>'',
            'cateID'=>'',
            'categories'=>$this->categoryService->getAll(),
            'latests'=>$this->productService->lastProduct()
        ]);

    }

    public function product_detail($idProduct){
        //$product=Product::find($idProduct);
        return view('frontend.pages.shop-product-detail',['productID'=>$idProduct]);
    }
    
    public function contact(){
        return view('frontend.pages.shop-contact');
    }
}
