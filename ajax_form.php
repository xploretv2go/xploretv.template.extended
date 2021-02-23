<?php
require_once(explode("wp-content", __FILE__)[0] . "wp/wp-load.php");

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

// Add receiver message
if (!empty($_POST['status_message_receiver_message'])) {
  $message = $_POST['status_message_receiver_message'] . "\n\n" . $message;
}

// Add receivers
$to = seso_decrypt($_POST['status_message_receiver']);
if ($to === false) return false; // decrypt failed
$to = preg_replace('/\s+/', '', $to);
$to = explode(',', $to);

// Add subject
$subject = $_POST['status_message_receiver_subject'];
//$subject = 'New form was sent by ' . get_home_url();

// Send mail
$success = wp_mail($to, $subject, $message);
if ($success === true) {
  echo 'success';
  return;
}
echo 'error';
