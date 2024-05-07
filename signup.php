<?php


$localHost= "localhost";
$dbuser= "root";
$dbpass= "";
$dbname= "realestateproject";




// Create a new MySQLi connection
$con = new mysqli($localHost, $dbuser, $dbpass, $dbname);

// Check the connection
if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    // Retrieve form data using $_POST
    $fullName = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);

    if($password===$confirmpassword){
    $passwordhash=password_hash($password,PASSWORD_BCRYPT);
    $cpasswordhash=password_hash($confirmpassword,PASSWORD_BCRYPT);

$emailquery= "SELECT * FROM `userregestration` WHERE email = '$email' " ;
$equery= $con->query($emailquery);
$emailcount = mysqli_num_rows($equery);
if($emailcount>0){
    echo "email already exists";
    exit();
}


$insertqry = "INSERT INTO `userregestration` (`fullname`,`email`,`password`,`confirmpassword`)VALUES('$fullName','$email',  '$passwordhash','$cpasswordhash')" ;
$iquery= $con->query($insertqry);

if($iquery){
    echo "register success";
    
}else{
    echo "failedregister";
}

}

else{
    echo "password nott matching";
}

}







?>


























