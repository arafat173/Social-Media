<?php
require_once "autoload.php";
if(userLogin() ==  false){
	header('location:index.php');
}
else{
	$login_user = loginUserData("users",$_SESSION['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $login_user['name'];?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

<?php require_once "templates/menu.php"?>

	<section class="user-profile" style='width:550px; margin:100px auto 100px'>
	
		<?php
			if(isset($_POST['cp'])){
				$old_pass = $_POST['old'];
				$new_pass = $_POST['new'];
				$c_pass = $_POST['cnew'];

				if(empty($old_pass) || empty($new_pass) || empty($c_pass)){
					echo $msg = validation('All fields are required');
				}else if($new_pass != $c_pass){
					echo $msg = validation('Password Confirmation Failed.');
				}else if($old_pass != $login_user['password']){
					echo $msg = validation('Old Password not match.');
				}else{
					$v = $login_user['id'];
					connect()->query("UPDATE users SET password='$c_pass' WHERE id='$v'");
					session_destroy();
					header('location:index.php');
				}
			}
		?>

		<div class="card shadow">
			<div class="card-body">
				<form action="" method='POST'>
					<div class="form-group">
							<input class='form-control' placeholder='Old Password' type="password" name="old" id="">
					</div>
					<div class="form-group">
							<input class='form-control' placeholder='New Password' type="password" name="new" id="">
					</div>
					<div class="form-group">
							<input class='form-control' placeholder='Confirm Password' type="password" name="cnew" id="">
					</div>
					<div class="form-group">
							<input type="submit" class='btn btn-primary' value='Change Password' name="cp" id="">
					</div>
				</form>
				
			</div>
		</div>
	</section>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>