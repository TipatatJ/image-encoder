<?php

namespace JB;


class ImageEncoder {
  static function get_image($image_path) {
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $image_path);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'JB website');
    $query = curl_exec($curl_handle);
    $status = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
    curl_close($curl_handle);
    return ($status === 200) ? $query : false;
  }


  static function to_data_uri($image_path) {
    // Read image path
    $retrieved_image = self::get_image($image_path);
    if ($retrieved_image === false) return $image_path;
    // convert to base64 encoding
    $image_data = base64_encode($retrieved_image);
    $type = self::get_type($image_path);
    return "data:image/$type;base64,$image_data";
  }


  static function get_type($image_path) {
    preg_match('/(png|jpe?g|gif)/', $image_path, $matches);
    return $matches[0];
  }
}
