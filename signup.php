<?php
require("includes/common.php");
if (isset($_SESSION['email'])) {
    header('location: products.php');
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['name'];
    $username= mysqli_real_escape_string($con, $username);
    $email=$_POST['e-mail'];
    $email= mysqli_real_escape_string($con, $email);
    $password=$_POST['password'];
    $password= mysqli_real_escape_string($con, $password);
    $password=MD5($password);
    $query1= mysqli_query($con, "SELECT * from users where Email='$email'");
    $num1=mysqli_num_rows($query1);
    $query2= mysqli_query($con, "SELECT * from users where Username='$username'");
    $num2=mysqli_num_rows($query2);
    
    
    if(empty($username or $email or $password)){
        $error="<span class='red'>Please enter all the fields</span";
        header('location:signup.php?error=' .$error);
    }
    else if($num1!=0){
        $error="<span class='red'>Email id already exists!</span";
        header('location:signup.php?error=' .$error);
    }else if($num2!=0){
        $error2="<span class='red'>Username already exists!</span";
        header('location:signup.php?error2=' .$error2);
    }
   
    else{
        $result= mysqli_query($con,"INSERT into users(Username,Email,Password) values('$username','$email','$password')") or die("Couldn't Insert");
        $user_id = mysqli_insert_id($con);
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_id;
        header('location: products.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signup</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <div class="container-fluid decor_bg" id="content">
            <div class="row">
                <div class="container">
                    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
                        <h2>SIGN UP</h2>
                        <form  action="signup.php" method="POST">
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name"  required = "true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$"><?php if(isset($_GET['error2']) && !empty($_GET['error2']) )echo $_GET['error2']; ?>
                            
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"  placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  name="e-mail" required = "true"><?php if(isset($_GET['error']) && !empty($_GET['error']) )echo $_GET['error']; ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" pattern=".{6,}" name="password" required = "true">
                            </div>
                            
                            
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include "includes/footer.php"; ?>
    </body>
</html>