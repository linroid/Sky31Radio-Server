<?php
namespace Api;


use Input;
use Program;
use Response;

class ProgramController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /program
	 *
	 * @return Response
	 */
	public function index()
	{
		$author = Input::get('author');
        $programs = Program::where('author', 'like', "%{$author}%");
        return Response::json($programs);
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /program
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$program = Program::findOrFail($id);
        $program->setHidden(array_diff($program->hidden, ['article']));
        return Response::json($program);
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
		//
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
		//
	}

}