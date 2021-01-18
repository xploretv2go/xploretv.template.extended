<?php
require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");

$data = $_POST;
$message = '';

foreach ($data as $key => $value) {
  // skip all fields starting with status_message_
  if (substr($key, 0, strlen("status_message_")) == "status_message_") {
    continue;
  }
  $message .= $key . ': ' . $value . "\n";
}
$to = 'bkr@seso.at';
$subject = 'New contact request has been sent';
$success = wp_mail($to, $subject, $message);

if ($success === true) {
  return $data['status_message_success'];
}
return $success;
