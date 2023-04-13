<?php

namespace App\Http\Services\Banner;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BannerService
{
    public function create($request){
       try{
            Banner::create([
                'name' => (string) $request->input('name'),
                'url' => (string) $request->input('parent_id'),
                'status' => (int) $request->input('description'),
            ]);
            Session::flash('success', 'Tạo banner thành công');
       } catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
       }
       return true;
    }

    public function get(){
        return Banner::where('status', 1);
    }

    public function getAll(){
        //return Category::orderbyDesc('id', '>', 100)->cursorPaginate(100);
        return Banner::orderbyDesc('id', '>', 100)->cursorPaginate(100);
    }

    public function destroy($request){
        $banner = Banner::where('id', $request->input('id'))->get();
        if($banner){
            $banner->delete();
            return true;
        }
        return false;
    }

    public function update($request, $banner) : bool{
       try{
           $banner->name = (string) $request->input('name');
           $banner->status = (int) $request->input('status');
           $banner->url = (string) $request->input('url');
           $banner->save();

           Session::flash('success', 'Cập nhật banner thành công');
       } catch (\Exception $err) {
           Session::flash('error', $err->getMessage());
           return false;
       }
       return true;
    }

    public function count(){
        return Banner::query()->count();
    }
}
