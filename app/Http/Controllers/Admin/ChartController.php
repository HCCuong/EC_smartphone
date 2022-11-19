<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Category;

use DB;

class ChartController extends Controller
{
    public function index(){
       return view('pie_chart');
    }

    public function fetch_data(){
         $data = OrderDetail::select(DB::raw('COUNT(*) as total_sales, categories.name'))
        ->join('products', 'products.id', '=', 'order_details.pro_id' )
        ->join('categories', 'categories.id', '=', 'products.cate_id' )
        ->groupBy('name')->get();

        foreach ($data->toArray() as $row) {
            $output[] = array(
                'name' => $row['name'],
                'total_sales' => $row['total_sales']
            );
        }
        echo json_encode($output);
    }
}
