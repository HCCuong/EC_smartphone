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
                    <div class='col-md-6 pl-4'>
                        <img width='300px' height='300px' src='https://www.beeart.vn/uploads/file/images/blog/apple/bee_art_logo_apple_2%20copy.jpg'>
                    </div>
                    <div class='col-md-6 pl-2'>
                        <p><b>Tên sản phẩm:</b> $product->name</p>
                        <p><b>Thuộc loại: </b>".$product->category->name."</p>
                        <p><b>Số lượng: </b>$product->quantity</p>
                        <p><b>Đơn giá: </b>$product->price</p>
                        <p><b>Phụ kiện: </b>$product->packet</p>
                        <p><b>Mô tả: </b>$product->review</p>
                    </div>
            ";

            if(!empty($productdetails)){
                foreach($productdetails as $val){
                    $html .= "
                        <div class='row m-1'>
                            <h5 class='pt-3'>Thông tin cấu hình</h5>  
                            <div class='col-md-6'>
                                <p><b>CPU:</b> $val->cpu</p>
                                <p><b>RAM:</b> $val->ram</p>
                                <p><b>Màn hình:</b> $val->screen</p>
                                <p><b>Bộ nhớ lưu trữ:</b> $val->storage</p>
                                <p><b>Bộ nhớ mở rộng:</b> $val->exten_memmory</p>
                                <p><b>Kết nối mạng:</b> $val->connect</p>
                            </div>
                            <div class='col-md-6 pl-2'>
                                <p><b>Camera trước:</b> $val->cam1</p>
                                <p><b>Camera sau:</b> $val->cam2</p>
                                <p><b>Sim:</b> $val->sim</p>
                                <p><b>Dung lượng pin:</b> $val->pin</p>
                                <p><b>Hệ điều hành:</b> $val->os</p>
                            </div>
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
