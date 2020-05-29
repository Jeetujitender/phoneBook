
<html>
<head>
<script src="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
</style>
</head>
<body>
<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname="phoneBook";

$id=array("");


// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>alert('success!!!')</script>";

$sql = "SELECT *  FROM users ORDER BY name";
$result = $conn->query($sql);
?>
<div class="container">
<form action="">
<input type="text">
<!-- <i class="fa fa-search" aria-hidden="true"></i> -->
<input type="submit" value="search">
</form>



<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // echo "<br> id: ". $row["id"]. " - Name: ". $row["name"].  "<br>";
        // echo $row["id"];
        // echo "  ".$row["name"]."<br>";
       echo "<button class='collapsible'>".$row['name']."</button>
<div class='content'>
  <p>Phone no :".$row['phone']."</p>
  <p> Email id : ".$row['email']."</p>
  <button class='btn btn-dark'> Remove </button>
  <button class='btn btn-primary'> Edit </button>
</div>";

       
    }
} else {
    echo "0 results";
}


?> 
<a class="btn btn-primary" href="addContact.php">ADD Contact</a>
</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
</body>
</html>

