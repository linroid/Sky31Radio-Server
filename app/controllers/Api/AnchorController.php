<?php
/**
 * Created by PhpStorm.
 * User: linroid
 * Date: 12/17/14
 * Time: 11:47 PM
 */

namespace Api;

use Program;
use Response;
use User;

class AnchorController extends \BaseController{

    /**
     * Display a listing of the resource.
     * GET /anchor
     *
     * @return Response
     */
    public function index()
    {
        $users = User::whereRole('anchor')
            ->orWhere('role', 'admin')
            ->with('programCountRelation')
            ->get();
        return Response::json($users);
    }
    /**
     * Display the specified resource.
     * GET /anchor/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $programs = Program::whereUserId($id)
            ->with('audio')
            ->orderBy('created_at', 'desc')
            ->get();

        return Response::json($programs);
    }


}