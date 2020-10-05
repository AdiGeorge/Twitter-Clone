<?php
session_start();

(function(){
// $aTweets = json_decode(file_get_contents('users.txt'));
$sTweets = file_get_contents('users.txt');
$aTweets = json_decode($sTweets);


for($i = 0; $i<count($aTweets); $i++){
  if( $_SESSION['userId'] == $aTweets[$i]->id){
      
    echo json_encode($aTweets);
  }
}


header('Content-type: application/json');
})();





 


