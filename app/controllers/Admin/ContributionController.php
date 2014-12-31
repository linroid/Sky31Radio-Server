<?php

namespace Admin;

use Contribution;
use Response;

class ContributionController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /contribution
	 *
	 * @return Response
	 */
	public function index()
	{
		$contributions = \Contribution::orderBy('created_at', 'desc')
            ->with('program')
            ->paginate(15);
        return $this->view('contribution.index')
            ->with('contributions', $contributions);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /contribution/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /contribution
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /contribution/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /contribution/{id}/edit
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
	 * PUT /contribution/{id}
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
	 * DELETE /contribution/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(Contribution::whereId($id)->delete()){
            return Contribution::back()->withFlashMessage('删除成功');
        }
        return Contribution::back()->withFlashMessage('删除失败')->withFlashType('danger');
	}

}