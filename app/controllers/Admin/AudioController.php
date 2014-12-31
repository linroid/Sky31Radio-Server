<?php
namespace Admin;

use Audio;
use Response;

class AudioController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /audio
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /audio/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /audio
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /audio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        /**
         * @var Audio $audio
         */
        $audio = Audio::find($id);
        header('Content-Type:audio/mpeg');
        readfile('public/'.$audio->path);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /audio/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /audio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /audio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}