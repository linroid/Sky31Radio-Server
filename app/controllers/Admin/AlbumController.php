<?php
namespace Admin;

use Album;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;
use Redirect;
use Response;
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
            'type'=>'required|in:season,activity'
        );
        $messages = [];
        $validator = \Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $album = new Album($data);
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
            $programs = $album->programs()->with('user')->orderBy('created_at', 'desc')->paginate(10);
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
            'type'=>'required|in:season,activity'
        );
        $messages = [];
        $validator = \Validator::make($data, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput()->with('album', $album);
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