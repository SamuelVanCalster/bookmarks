<?php

require("env.php");
function getOGFromUrl(string $url_to_fetch): object|bool
{

    $url = "https://opengraph.io/api/1.1/site/" . urlencode($url_to_fetch) . "?app_id=" . APP_ID;

    $curl_handle = curl_init();

    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);

    $curl_data = curl_exec($curl_handle);
    curl_close($curl_handle);
    $response = json_decode($curl_data);
    if ($response === null)
        return false;

    return $response;
}

function getScreenshot($url_to_fetch)
{
    $url = "https://api.apiflash.com/v1/urltoimage?access_key=59cdade367094349889ac5b8b2b5097c&url=" . urlencode($url_to_fetch) . "&format=png&width=800&height=600&response_type=image";

    $curl_handle = curl_init();

    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);

    $curl_data = curl_exec($curl_handle);
    curl_close($curl_handle);

    $filename = "images/" . generateRandomString(25) . "_" . time() . ".png";
    file_put_contents($filename, $curl_data);
    return $filename;

}

function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}
?>