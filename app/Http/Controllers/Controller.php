<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Toxsl Tech Api Documentation",
 *     version="1.0.0",
 *     @OA\Contact(
 *         name="developer",
 *         email="shiv@toxsl.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *     @OA\Server(
 *     description="http",
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 *     )
 *     @OA\SecurityScheme(
 *     type="http",
 *     in="header",
 *     scheme="basic",
 *     name="Token based authentication",
 *     securityScheme="basicAuth"
 *     )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
