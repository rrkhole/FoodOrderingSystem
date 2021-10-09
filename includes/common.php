<?php
$con = mysqli_connect("localhost", "root", "", "food_ordering",3360)or die($mysqli_error($con));
if(!isset($_SESSION['email']))
session_start();
