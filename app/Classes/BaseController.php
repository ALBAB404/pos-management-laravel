<?php

namespace App\Classes;

use App\Classes\Helper;
use Illuminate\Routing\Controller;

class BaseController extends Controller{

    final public static function sendResponse($message = null, $status = null, $result = null)
    {
        return Helper::sendResponse($message, $status, $result);
    }

    final public static function sendError($message = null, $status = null)
    {
        return Helper::sendError($message, $status);
    }

}
