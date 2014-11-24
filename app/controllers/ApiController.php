<?php

class ApiController extends \BaseController {
    public function getAll(){
//        $albums = Album::with('programs')->with('programs.audio')->get();

        $data = [];
        $data['seasons'] = Album::seasons()->with('programs')->with('programs.audio')->get();
        $data['activities'] = Album::activities()->with('programs')->with('programs.audio')->get();
//        return Response::xml($data->toArray());

        header('Access-Control-Allow-Origin: *');
        return Response::json($data);
    }
    public function getAudio($id){
        /**
         * @var Audio $audio
         */
        $audio = Audio::find($id);
        header('Content-Type:audio/mpeg');
        readfile('public/'.$audio->path);
    }
}