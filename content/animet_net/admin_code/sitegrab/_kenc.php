<?php


date_default_timezone_set('Asia/Ho_Chi_Minh');

function fek_encrypt($string) {
    $fuk_key = str_rot13(base64_encode(time()));
    $encrypted = strrev(str_rot13(($string . '/video.mp4/' . $fuk_key)));
    $encrypted = fuk_encrypt($encrypted, $fuk_key) . '/video/' . $fuk_key;
    return $encrypted;
}

function fek_decrypt($encrypted, $fuk_key) {
    $fuk_key = str_rot13(base64_encode($fuk_key));
    $encrypted = substr($encrypted, 0, strpos($encrypted, '/video/'));
    $decrypted = fuk_decrypt($encrypted, $fuk_key);
    $decrypted = (str_rot13(strrev($decrypted)));
    $decrypted = substr($decrypted, 0, strpos($decrypted, '/video.mp4/'));
    return $decrypted;
}

function fek_check($str) {
    $fuk_key = base64_decode(str_rot13(substr($str, strpos($str, '/video/') + 7, strlen($str) - strpos($str, '/video/') - 7)));
    if ((time() - $fuk_key) > (6 * 60 * 60)) {
        return false;
    } else {
        return $fuk_key;
    }
}

//////////////////////////////////////////////////////up lai het file kenc
function encode_base64($sData) {
    $sBase64 = base64_encode($sData);
    return strtr($sBase64, '+/', '-_');
}

function decode_base64($sData) {
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
}

function fuk_encrypt($sData, $sKey) {
    $sResult = '';
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return encode_base64($sResult);
}

function fuk_decrypt($sData, $sKey) {
    $sResult = '';
    $sData = decode_base64($sData);
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    return $sResult;
}