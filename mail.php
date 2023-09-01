<?php
$to = 'recipients@email-address.com';
$subject = 'ハローXAMPP!';
$message = 'Mailhog送受信テスト';
$headers = "From: your@email-address.com\r\n";

if (mail($to, $subject, $message, $headers)) {
  echo "成功！";
} else {
  echo "エラー...";
}
