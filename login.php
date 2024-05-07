<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$localHost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "realestateproject";

// Create a new MySQLi connection
$con = new mysqli($localHost, $dbuser, $dbpass, $dbname);

// Check the connection
if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM `userregestration` WHERE email ='$email'";
$emailquery = $con->query($query);

$emailcount = mysqli_num_rows($emailquery);

if ($emailcount > 0) {
    $emailpass = mysqli_fetch_assoc($emailquery);
    $dbpass = $emailpass['password'];
    

    echo "Input Password: " . $password . "<br>";
    echo "DB Password Hash: " . $dbpass . "<br>";
    // Comparing plain text password with hashed password
    if ($dbpass===$password ) {
        echo "Password is wrong";
        
    } 
   else{
    echo "Login successful";

    header("Location:index.html");
}

}

 else 
 {     echo "Email not found"; 

}


$con->close();
?>
