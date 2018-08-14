<?php include 'components/session-check-index.php' ?>
<?php include 'controllers/base/head.php' ?>


<head>
    <meta charset="utf-8">
    </meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>STUDENT SUCCESS Log In</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/errorstyle.css">
	<link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                     <div class="login-logo">
						<img class="align-content" src="userfiles/Skyward.png" width = "150px" height = "110px"> 
                    </div>
    <!--<div class="row">
      <div class="main">-->
          <h3 style="color:#65aeee;">Please Log In </h3>
           
          
          <form role="form" action="components/login-process.php" method="post" name="login">
              <div class="form-group"> 
                  <label for="inputUsernameEmail">Username</label>
                  <input type="text" class="form-control" id="inputUsernameEmail" name="username" placeholder="ENTER USERNAME">
              </div>
              <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" name="password" placeholder="ENTER PASSWORD">
              </div> 
				  
              <button type="submit" class="btn btn btn-primary ladda-button" data-style="zoom-in" value="Sign In" name="login_button">
                  Log In  
              </button>
          </form>
		  </div> 
        
    </div>
</div>