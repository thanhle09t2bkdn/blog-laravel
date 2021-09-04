<?php


namespace App\Traits;


use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
    /**
     * Success Response
     * @param $data
     * @param int $code
     * @return $this
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        if(!$data instanceof LengthAwarePaginator) {
            $data = [
                'data' => $data
            ];
        }
        return response()->json($data, $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'status_code' => $code], $code);
    }

    public function errorMessage($message, $code)
    {
        return response()->json($message, $code);
    }
}
