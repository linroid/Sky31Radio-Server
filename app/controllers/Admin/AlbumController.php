<?php
namespace Admin;

use Album;
use Auth;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;
use Redirect;
use Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use View;

class AlbumController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /album
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Input::has('type')){
            $albums = Album::whereType(Input::get('type'))->paginate(15);
        }else{
            $albums = Album::paginate(15);
        }
		return $this->view('album.index')
            ->with('albums', $albums);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /album/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('album.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /album
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
        $rules = array(
            'name'=>'required|min:1',
            'type'=>'required|in:season,activity',
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $messages = [
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb'
        ];
        $validator = \Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $album = new Album($data);

        if(Input::hasFile('cover')){
            /**
             * @var UploadedFile $cover_file
             */
            $cover_file = $data['cover'];

            $cover_path = 'uploads/album_cover/'.date('Y/m/d/',time());
            $file_path = 'public/'.$cover_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
            $cover_file->move($file_path, $filename);
            $album->cover = $cover_path.$filename;
        }

        $album->save();
        return $this->redirect('album')->withFlashMessage("创建专题 [{$album->name}] 成功");

	}

	/**
	 * Display the specified resource.
	 * GET /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try{
            /**
             * @var \Album $album;
             */
            $album = \Album::findOrFail($id);
            $model = $album->programs()
                ->with('user')
                ->with('totalPlayRelation')
                ->orderBy('created_at', 'desc');
            if(Auth::check() && !Auth::user()->is('admin')){
                $model->whereUserId(Auth::user()->id);
            }
            $programs = $model->paginate(10);
            return View::make('admin::album.show')
                ->with('album', $album)
                ->with('programs',$programs)
                ->with('active', $album->type);
        }catch (ModelNotFoundException $e){

        }
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /album/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$album = Album::find($id);
        return $this->view('album.edit')
            ->with('album', $album);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        /**
         * @var Album $album
         */
        $album = Album::find($id);

        $data = Input::all();
        $rules = array(
            'name'=>'required|min:1',
            'type'=>'required|in:season,activity',
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $messages = [
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb'
        ];
        $validator = \Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput()->with('album', $album);
        }
        if(Input::hasFile('cover')){
            /**
             * @var UploadedFile $cover_file
             */
            $cover_file = $data['cover'];

            $cover_path = 'uploads/album_cover/'.date('Y/m/d/',time());
            $file_path = 'public/'.$cover_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
            $cover_file->move($file_path, $filename);
            $album->cover = $cover_path.$filename;
        }
        $album->fill($data);
        $album->save();
        return $this->redirect('album')->withFlashMessage("修改专题 [{$album->name}] 成功");
	}
    /**
     * Remove the specified resource from storage.
     * DELETE /album/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(Album::whereId($id)->delete()){
            return Redirect::back()->withFlashMessage('删除成功');
        }
        return Redirect::back()->withFlashMessage('删除失败')->withFlashType('danger');

    }

}