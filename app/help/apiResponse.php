<?php
const  OK = 200;
const CREATED = 201;
const ACCEPTED = 202;
const NO_CONTENT = 204;
const VALIDATION_FAILED = 422;
const SERVER_ERROR = 500;
const BAD_REQUEST = 400;
const UNAUTHORIZED = 401;


function errorResponse($errors = null, $message = null, $code = null)
{
    $code = is_null($code) ? VALIDATION_FAILED : $code;
    return apiResponse(null, $message, $errors, $code);
}

function deleteResponse($response = null, $message = null)
{
    $message = is_null($message) ? $response ? 'تم الحذف بنجاح' : 'حدث خطأ ما' : $message;
    return apiResponse(null, $message, null, deleteStatus($response));
}

function successResponse($response = null, $message = null, $code = OK)
{
    $code = $response ? OK : VALIDATION_FAILED;
    return response()->json(jsonFormat(null, $message, null, $code), $code);
}

function apiResponse($data = null, $message = null, $errors = null, $code = OK)
{
    return response()->json(jsonFormat($data, $message, $errors, $code), $code);
}

function jsonFormat($data, $message, $errors, $code)
{
    return [
        'status' => status($code),
        'message' => message($code, $message),
        'errors' => errors($errors),
        'data' => data($data)
    ];
}

function status($code)
{
    return in_array($code, successCode()) ? true : false;
}

function deleteStatus($response)
{
    return $response ? OK : BAD_REQUEST;

}

function message($code, $message)
{
    switch ($code) {
        case  OK:
            return !$message ? 'تمت العملية بنجاح' : $message;
        case CREATED:
            return !$message ? 'Created' : $message;
        case ACCEPTED:
            return !$message ? 'Accepted' : $message;
        case NO_CONTENT:
            return !$message ? 'NO CONTENT' : $message;
        case VALIDATION_FAILED:
            return !$message ? 'عملية غير صحيحة' : $message;
        case SERVER_ERROR:
            return !$message ? 'Internal Server Error' : $message;
        default :
            return $message;
    }
}

function errors($errors)
{
    if (empty($errors))
        return '';

    return $errors;
}

function data($response)
{
    if (!is_object($response) && !is_array($response))
        return [];

    return $response;
}

function getKeyStatus($code)
{
    return in_array($code, successCode()) ? 'message' : 'error';
}

function successCode()
{
    return [
        OK, CREATED, ACCEPTED, NO_CONTENT
    ];
}
