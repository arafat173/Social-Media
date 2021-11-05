<?php require_once "autoload.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	<?php
		if(isset($_POST['reg'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];
			$uname = $_POST['username'];
			$pass = $_POST['pass'];
			$cpass = $_POST['cpass'];
			$gender=NULL;
			if(isset($_POST['gender'])){
				$gender = $_POST['gender'];
			}
			
			// $hash_pass = getHash($pass);

			if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($pass) || empty($gender)){
				$msg = validation('All fields are required','warning');
			}else if(emailcheck($email) == false){
				$msg =validation('Invalid Email Address');
			}else if(mobileVerification($cell) == false){
				$msg=validation('Invalid Cell Number');
			}else if(passcheck($pass,$cpass)== false){
				$msg=validation('Confirm password does not match.');
			}else if(dataCheck('users','email',$email) ==  false){
				$msg=validation('Email already exist.');

			}
			else if(dataCheck('users','cell',$cell) ==  false){
				$msg=validation('Cell already exist.');

			}
			else if(dataCheck('users','username',$uname) ==  false){
				$msg=validation('Username already exist.');

			}
			else{
				$sql = "INSERT INTO users(name,email,cell,username,password,gender) VALUES('$name','$email','$cell','$uname','$pass','$gender')";
				connect()->query($sql);
				$msg=validation('Your Registration is succesfull');
				formClean();
			}
			
		}	
	?>
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Create an account</h2>
				<?php
					if(isset($msg)){
						echo $msg;
					}
				?>
				<hr>
				<form action="" method='POST' enctype='multipart/form-data'>
					<div class="form-group">
						<label for="">Name</label>
						<input name='name' class="form-control" value='<?php old('name');?>' type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name='email' class="form-control" value='<?php old('email');?>' type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name='cell' class="form-control" value='<?php old('cell');?>' type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name='username' class="form-control" value='<?php old('username');?>' type="text">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name='pass' class="form-control" type="password">
					</div>
					<div class="form-group">
						<label for="">Confirm Password</label>
						<input name='cpass' class="form-control" type="password">
					</div>
					<div class="form-group">
						<label for="">Gender</label> <br>
						<input type="radio" name="gender" value='Male' id="Male"><label for="">Male</label>
						<input type="radio" name="gender" value='Fem ale' id="Female"><label for="">Female</label>
					</div>
					<div class="form-group">
						<input name='reg' class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
				<hr>
				<a href="index.php">Login Now</a>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>