<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Failoverconfig;

class FailoverconfigsController extends ExController
{

  

    public function index()
    {
        $configs = Failoverconfig::all();
        return view('express.welcome');

    }

    
    public function update(Request $request, $id)
    {
        $configs = Failoverconfig::find($id);
        if (empty($configs)) {
            return $this->respondNotFound('Item does not exists.');
        }

        $validator = \Validator::make(
            [
                'name'        => $request->name,
                'var1' => $request->var1,
            ],
            [
                'name'        => 'required|string|min:6',
                'var1' => 'required|interger',
            ]
        );

        if ($validator->fails()) {
            $messages = [];

            foreach ($validator->errors()->all() as $error) {
                $messages[] = $error;
            }

            return $this->respondValidationFailed(implode(' ', $messages). ' name: '. $request->name);
        }

        $item->update($request->all());

        return $this->respondUpdated();
    }


    public function respondValidationFailed($message = 'Validation Failed.')
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }
}
