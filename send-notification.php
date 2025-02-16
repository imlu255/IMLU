<?php
$title = $_POST['title'];
$body = $_POST['body'];
$link = $_POST['link'];

$notification = [
  'title' => $title,
  'body' => $body,
  'icon' => '/path/to/icon.png',
  'click_action' => $link
];

$fields = [
  'notification' => $notification,
  'to' => '/topics/all'
];

$headers = [
  'Authorization: key=' . "YOUR_SERVER_KEY",
  'Content-Type: application/json'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
