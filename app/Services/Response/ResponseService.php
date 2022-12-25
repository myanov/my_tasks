<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 15.11.2020
 * Time: 10:22
 */

namespace App\Services\Response;


class ResponseService
{
    private static function responseParams($status, $errors = [], $data = []) : array {
        return [
            'status' => $status,
            'data' => (object)$data,
            'errors' => (object)$errors,
        ];
    }

    public static function sendJsonResponse($status, $code = 200, $errors = [], $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            self::responseParams($status, $errors, $data),
            $code
        );
    }

    public static function success($data = []): \Illuminate\Http\JsonResponse
    {
        return self::sendJsonResponse(true, 200, [],$data);
    }

    public static function notFound($data = []): \Illuminate\Http\JsonResponse
    {
        return self::sendJsonResponse(false, 404, [],[]);
    }

    public static function notAuthorize(): \Illuminate\Http\JsonResponse
    {
        return self::sendJsonResponse(false, 401, [],[]);
    }
}
