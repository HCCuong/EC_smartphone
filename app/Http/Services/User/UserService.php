<?php

namespace App\Http\Services\User;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{

    public function get()
    {
        return User::orderbyDesc('id', '>', 100)->cursorPaginate(100);
    }


    public function getAdmins()
    {
        return User::where('level', 2)->cursorPaginate(100);
    }

    public function getCustomers()
    {
        return User::where('level', 1)->cursorPaginate(100);
    }

    public function insert($request){
        try {
            $request->except('_token');
            User::create([
                'name' => (string) $request->input('name'),
                'password' => bcrypt($request->input('password')),
                'email' => (string) $request->input('email'),
                'phone' => (int) $request->input('phone'),
                'address' => (string) $request->input('address'),
                'status' => 1,
                'level' => 2
            ]);
            Session::flash('success', 'Thêm tài khoản thành công');
        } catch (\Exception $err){
            Session::flash('error', 'Thêm tào khoản lỗi !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($user, $request){
        try {
            $user->fill($request->input());
            $user->save();
            Session::flash('success', 'Câp nhật tài khoản thành công');
        } catch (\Exception $err){
            Session::flash('error', 'Cập nhật tài khoản thất bại !');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){
        $user = User::where('id', $request->input('id'))->first();
        if($user){
            $user->delete();
            return true;
        }
        return false;
    }

    public function count(){
        return User::query()->count();
    }
}
