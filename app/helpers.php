<?php

use Illuminate\Http\Response;


function check_phone($value){
	if(preg_match('/^0?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/', $value)){
		return true;
	}
	else
		return false;
}

function format_price($value){
	return sprintf("%0.0f",$value/100);
}

/**
 * Hash encrypted string
 *
 * @param string|integer $id
 * @return hash|string
 */
function hash_encode($id) {
    return Hashids::encode($id);
}

function activity_status($value){
    switch($value){
        case 0: 
            return '未开始';
            break; 
        case 1:
            return '进行中';
            break;
        case 2:
            return '已结束';
            break;
    }
}

/**
 * Decode hash encrypted string
 *
 * @param string $id
 * @return bool
 */
function hash_decode($id) {
    $decode = Hashids::decode($id);
    return $decode ? $decode[0] : false;
}

function encrypt_company($value){
    $en_value = $value * 4313 + 20154;
    return $en_value;
}

function decrypt_company($value){
    $de_value = ($value - 20154)/4313;
    return $de_value;
}

function success($message = '', $data = []) {
    return response()->make([
        'status'  => 0,
        'message' => $message,
        'data'    => $data
    ], Response::HTTP_OK);
}

function forbidden($message = '', $data = []) {
    return response()->make([
        'status'  => 403,
        'message' => $message,
        'data'    => $data
    ], Response::HTTP_FORBIDDEN);
}

function error($message = '', $data = []) {
    return response()->make([
        'status'  => 400,
        'message' => $message,
        'data'    => $data
    ], Response::HTTP_BAD_REQUEST);
}

function un_processable($message = '', $data = []) {
    return response()->make([
        'status'  => 422,
        'message' => $message,
        'data'    => $data
    ], Response::HTTP_UNPROCESSABLE_ENTITY);
}
