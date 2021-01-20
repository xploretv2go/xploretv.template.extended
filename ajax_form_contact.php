<?php
require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");

$message = '';

foreach ($_POST as $key => $value) {
  // skip all fields starting with status_message_
  if (substr($key, 0, strlen("status_message_")) == "status_message_") {
    continue;
  }
  if (is_array($value)) {
    $message .= $key . ': ' . implode(',', $value) . "\n";
  } else {
    $message .= $key . ': ' . $value . "\n";
  }
}
$to = seso_decrypt($_POST['status_message_receiver']);
if ($to === false) return false; // decrypt failed
$subject = 'New contact request has been sent';
$success = wp_mail($to, $subject, $message);

if ($success === true) {
  echo $_POST['status_message_success'];
  return;
}
echo 'Error sending mail';
