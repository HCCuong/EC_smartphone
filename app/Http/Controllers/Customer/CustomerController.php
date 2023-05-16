<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Banner\BannerService;
use App\Http\Services\Product\ProductService;
use App\Models\Category;
use App\Models\Product;


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
            'ur'=>''
        ]);
    }


    public function product(Request $request){
        if($request->keyword)
        {
            return view('frontend.pages.shop-product', [
                'keyWord'=>$request->keyword,
                'cateID'=>'',
                'categories'=>$this->categoryService->getAll(),
                'latests'=>$this->productService->lastProduct(),
                'products'=>$this->productService->fill($request),
                'product_sales'=>$this->productService->getProductSale(),
                'ur'=>''
            ]);
        }
        if($request->cateID)
        {
            return view('frontend.pages.shop-product', [
                'keyWord'=>'',
                'cateID'=>$request->cateID,
                'categories'=>$this->categoryService->getAll(),
                'latests'=>$this->productService->lastProduct(),
                'products'=>$this->productService->getByCategory($request->cateID),
                'product_sales'=>$this->productService->getProductSale(),
                'ur'=>''
            ]);
        }
        return view('frontend.pages.shop-product', [
            'keyWord'=>'',
            'cateID'=>'',
            'categories'=>$this->categoryService->getAll(),
            'latests'=>$this->productService->lastProduct(),
            'products'=>$this->productService->getAll(),
            'product_sales'=>$this->productService->getProductSale(),
            'ur'=>''
        ]);

    }

    public function product_detail(Product $product){
        //$product=Product::find($idProduct);
        return view('frontend.pages.shop-product-detail', [
            'product'=>$product,
            'product_detail'=>$this->productService->getDetail($product->id),
            'categories'=>$this->categoryService->getAll(),
            'banner'=>$this->bannerService->getAll(),
            'relate_products'=>$this->productService->relatedProduct(),
            'ur'=>'../'
        ]);
    }
    
    public function contact(){
        return view('frontend.pages.shop-contact', [
            'ur'=>''
        ]);
    }
}
