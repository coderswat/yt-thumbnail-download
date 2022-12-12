<?php
$input = file_get_contents('php://input');
$update = json_decode($input);
$message = $update->message;
$chatid = $message->chat->id;
$text = $message->text;
$token = "Enter Your Bot Token Here";
if ($text == "/start") {
  botSend("Hello Send YouTube Video Link To Download Thumbnail",$token,$chatid);
}else{
$url = $text;
$ng = '.n';
$kpg = $url.$ng;
//echo "$kpg";
preg_match_all("!https://youtu.be/([^\s]*?).n!", $kpg, $matches);
$code = $matches[1][0];
if($code == ""){
  botSend("Send A Valid Link",$token,$chatid);
  exit;
}
$photo = "https://img.youtube.com/vi/$code/maxresdefault.jpg";
botSendThumb($photo,$token,$chatid);
}

function botSend($reply,$token,$chatid){
  file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chatid&text=$reply");
}
function botSendThumb($photo,$token,$chatid){
  file_get_contents("https://api.telegram.org/bot$token/sendPhoto?chat_id=$chatid&photo=$photo");
}
?>