<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Response as Response;

class EXController extends Controller
{
    //application base controller
    protected $actionCode = 1;

    public function getActionCode()
    {
        return $this->actionCode;
    }

    public function setActionCode($actionCode)
    {
        $this->actionCode = $actionCode;
        return $this;
    }
    
    public function respondWithMessage($message)
    {
        return $this->respond([
            'error' => [
                'message'     => $message,
                'action_code' => $this->getActionCode(),
            ],
        ]);
    }

}