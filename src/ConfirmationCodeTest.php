<?php include("ConfirmationCode.php"); ?>

<?php
  $encrypt_method = "AES-256-CBC";
  $key = "4610fa3fe210cb9876ff4c838b3b6f6d75e67af1c8fbe46a0796a0810dbe0810";
  $iv = "cfb847854b218acb";

  $code1 = ConfirmationCode::_get_code("12345", "hello@buffalo.edu");
  $code2 = ConfirmationCode::_get_code("354849", "hello@buffalo.edu");
  $code3 = ConfirmationCode::_get_code("12345", "hi@buffalo.edu");

  echo "----- Task test 1 -----\r\n";
  echo $code1."\r\n";
  echo $code2."\r\n";
  echo $code3."\r\n";
  echo "\r\n";

  echo "----- Task test 2 -----\r\n";
  echo openssl_decrypt($code1, $encrypt_method, $key, 0, $iv)."\r\n";
  echo openssl_decrypt($code2, $encrypt_method, $key, 0, $iv)."\r\n";
  echo openssl_decrypt($code3, $encrypt_method, $key, 0, $iv)."\r\n";
  echo "\r\n";

  echo "----- Task test 3 -----\r\n";
  echo ConfirmationCode::get_time($code1)."\r\n";
  echo ConfirmationCode::get_time($code2)."\r\n";
  echo ConfirmationCode::get_time($code3)."\r\n";
  echo "\r\n";

  echo "----- Task test 4 -----\r\n";
  echo ConfirmationCode::get_email($code1)."\r\n";
  echo ConfirmationCode::get_email($code2)."\r\n";
  echo ConfirmationCode::get_email($code3)."\r\n";
  echo "\r\n";
?>
