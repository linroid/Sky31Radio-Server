<?php
namespace Admin;

use File;
use Input;
use Redirect;
use Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use User;
use Validator;

class UserController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::paginate(15);
        return $this->view('user.index')
            ->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return $this->view('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $rules = array(
            'nickname' => 'required',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|unique:users',
            'role'  => 'required|in:admin,anchor,normal',
            'avatar' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $messages = array(
            'avatar.mimes'       => '允许上传的封面图片格式::mimes',
            'avatar.max'         => '导图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $user = new User($data);
        if(Input::hasFile('avatar')){
            /**
             * @var UploadedFile $avatar_file
             */
            $avatar_file = $data['avatar'];

            $avatar_path = 'uploads/avatar/'.date('Y/m/d/',time());
            $file_path = 'public/'.$avatar_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$avatar_file->getClientOriginalName();
            $avatar_file->move($file_path, $filename);
            $user->avatar = $avatar_path.$filename;
        }
        $user->save();
        return $this->redirect('user')->withFlashMessage("添加用户 [{$user->nickname}] 成功");
    }

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::find($id);
		return $this->view('user.edit')
            ->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        /**
         * @var User $user
         */
        $user = User::find($id);
        $data = Input::all();
        $rules = array(
            'nickname' => 'required',
            'password' => 'min:6|confirmed',
            'email' => 'required|email',
            'role'  => 'required|in:admin,anchor,normal',
            'avatar' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $messages = array(
            'avatar.mimes'       => '允许上传的封面图片格式::mimes',
            'avatar.max'         => '导图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if(Input::hasFile('avatar')){
//            /**
//             * @var UploadedFile $avatar_file
//             */
//            $avatar_file = $data['avatar'];
//
//            $avatar_path = 'uploads/avatar/'.date('Y/m/d/',time());
//            $file_path = 'public/'.$avatar_path;
//            if(!File::exists($file_path)){
//                File::makeDirectory($file_path, 0777, true, true);
//            }
            if(!empty($user->avatar)){
                File::delete('public/'.$user->avatar);
            }
//            $filename = str_random(5).'_'.$avatar_file->getClientOriginalName();
//            $avatar_file->move($file_path, $filename);
//            $user->avatar = $avatar_path.$filename;
            $user->avatar = $this->savePicture('avatar');
        }
        if(empty($data['password'])){
            unset($data['password']);
        }
        $user->fill($data);
        $user->save();
        return $this->redirect('user')->withFlashMessage("修改用户 [{$user->nickname}] 成功");
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(\Auth::id()==$id){
            return Redirect::back()->withFlashMessage('您不能删除自己')->withFlashType('danger');
        }
        if(!User::whereId($id)->delete()){
            return Redirect::back()->withFlashMessage('删除用户失败')->withFlashType('danger');
        }

        return Redirect::back()->withFlashMessage('删除用户成功');
    }
    private function savePicture($name){
        /**
         * @var UploadedFile $cover_file
         */
        $cover_file = Input::file($name);

        $picture_path = 'uploads/'.$name.'/'.date('Y/m/d/',time());
        $file_path = app_path().'/../public/'.$picture_path;
        if(!File::exists($file_path)){
            File::makeDirectory($file_path, 0777, true, true);
        }
        $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
        $cover_file->move($file_path, $filename);
        return $picture_path.$filename;
    }

}