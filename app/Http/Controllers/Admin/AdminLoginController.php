<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class AdminLoginController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }
    public function postLogin(AdminLoginRequest $request){
        $remember_me = $request->has('remember_me') ? true : false;;
        if(auth()->guard('admin')->attempt(['email'=> $request->input('email'), 'password' => $request->input('password')], $remember_me)){
            //notify()->success('تم التسجيل بنجاح.');
            return redirect()->route('admin.dashboard');
        }
        //notify()->error('خطأ في البيانات برجاء المحاولة مرة اخري.');
        return redirect()->back()->withInput($request);
    }
}
