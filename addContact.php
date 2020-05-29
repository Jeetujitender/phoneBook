<!DOCTYPE html>
<html>
<head>
	<title>Login form design</title>
<!-- 	<link rel="stylesheet" type="text/css" href="styles.css"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>


<?php

$nameErr = $emailErr =$passwordErr=$cpasswordErr="";
$name = $email = $password=$cpassword="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $nameErr = "Name is required";
  } 
  else {
    $name = test_input($_POST["username"]);
    
    if (!preg_match("/^[a-zA-Z\s ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  // password

if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
     $password = test_input($_POST["password"]);
     $cpassword = test_input($_POST["cpassword"]);
    if (strlen($_POST["password"]) <= '6') {
        $passwordErr = " At Least 6 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = " At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = " At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = " At Least 1 Lowercase Letter!";
    }
}
 else {
     $passwordErr = "Please enter password   ";
}


    
$serverName="localhost";
$userName="root";
$passwords="";
$dbName="phoneBook";

$conn=new mysqli($serverName, $userName,$passwords,$dbName);



$add_query="INSERT INTO users (name,email,phone) VALUES ('$name','$password','$email')";

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
// echo "<script>alert('Connected successfully')</script>";

if($conn->query($add_query))
{
    echo "<script>alert('Record created')</script>";
    
}
else {
    echo "<script>alert('failed to add record $conn->error')</script>";
}

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<body>
	<div class="container">
	
	<h1>Add new contact</h1>
	<form method="post" action=""> 
		<p>Name</p>
		<input type="text" name="username"  value="<?php echo $name;?>">
		<span class="error">* <?php echo $nameErr;?></span>
		<p>Email</p>
		<input type="text" name="email" placeholder="abc@xyz.com" value="<?php echo $email;?>">
		<span class="error">* <?php echo $emailErr;?></span>
		<p>Mobile number</p>
		<input type="Password" name="password" >
		<span class="error">* <?php echo $passwordErr;?></span>
		<br>
		<input type="submit" name="signup" value="Signup" class="btn btn-large btn-primary">

	</form>

	</div>
<?php


?>

</body>
</html>

