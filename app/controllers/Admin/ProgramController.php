<?php
namespace Admin;

use Album;
use Audio;
use Auth;
use File;
use Input;
use Program;
use Redirect;
use Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use View;

class ProgramController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /program
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /program/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $albums = [];
        $albums['season'] = Album::seasons()->get()->toArray();
        $albums['activity'] = Album::activities()->get()->toArray();

		return $this->view('program.create')
            ->with('albums', $albums);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /program
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
        $rules = array(
            'title' => 'required',
            'album_id'=>'required|exists:albums,id',
            'audio' => 'mimes:mpga|max:2048000',//20M
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $message = array(
            'title.required'    => '标题必须!',
            'album_id.required' => '请选择所属分类',
            'album_id.exists'   => '分类不存在',
            'audio.mimes'       => '请上传正确的音频文件',
            'audio.max'         => '音频文件大小应小于 :maxkb',
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $message);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $program = new Program($data);
        $program->user_id = Auth::id();

        if(Input::hasFile('cover')){
            /**
             * @var UploadedFile $cover_file
             */
            $cover_file = $data['cover'];

            $cover_path = 'uploads/cover/'.date('Y/m/d/',time());
            $file_path = 'public/'.$cover_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
            $cover_file->move($file_path, $filename);
            $program->cover = $cover_path.$filename;
        }
        $program->save();

        if(Input::hasFile('audio')){
            /**
             * @var UploadedFile $audio_file
             */
            $audio_file = $data['audio'];

            $audio_path = 'uploads/audio/'.date('Y/m/d/',time());
            $file_path = 'public/'.$audio_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$audio_file->getClientOriginalName();
            $file = $audio_file->move($file_path, $filename);

            $audio = new Audio();
            $audio->size = $audio_file->getSize();
            $audio->path = $audio_path.$filename;
            $audio->duration;
            $program->audio()->save($audio);
        }
        return $this->redirect('album/'.$program->album_id)
            ->withFlashMessage('添加节目成功');

	}

	/**
	 * Display the specified resource.
	 * GET /program/{id}
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
	 * GET /program/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $program = Program::find($id);
        $albums = [];
        $albums['season'] = Album::seasons()->get()->toArray();
        $albums['activity'] = Album::activities()->get()->toArray();


        return $this->view('program.edit')
            ->with('program', $program)
            ->with('albums', $albums);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /program/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        /**
         * @var Program $program
         */
        $program = Program::find($id);
		$data = Input::all();

        $rules = array(
            'title' => 'required',
            'album_id'=>'required|exists:albums,id',
            'audio' => 'mimes:mpga|max:2048000',//20M
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $message = array(
            'title.required'    => '标题必须!',
            'album_id.required' => '请选择所属分类',
            'album_id.exists'   => '分类不存在',
            'audio.mimes'       => '请上传正确的音频文件',
            'audio.max'         => '音频文件大小应小于 :maxkb',
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $message);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $program->fill($data);
        if(Input::hasFile('cover')){
            if(!empty($program->cover)){
                File::delete('public/'.$program->cover);
            }
            $program->cover = $this->saveCover();
        }
        $program->save();

        if(Input::hasFile('audio')){
            Audio::whereProgramId($program->id)->delete();
            if(!empty($program->path)){
                File::delete('public/'.$program->path);
            }
            $this->saveAudio($program);
        }
        return $this->redirect('album/'.$program->album_id)
            ->withFlashMessage('修改节目成功');
    }
    private function saveCover(){
        /**
         * @var UploadedFile $cover_file
         */
        $cover_file = Input::file('cover');

        $cover_path = 'uploads/cover/'.date('Y/m/d/',time());
        $file_path = 'public/'.$cover_path;
        if(!File::exists($file_path)){
            File::makeDirectory($file_path, 0777, true, true);
        }
        $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
        $cover_file->move($file_path, $filename);
        return $cover_path.$filename;
    }
    private function saveAudio(Program $program){
        /**
         * @var UploadedFile $audio_file
         */
        $audio_file = Input::file('audio');

        $audio_path = 'uploads/audio/'.date('Y/m/d/',time());
        $file_path = 'public/'.$audio_path;
        if(!File::exists($file_path)){
            File::makeDirectory($file_path, 0777, true, true);
        }
        $filename = str_random(5).'_'.$audio_file->getClientOriginalName();
        $audio_file->move($file_path, $filename);

        $audio = new Audio();
        $audio->size = $audio_file->getSize();
        $audio->path = $audio_path.$filename;
        $audio->duration;
        $program->audio()->save($audio);
        return $audio->path;
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /program/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Program::whereId($id)->delete()){
            return Redirect::back()->withFlashMessage('删除成功');
        }
        return Redirect::back()->withFlashMessage('删除失败')->withFlashType('danger');

    }

}