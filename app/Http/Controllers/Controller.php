<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Atom Forge Construction API",
    version: "1.0.0",
    description: "API Documentation for Atom Forge Construction system"
)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST,
    description: "Primary API Server"
)]
#[OA\SecurityScheme(
    securityScheme: "sanctum",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT"
)]
abstract class Controller
{
    #[OA\Get(
        path: "/api/user",
        summary: "Get authenticated user",
        tags: ["Auth"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated")
        ]
    )]
    public function authenticatedUser()
    {
        // This is a placeholder for the closure in api.php
    }
}
