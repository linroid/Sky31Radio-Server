<?php
namespace Admin;

use Response;

class LuckyController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /lucky
	 *
	 * @return Response
	 */
	public function index()
	{
		$luckys = \Visitor::whereNotNull('lucky_key')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return $this->view('lucky.index')
            ->with('luckys', $luckys);
	}


}