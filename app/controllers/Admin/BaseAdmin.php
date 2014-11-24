<?php
/**
 * Created by PhpStorm.
 * User: linroid
 * Date: 11/22/14
 * Time: 3:50 PM
 */

namespace Admin;

use Input;
use Program;
use Redirect;
use Request;
use Response;
use View;

class BaseAdmin extends \BaseController{


    function __construct()
    {
        if(!Request::is('admin/login')){
            $this->beforeFilter('auth');
        }
    }

    protected function view($view){
        return View::make('admin::'.$view);
    }
    protected function redirect($to){
        return Redirect::to('admin/'.$to);
    }
}