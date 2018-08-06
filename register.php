<?php 



if(isset($_POST['register_submit'])) {

// Including Connection File
include './includes/connection.php';


// Loading Variables of User Input
$st_name = $_POST['st_name'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$mobile = $_POST['mobile_no'];
$qual = $_POST['qual'];
$city = $_POST['city'];
$country = $_POST['country'];

$error = array();

// Validating Data and checking if data is correct, or setting required error messages
if(strlen($st_name) == 0) {

	$error[] = 'Student Name is required!'; 
}

if(strlen($pass) == 0) {

	$error[] = 'Password is required!'; 
}

if(strlen($pass) < 8) {

	$error[] = 'Password cannot be less than 8 Characters'; 
}


if(strlen($email) == 0) {

	$error[] = 'Student Name is required!'; 
}


if(strlen($mobile) == 0) {

	$error[] = 'Mobile Number is required!'; 
}

if(strlen($mobile) > 11) {

	$error[] = 'Invalid Mobile No.'; 
}




if(strlen($qual) == 0) {

	$error[] = 'Qualification is required!'; 
}


if(strlen($city) == 0) {

	$error[] = 'City is required!'; 
}

if(strlen($country) == 0) {

	$error[] = 'Country is required!'; 
}

$email_check = explode('@',$email);

if(sizeof($email_check) != 2) {

	$error[] = 'Please Provide a Valid Email Address!';

}

// Checkinng Duplicate Emails

$sql = "SELECT * FROM `student_data` WHERE `email` = '".$email."'";

$result = $conn->query($sql); 

$result = $result->fetch_assoc();


if(sizeof($result) > 0) {

	$error[] = 'The Email Already Exists, Please try another Email!';
}

 if(empty($error)) {

   // Form Processing

 	$sql = "INSERT INTO `student_data`(`student_name`, `password`, `email`, `mobile_no`, `qualification`, `city`, `country`) VALUES ('".$st_name."','".$pass."','".$email."','".$mobile."','".$qual."','".$city."','".$country."')";

 	

 	$insert = $conn->query($sql);

 	if($insert == 1) {

 		$success = array();

 		$success[] = 'Data Recorded Successfully';
 	}

 }

 else {

 	

 	$error[] = 'There is a Problem Submitting your Data';
 }



}






?>

<html>
<head>
<title>Register | Test Task </title>

<link rel="stylesheet" href="assets/css/bootstrap.css">

<link rel="stylesheet" href="assets/css/custom.css">

</head>

<body>

<div class="container-fluid">
<div class="container">

<?php include './includes/header.php'; ?>


<div class="row content-section">

<div class="col-sm-12 text-center"><h2>Register</h2>
<hr>
</div>




<div class="col-sm-6 offset-sm-3">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<?php  if(isset($error) && !empty($error)) { ?>
<div class="alert alert-danger">
	<ul>

<?php

	foreach($error as $e) {

		echo '<li>'.$e.'</li>';

	}


?>




</ul></div>
<?php } ?>

<?php  if(isset($success) && !empty($success)) { ?>
<div class="alert alert-success">
	<ul>

<?php

	foreach($success as $e) {

		echo '<li>'.$e.'</li>';

	}


?>




</ul></div>
<?php } ?>

<div class="form-group">
<label>Student Name: </label>
<input type="text" class="form-control" name="st_name"> 
</div>
<hr>
<div class="form-group">
<label>Password: </label>
<input type="Password" class="form-control" name="pass"> 
</div>
<hr>
<div class="form-group">
<label>Email ID: </label>
<input type="email" class="form-control" name="email"> 
</div>
<hr>

<div class="form-group">
<label>Mobile No: </label>
<input type="text" class="form-control" name="mobile_no"> 
</div>
<hr>

<div class="form-group">
<label>Qualification: </label>
<input type="text" class="form-control" name="qual"> 
</div>
<hr>

<div class="form-group">
<label>City: </label>
<input type="text" class="form-control" name="city"> 
</div>
<hr>

<div class="form-group">
<label>Country: </label>
<input type="text" class="form-control" name="country"> 
</div>
<hr>

<div class="form-group">

<div class="row">
<div class="col-sm-6">
<input type="submit" value="Submit" class="btn btn-primary" name="register_submit">

</div>

<div class="col-sm-6">
<input type="reset" value="Clear" class="btn btn-warning">

</div>

</div>

</div>
</form>
	</div>     <!-- Form Div Close  -->

<div class="clearfix"></div>



</div>    <!-- Content Section End -->
<?php include './includes/footer.php'; ?>



</div>   <!-- Container Section End -->
</div>	<!-- Container Fluid Section End -->
</body>
</html>