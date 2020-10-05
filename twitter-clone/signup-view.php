<?php 
    
   (function(){
    session_start();
    
    if( isset($_SESSION['userId']) ){ header('Location: twitter.php');}
    if( ! $_POST ){return;}
    if( ! isset($_POST['email']) ){ echo 'missing email'; return;}
    if( strlen($_POST['email']) < 6  ){ echo 'email must be at least 6 characters'; return;}
    if( strlen($_POST['email']) > 200  ){echo 'email max length 200 characters';return;}
    if( ! isset($_POST['password'])) {echo 'missing password'; return;}
    if( strlen($_POST['password']) <= 2  ){ echo 'password must be at least 6 characters'; return;}
    if( strlen($_POST['password']) > 200  ){echo 'password max length 200 characters';return;}
    if( ! isset($_POST['password'])) {echo 'missing password'; return;}
    if( strlen($_POST['password']) <= 2  ){ echo 'password must be at least 6 characters'; return;}
    if( strlen($_POST['password']) > 200  ){echo 'password max length 200 characters';return;}
    
    $sUsers = file_get_contents('users.txt');
    $aUsers = json_decode($sUsers);

    foreach($aUsers as $jUser){
      if( $_POST['email'] == $jUser->email && password_verify($_POST['password'],$jUser->password) ){
        $_SESSION['userId'] = $jUser->id;
        $_SESSION['email'] = $jUser->email;
        $_SESSION['password'] = $jUser->password;
        $_SESSION['name'] = $jUser->name;
        header('Location: twitter.php'); 
        exit();
      } 
    }
  })();
  ?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <div class="login-header">
        <svg viewBox="0 0 24 24" class="login-icon active">
          <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z">
          </path>
        </svg>
        <h1>Log in to Twitter</h1>
    </div>
    <form class="login-form" action="signup-view.php" method="POST">
        <input  type="text" 
                placeholder="email"
                name="email"
        >
        <input  type="password" 
                placeholder="password"
                name="password"
        >
        <button type="submit" class="login-btn">Log in</button>
        <button class="login-btn signup-btn" type="button" onclick="showSignupForm()">Sign up</button>
    </form>
    <div id="signupFormDiv">
      <form id="signupForm" action="signup-action.php" method="POST">
          <button class="hideBtn" type="button" onclick="hideForm()" class="close">&times;</button>
          <h2>Create your account</h2>
          <input  type="text" 
                  placeholder="Name"
                  name="name"
          >
          <input  type="text" 
                  placeholder="Email" 
                  name="email"
          >
          <input  type="password" 
                  placeholder="Password"
                  name="password"
          >
      <button class="login-btn confirm-signup">Sign up</button>
      </form>
    </div>
    
   <script src="script.js"></script>
</body>
</html>