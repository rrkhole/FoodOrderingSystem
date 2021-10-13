<?php
require_once("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Settings</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <?php
        $id=$_GET['id'];
        $result= mysqli_query($con, "Select * from users where id='$id' ");
        ?>
        <div class="container-fluid" id="content">
            <div class="row decor_bg">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row=mysqli_fetch_array($result);
                            echo "<tr><td>".$row['Id']."</td><td>".$row['Username']."</td><td>".$row['Email']."</td></tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4" id="settings-container">
                    <h4>Change Password</h4>
                    <form action="settings_script.php" method="POST">
                        <div class="form-group">
                            <input type="password" class="form-control" name="old-password"  placeholder="Old Password" required = "true">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="New Password" required = "true">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password1"  placeholder="Re-type New Password" required = "true">
                        </div>
                        <button type="submit" class="btn btn-primary">Change</button>
                        <?php
                        if(isset($_GET['error'])){
                        echo "<br><br><b class='red'>" . $_GET['error'] . "</b>";}
                        ?>
                    </form>
                </div>
            </div>
        </div>
       <?php include 'includes/footer.php'?>
    </body>
</html>

