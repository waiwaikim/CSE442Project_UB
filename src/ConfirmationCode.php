<?php
  final class ConfirmationCode {

    private static $encrypt_method = "AES-256-CBC";
    private static $key = "4610fa3fe210cb9876ff4c838b3b6f6d75e67af1c8fbe46a0796a0810dbe0810";
    private static $iv = "cfb847854b218acb";

    // generates a confirmation code
    public static function get_code($email, $class) {
      return ConfirmationCode::_get_code(strval(time()), $email, $class);
    }

    // added for testing purpose (DO NOT USE)
    public static function _get_code($time, $email, $class) {
      $ubit = substr($email, 0, strpos($email, "@"));
      $message = $ubit."@".$time."-".$class;
      return openssl_encrypt($message, ConfirmationCode::$encrypt_method, ConfirmationCode::$key, 0, ConfirmationCode::$iv);
    }

    // get the time when $code is generated (Unix Epoch)
    public static function get_time($code) {
      $message = openssl_decrypt($code, ConfirmationCode::$encrypt_method, ConfirmationCode::$key, 0, ConfirmationCode::$iv);
      return substr($message, strpos($message, "@") + 1);
    }

    // get the email address associated with this code
    public static function get_email($code) {
      $message = openssl_decrypt($code, ConfirmationCode::$encrypt_method, ConfirmationCode::$key, 0, ConfirmationCode::$iv);
      return substr($message, 0, strpos($message, "@"))."@buffalo.edu";
    }

    public static function get_current_class($code) {
      $message = openssl_decrypt($code, ConfirmationCode::$encrypt_method, ConfirmationCode::$key, 0, ConfirmationCode::$iv);
      return substr($message, strpos($message, "-") + 1);
    }
  }
?>
