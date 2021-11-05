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
	<?php if(isset($login_user['photo'])): ?>
		<img class='shadow' style='width:270px;height:270px; display:block;margin:auto; border:10px solid white;border-radius:50%;object-fit:cover' src="media/users/<?php echo $login_user['photo']?>" alt="">
		<?php elseif($login_user['gender'] == 'Male'): ?>
		<img class='shadow' style='width:270px;height:270px; display:block;margin:auto; border:10px solid white;border-radius:50%' src="assets/media/img/pp_photo/man.png" alt="">
		<?php elseif($login_user['gender'] == 'Female'): ?>
		<img class='shadow' style='width:270px;height:270px; display:block;margin:auto; border:10px solid white;border-radius:50%' src="assets/media/img/pp_photo/women.jpeg" alt="">
		<?php endif;?>
		<h3 class='text-center display-4 py-3'><?php echo $login_user['name'];?></h3>
		<?php
			if(isset($_POST['upload'])){
				$user_id = $_SESSION['id'];

				if(empty($_FILES['photo']['name'])){
					setMsg('warning','Please upload a photo.');
					header('loaction:photo.php');

				}else{
					$file = move($_FILES['photo'], 'media/users/');
					connect()->query("UPDATE users SET photo='$file' WHERE ID='$user_id'");					
					setMsg('success','Photo Upload successful.');
					header('loaction:photo.php');

				}				
			}

			getMsg('warning');
			getMsg('success');
		?>

		<div class="card shadow">
			<div class="card-body">
				<form action="" method='POST' enctype='multipart/form-data'>
					<input type="file" name="photo" id="">
					<input type="submit" name='upload' value='upload'>
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