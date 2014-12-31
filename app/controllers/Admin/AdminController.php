<?php
/**
 * Created by PhpStorm.
 * User: linroid
 * Date: 11/16/14
 * Time: 1:41 PM
 */

namespace Admin;

use Auth;
use Input;
use Option;
use Redirect;
use View;

class AdminController extends BaseAdmin{
    public function index(){
        return View::make('admin::index');
    }
    public function getLogin(){
        return View::make('admin::login');
    }
    public function postLogin(){
        $credentials = Input::only('email','password');
        if (\Auth::attempt($credentials, true))
        {
            return Redirect::to(route('admin.home'))->withFlashMessage('登录成功');
        }
        return Redirect::back()->withFlashMessage("登录失败")->withFlashType('danger');
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('/admin/login')->withFlashMessage('退出成功');
    }
    public function setting(){
        return $this->view('setting');
    }
    public function update(){
        $data = Input::all();
        foreach($data as $key=>$value){
            Option::whereKey($key)->update(['value'=>$value]);
        }
        return Redirect::route('admin.setting')->withFlashMessage('修改系统设置成功');
    }
} 