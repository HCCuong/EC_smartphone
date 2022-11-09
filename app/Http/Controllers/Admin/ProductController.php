<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Product\ProductService;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    protected $categoryService;
    protected $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService){
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product_list', [
            'title'=>'Danh sách sản phẩm: '. $this->productService->count(),
            'products'=>$this->productService->get(),
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
        return view('admin.product_add', [
            'title'=>'Thêm sản phẩm',
            'categories'=>$this->categoryService->getParent(),
            'ur'=>''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request){
        $this->productService->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //dd($this->productService->getDetail($product->id));
        return view('admin.product_edit', [
            'title'=>'Chỉnh sửa sản phẩm:  ' . $product->name,
            'product'=>$product,
            'product_detail'=>$this->productService->getDetail($product->id),
            'categories'=>$this->categoryService->getParent(),
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
    public function update(Product $product, CreateFormRequest $request){
        $result = $this->productService->update($product, $request);
        if($result) return redirect('admin/product_list');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse{
        $result = $this->productService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function getProductDetails($productid = 0){
        $product = Product::find($productid);
        //$orderdetails = OrderDetail::find($orderid);
        $productdetails = $this->productService->getDetail($productid);
        $html = "";
        if(!empty($product)){
            $html .= "
                <div class='row m-2'>
                    <div class='col-md-5'>
                        <img width='280px' height='300px' src='https://www.beeart.vn/uploads/file/images/blog/apple/bee_art_logo_apple_2%20copy.jpg'>
                    </div>
                    <div class='col-md-7 pl-2'>
                        <p><b>Tên sản phẩm:</b> $product->name</p>
                        <p><b>Thuộc loại: </b>".$product->category->name."</p>
                        <p><b>Đơn giá: </b>$product->price</p>
                        <p><b>Phụ kiện: </b>$product->packet</p>
                        <p><b>Mô tả: </b>$product->review</p>
                    </div>
            ";

            if(!empty($productdetails)){
                foreach($productdetails as $val){
                    $html .= "
                        <div class='m-3'>
                            <h5>Thông tin cấu hình</h5>  
                        </div>
                    </div>";
                }
            }else{
                $html .= "</div>";
            }
            return response()->json([
            'html' => $html
            ]);
        }
    }
}
