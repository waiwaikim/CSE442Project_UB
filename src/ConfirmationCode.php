<?php
  final class ConfirmationCode {

    // generates a confirmation code
    public static function get_code() {
      $encrypt_method = "AES-256-CBC";
      $key = hash("sha256", "what is this owo");
      $iv = substr(hash("sha256", "what is that uwu"), 0, 16);
      return openssl_encrypt(strval(time()), $encrypt_method, $key, 0, $iv);
    }

    // get the time when $code is generated (Unix Epoch)
    // user's input MUST be checked against in the DB before calling this function!!!
    public static function get_time($code) {
      $encrypt_method = "AES-256-CBC";
      $key = hash("sha256", "what is this owo");
      $iv = substr(hash("sha256", "what is that uwu"), 0, 16);
      return openssl_decrypt($code, $encrypt_method, $key, 0, $iv);
    }
  }
?>
