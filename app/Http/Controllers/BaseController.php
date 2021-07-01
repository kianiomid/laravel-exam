<?php

namespace App\Http\Controllers;


class BaseController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel OpenApi Demo Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url="http://localhost:8000/api/",
     *      description="Demo API Server"
     * )
     *
     * @OA\Tag(
     *     name="users",
     *     description="API Endpoints of Users"
     * )
     *
     *
     * @OA\Schema(
     *       schema="Users",
     *       @OA\Property(property="id", type="string"),
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="mobile", type="string"),
     *       @OA\Property(property="created_at", type="date"),
     *       @OA\Property(property="updated_at", type="date-time"),
     *   ),
     *
     */
}
