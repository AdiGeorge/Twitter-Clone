<?php
 
if (!isset($_POST['id'])) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing id"}';
    exit();
}
 
if (strlen($_POST['id']) != 13) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"id is not valid"}';
    exit();
}
 
$sUsers = file_get_contents('users.txt');
$aUsers = json_decode($sUsers, true);

for ($i = 0; $i < count($aUsers); $i++) {
  for($j = 0; $j < count($aUsers[$i]['tweets']); $j++) {
    if ($_POST['id'] == $aUsers[$i]['tweets'][$j]['id']) {
        array_splice($aUsers[$i]['tweets'], $j, 1);
        header('Content-Type: application/json');
        echo '{"id": "' . $_POST['id'] . '", "message" :"tweet has been deleted"}';
        
        $sUsers = json_encode($aUsers);
        file_put_contents('users.txt', $sUsers);
        exit();
    }

  }
    
}
header('Content-Type: application/json');
http_response_code(400);
echo '{"message" :"id not found"}';