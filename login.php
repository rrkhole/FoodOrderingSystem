<?php
require("includes/common.php");
// Redirects the user to products page if logged in.
if (isset($_SESSION['email'])OR isset($_SESSION['username'])) {
    header('location: products.php');
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $login=$_POST['login'];
    $login= mysqli_real_escape_string($con, $login) ;
    $password=$_POST['password'];
    $password= mysqli_real_escape_string($con, $password);
    $password=MD5($password);
    $result= mysqli_query($con,"SELECT * from users where (Username='$login' or Email='$login') and Password='$password'");
    $num= mysqli_num_rows($result);
    if($num==0){
         $error = "<span class='red'>Please enter correct credentials!</span>";
  header('location: login.php?error=' . $error);
    }else{
        $row=mysqli_fetch_array($result);
        if($row['email']==$login){
        $_SESSION['email']=$login;
        
        }
        else {$_SESSION['username']=$login;}
        $_SESSION['user_id']=$row['Id'];
        header('location:products.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php include 'includes/header.php'; ?>
        <div id="content">
            <div class="container-fluid decor_bg" id="login-panel">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-primary" >
                            <div class="panel-heading">
                                <h4>LOGIN</h4>
                            </div>
                            <div class="panel-body">
                                <p class="text-warning"><i>Login to make a purchase</i><p>
                                <form action="login.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  placeholder="Email or username" name="login" required = "true">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required = "true">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Login</button><br><br>
                                    <?php if(isset($_GET['error']) && !empty($_GET['error']))echo $_GET['error']; ?>
                                    
                                </form><br/>
                            </div>
                            <div class="panel-footer"><p>Don't have an account? <a href="signup.php">Register</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </body>
</html>



