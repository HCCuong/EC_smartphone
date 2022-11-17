<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\User\CreateFormRequest;
use App\Http\Services\User\UserService;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_list', [
            'title'=>'Danh sách tài khoản người dùng: '. $this->userService->count(),
            'users'=>$this->userService->get(),
            'ur'=>''
        ]);
    }

    public function getAdmins()
    {
        return view('admin.admin_list', [
            'title'=>'Danh sách tài khoản quản trị',
            'users'=>$this->userService->getAdmins(),
            'ur'=>''
        ]);
    }

    public function getCustomers()
    {
        return view('admin.customer_list', [
            'title'=>'Danh sách tài khoản khách hàng',
            'users'=>$this->userService->getCustomers(),
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
        return view('admin.addAdminAccount',[
            'title'=>'Thêm tài khoản quản trị',
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
        $this->userService->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.admin_edit', [
            'title'=>'Chỉnh sửa tài khoản:  ' . $user->name,
            'user'=>$user,
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
    public function update(User $user, CreateFormRequest $request){
        $result = $this->userService->update($user, $request);
        if($result) return redirect('admin/admin_list');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse{
        dd($request->input('id'));
        $result = $this->productService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công tài khoản'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function getUserDetails($userid = 0){
        $user = User::find($userid);
        $html = "";
        $header = "";
        if(!empty($user)){
            $html .= "
                <tr>
                    <td width='40%'><b>Tên: </b></td>
                    <td width='60%'>".$user->name."</td>
                </tr>
                <tr>
                    <td width='40%'><b>Email: </b></td>
                    <td width='60%'>".$user->email."</td>
                </tr>
                <tr>
                    <td width='40%'><b>SDT: </b></td>
                    <td width='60%'>".$user->phone."</p>
                </tr>
                <tr>
                    <td width='40%'><b>Địa chỉ: </b></td>
                    <td width='60%'>".$user->address."</td>
                </tr>";

            $header .= "
                <tr>
                    <td width='40%'><a class='btn btn-danger btn-sm' href='logout'>Đăng xuất</a></td>
                </tr>";
        }
         return response()->json([
            'html' => $html
        ]);
     }
}
