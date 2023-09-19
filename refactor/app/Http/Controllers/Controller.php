<?php

namespace DTApi\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function handleException($e)
    {
        $class_name = get_class($e);

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            //above we can also check $e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ], $e->getStatusCode());
        } else if ($class_name == "Illuminate\Validation\ValidationException") {
            return response([
                "success" => false,
                "message" => $e->getMessage(),
                "errors" => $e->errors(),
            ], 422);
        } else {
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
