<?php

class ApiController extends \BaseController {
    public function getAll(){
//        $albums = Album::with('programs')->with('programs.audio')->get();

        $data = [];
        $data['seasons'] = Album::seasons()
            ->with('programs')
            ->with('programs.audio')
            ->with('programs.totalPlayRelation')

            ->get();
        $data['activities'] = Album::activities()
            ->with('programs')
            ->with('programs.audio')
            ->with('programs.totalPlayRelation')
            ->get();
//        return Response::xml($data->toArray());
        return Response::json($data);
    }
    public function getNewest(){
        $programs = Program::orderBy('created_at', 'desc')
            ->with('audio')
            ->with('album')->paginate(30);
        return Response::json($programs);
    }
    public function getAudio($id){
        /**
         * @var Audio $audio
         */
        $audio = Audio::find($id);
        $download = Input::has('download') ? true : false;
        if(!$download){
            $playLog = new PlayLog();
            $playLog->program_id = $audio->program_id;
            $playLog->ip = Request::ip();
            $playLog->save();
            header('Content-Type:audio/mpeg');
//            readfile(app_path().'/../public/'.$audio->path);
             return Redirect::away($audio->url . "?r=" . rand());
        }else {
            return Redirect::away($audio->url);
//            return Response::download(app_path().'/../public/'.$audio->path);
        }
//        return Redirect::to($audio->url);
    }
    public function getSearch(){
        $keyword = Input::get('keyword');
        $programs = Program::where('title', 'like', "%{$keyword}%")
            ->whereVisible(1)
            ->orderBy('created_at', 'desc')
            ->get();
        return Response::json($programs);
    }
    public function getVisitor(){
        $visitor = Visitor::track();
        return Response::json($visitor);
    }
    public function postVisitor(){

        $visitor = Visitor::obtain();
        if(empty($visitor->lucky_key)){
            return Response::json(array(
                    'error'=>true,
                    'message'=>'您没有中奖'
                ), 400);
        }
        $data = Input::all();
        $rules = array(
            'school'=>'required',
            'phone'=>'required',
            'info'=>'required',
            'name'=>'required'
        );
        $messages = array(
            'school.required'=>'请填写您的学校',
            'phone.required'=>'请填写您的手机号码',
            'info.required'=>'请填写您的院系信息',
            'name.required'=>'请填写您的姓名',
        );
        $validator = Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Response::json(array(
                'error' => true,
                'message'=>$validator->errors()->first()
                ), 400);
        }
        $visitor->fill($data);
        $visitor->save();
        return Response::json($visitor);
    }
}