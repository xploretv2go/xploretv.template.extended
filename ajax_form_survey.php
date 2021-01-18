<?php
require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");

$data = $_POST;
$message = '';

foreach ($data as $key => $value) {
  // skip all fields starting with status_message_
  if (substr($key, 0, strlen("status_message_")) == "status_message_") {
    continue;
  }
}

$num = 0;
foreach ($data['questions'] as $question) {
    $message .= $question . "\n";
    foreach ($data['answers_' . $num] as $answer) {
      $message .= '- ' . $answer . "\n";
    }
    $message .= "\n";
    $num++;
}

//$to = $data['status_message_receiver'];
$to = 'bkr@seso.at';
$subject = 'New survey has been sent';
$success = wp_mail($to, $subject, $message);

if ($success === true) {
  return $data['status_message_success'];
}
return $success;
