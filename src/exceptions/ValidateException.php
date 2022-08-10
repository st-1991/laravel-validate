<?php

namespace LaravelValidate\exceptions;

class ValidateException extends \Exception
{

    public $status;
    public $msg;
    public $detail;
    public $http_code;

    /**
     * ValidateException constructor.
     * @param int $status
     * @param string $msg
     * @param int $http_code
     * @param string $detail
     */
    public function __construct($status = 0, $msg = "", $http_code = 400, $detail = "")
    {
        parent::__construct($msg, $http_code);
        $this->status = $status;
        $this->msg = $msg;
        $this->http_code = $http_code;
        $this->detail = $detail;
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json([
            "status" => $this->status,
            "msg" => $this->msg,
            'detail' => $this->detail
        ], $this->http_code);
    }
}
