<?php 

if(isset($_POST['login_submit'])):

include './includes/connection.php';


// Making Variables for user input
$user_email = $_POST['login_email'];  
$user_pass = $_POST['login_pass'];


$error = array(); 

// Checking Data and Storing Errors
if($user_email == '') {

	$error[] = 'Email ID cannot be empty, Please Enter your ID';
}

if($user_pass == '') {

	$error[] = 'Password cannot be empty, Please Enter your password';
}


if($user_pass != '' && $user_email != ''){

//Checking if users exists or not
$query = "SELECT * FROM `student_data` WHERE `email` = '".$user_email."'";

$check_users = $conn->query($query);

$user_data = $check_users->fetch_assoc();

if($check_users->num_rows < 1) {

	$error[] = "The User doesn't exist, Please recheck your email";
}  

// Matching username and passwords
else if($user_data['email'] != $user_email) { 
		
	

			$error[] = 'You have entered Incorrect Email';

	} else if($user_data['password'] != $user_pass) {

	

			$error[] = 'You have entered Incorrect Password';

	}
	//Logged in, Details matched- Shwoing Success message
	else if($user_data['password'] == $user_pass && $user_data['email'] == $user_email) {

		$success[] = 'You have logged in Successfully, please check the details below.';
	}








}

endif;
?>

<html>
<head>
<title>Login | Test Task </title>

<link rel="stylesheet" href="assets/css/bootstrap.css">

<link rel="stylesheet" href="assets/css/custom.css">

</head>

<body>

<div class="container-fluid">
<div class="container">

<?php include './includes/header.php'; ?>



<div class="row content-section">

<div class="col-sm-12 text-center"><h2>Login</h2>
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
<!-- Printing out Errors or Success messages -->
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
<label>Email Id: </label>
<input type="email" class="form-control" name="login_email"> 
</div>
<hr>
<div class="form-group">
<label>Password: </label>
<input type="Password" class="form-control" name="login_pass"> 
</div>
<hr>


<input type="submit" value="Login" name="login_submit" class="btn btn-success">

</form>
	</div>     <!-- Form Div Close  -->



<div class="clearfix"></div>

<!-- Forming Data Table to show user data -->
<?php 
if(isset($user_data)):

if($user_data['password'] == $user_pass && $user_data['email'] == $user_email) { ?>
<div class="col-sm-8 offset-sm-2">

<h2> Student Data: </h2>
<table class="table table-hover table-striped">
<tr>
<th>Student Name</th>
<th>City</th>
<th>Country</th>

</tr>
<tr>
<td>
<?php echo $user_data['student_name']; ?>
</td>
<td>
<?php echo $user_data['city']; ?>
</td>
<td>
<?php echo $user_data['country']; ?>
</td>
</table>
</div>   <!-- Data Displaying Row END -->

<?php } endif; ?>

</div>    <!-- Content Section End -->
<?php include './includes/footer.php'; ?>



</div>   <!-- Container Section End -->
</div>	<!-- Container Fluid Section End -->
</body>
</html>