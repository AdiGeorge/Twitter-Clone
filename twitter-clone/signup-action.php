<?php
session_start();

if( ! $_POST) {
    header('Location: signup-view.php');
}

if( ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: signup-view.php');
    exit();
}

if( ! isset($_POST['email']) ){ echo 'missing email'; return; }
if( strlen($_POST['email']) < 6  ){ echo 'email must be at least 6 characters'; return;}
if( strlen($_POST['email']) > 200  ){echo 'email max length 200 characters';return;}
if( ! isset($_POST['password']) ){ echo 'missing password'; return; }
if( strlen($_POST['password']) < 6  ){ echo 'password must be at least 6 characters'; return;}
if( strlen($_POST['password']) > 200  ){echo 'password max length 200 characters';return;}
if( ! isset($_POST['name']) ){ echo 'missing name'; return; }
if( strlen($_POST['name']) < 6  ){ echo 'name must be at least 6 characters'; return;}
if( strlen($_POST['name']) > 50  ){echo 'password max length 50 characters';return;}

$sUsers = file_get_contents('users.txt');
$aUsers = json_decode($sUsers);

foreach($aUsers as $jUser) {
    if( $_POST['email'] == $jUser->email) {
        header('Location: signup-view.php');
    }
}

$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$jUser = ["id"=>uniqid(), "email"=>$_POST['email'], "password"=>$passwordHash, "name"=>$_POST['name'], "tweets"=>[]]; 
array_push($aUsers, $jUser);

file_put_contents('users.txt', json_encode($aUsers));
// $_SESSION['email'] = $jUser->email;
// $_SESSION['userId'] = $jUser->id;
// $_SESSION['name'] = $jUser->name;
header('Location: twitter.php');

exit();
