<?php
// エラーメッセージの出力変更
function my_error_message($error, $key, $rule)
{
  if ($key === 'fullname' && $rule === 'noempty') {
    return 'お名前が入力されておらぬぞ';
  }
  return $error;
}
add_filter('mwform_error_message_mw-wp-form-52', 'my_error_message', 10, 3);
