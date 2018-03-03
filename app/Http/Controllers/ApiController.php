<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Response as Response;

class ApiController extends Controller
{

    protected $statusCode = Response::HTTP_OK;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondNotFound($message = 'Not Found.')
    {
        return $this->setStatusCode(Response::HTTP_BAD_REQUEST)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error.')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    public function respondValidationFailed($message = 'Validation Failed.')
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    public function respondCreated($message = 'Item successfully created.')
    {
        return $this->setStatusCode(Response::HTTP_CREATED)->respondWithSuccess($message);
    }

    public function respondUpdated($message = 'Item successfully updated.')
    {
        return $this->setStatusCode(Response::HTTP_ACCEPTED)->respondWithSuccess($message);
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message'     => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }

    public function respondWithSuccess($message)
    {
        return $this->respond([
            'success' => [
                'message'     => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }

}