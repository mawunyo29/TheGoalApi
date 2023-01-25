<?php

namespace App\Http\Responses;
use Illuminate\Contracts\Support\Responsable;

/**
 * @OA\Schema(schema="RegisterResponse",
 *      title="Register Response",
 *      description="Register Response body data",
 *      type="object",
 *      required={"message"}
 * ){
 *     @OA\Property(property="message", type="string", format="message", example="Successfully created user!"),
 * }
 */
class RegisterResponse implements Responsable
{
    /**
     * @var string
     */
    private $message;

    /**
     * RegisterResponse constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\JsonResponse $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return response()->json([
            'message' => $this->message
        ], 201);
    }
}
