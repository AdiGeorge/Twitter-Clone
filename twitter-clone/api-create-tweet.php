<?php
session_start();
if( ! isset($_SESSION['userId']) ){
  header('Location: signup-view.php');
}

try{
  $sTweetId = uniqid();

  if( ! isset($_POST['tweetTitle']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing title"}';
    exit();
  }
  if( strlen($_POST['tweetTitle']) < 2 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"title must be at least 2 characters"}';
    exit();
  }
  if( strlen($_POST['tweetTitle']) > 100 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"title cannot be longet than 100 characters"}';
    exit();
  }

  if( ! isset($_POST['tweetMessage']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing message"}';
    exit();
  }
  if( strlen($_POST['tweetMessage']) < 2 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"message must be at least 2 characters"}';
    exit();
  }
  if( strlen($_POST['tweetMessage']) > 140 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"title cannot be longet than 140 characters"}';
    exit();
  }
  

  $jTweet          = new stdClass(); 
  $jTweet->id      = $sTweetId;
  $jTweet->title   = $_POST['tweetTitle'];
  $jTweet->message = $_POST['tweetMessage'];
  $jTweet->note = $_POST['note'];
  // $jTweet->active  = 1;
  

 $aUsers = json_decode(file_get_contents('users.txt'));
 

 for($i=0; $i < count($aUsers); $i++){
   if($_SESSION['userId'] == $aUsers[$i]->id){
     array_push($aUsers[$i]->tweets, $jTweet);
     $sUsers = json_encode($aUsers);
     file_put_contents('users.txt', $sUsers);
     header('Content-Type: application/json');
     echo "Your tweet with $sTweetId has been created";
     break;
   } 
 }


}
catch(Exception $ex){
  echo '{"message":"error '.__LINE__.'"}';
}

