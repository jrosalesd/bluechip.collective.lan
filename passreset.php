<?php
    error_reporting (E_ALL ^ E_NOTICE);
	session_start();
    $userid = $_SESSION['uid'];
    $SysName = $_SESSION['SysName'];
    
    $msg=$_GET['msg'];
    if(!isset($userid) && !isset($username)){
   header("Location: login.php?login=Session Timeout, Please Log in!");
    }
?>
<html>
    <head>
        <meta charset ="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="format/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="format/css/modal.css"/>
        <script src="format/js/script.js" type="text/javascript"></script>
        
        <link rel="shortcut icon" href="format/img/icon.png" type="image/png">
        
        
        <title class="text-capitalize">
            <?php echo ucwords($SysName.". - Password Reset");?>
        </title>
    </head>
    <body><br/><br/><br/><br/><br/>
        <div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 jumbotron">
                    <div class="text-center"><font color="red"><b><?php echo $msg;?></b></font></div>
                    <p class="text-center"><?php echo ucwords($SysName);?>.  Update Your password</p>
                    <div style="align: center;">
                        <form action="includes/passchange.inc.php" method="POST">
                            <div class="form-group">
                                <label for="user_pass">Enter New Password</label>
                                <input class="form-control col-md-3" type="password" placeholder="Enter Password" name="user_pass" required>
                            </div>
                            <div class="form-group">
                                <label for="user_pass_repeat">Repeat Password</label>
                                <input class="form-control col-md-3" type="password" placeholder="Repeat Password" name="user_pass_repeat" required>
                            </div>
                            <input class="btn btn-default" type="submit" name="pass_change" value="Change Password">
                            <a class="btn btn-danger" href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"> Logoff</span></a>
                        </form>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
<?php
include 'footer.php';
?>