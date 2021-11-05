<?php
	require_once "autoload.php";


	if(isset($_GET['recent_login_now'])){
		$login_now = $_GET['recent_login_now'];
		setcookie('login_user_cookie_id',$login_now,time()+(60*60*24*365*7) );
		header('location:index.php');

	}




	if(isset($_GET['rlc_id'])){
		$rlc_id = $_GET['rlc_id'];
		$rl_arr = json_decode($_COOKIE['recent_login_id'],true);
		$rlu_arr = array_unique($rl_arr);

		$index = array_search($rlc_id,$rlu_arr);
		array_splice($rlu_arr,$index,1);
		if(count($rlu_arr)>0){
			setcookie('recent_login_id',json_encode($rlu_arr),time()+(60*60*24) );

		}else{
			setcookie('recent_login_id','',time()-(60*60*24*365*10) );

		}
		header('location:index.php');

	}





	if(userLogin() == true){
		header('location:profile.php');
	}

	if(isset($_COOKIE['login_user_cookie_id'])){
		$login_cookie_id = $_COOKIE['login_user_cookie_id'];
		$_SESSION['id'] = $login_cookie_id;
		header('location:profile.php');

	}
?>
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
		if(isset($_POST['signup'])){
			 $login = $_POST['login'];
			 $pass = $_POST['password'];

			if(empty($login) || empty($pass)){
				$msg= validation('All fields are required.');
			}
			else{
				$login_user_data = authCheck('users','email',$login);
				if($login_user_data !== false){
					if($pass==$login_user_data['password']){
						$_SESSION['id'] = $login_user_data['id'];
						setcookie('login_user_cookie_id',$login_user_data['id'],
						time()+(60*60*24*365*7));
						header('location:profile.php');
					}
					else{
						$msg = validation('Incorrect Password');
					}
				}
				else{
					$msg = validation('Invalid email address');
				}

			}
		}
	?>
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Login</h2>
				<?php
				if(isset($msg)){
					echo $msg;
				}
				
				?>
				<hr>
				<form action="" method="POST">
					
					<div class="form-group">
						<label for="">Login Info</label>
						<input name='login' class="form-control" value="<?php old('login')?>" type="text" placeholder='Email or Cell or Username'>
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name='password' class="form-control" type="password" placeholder='Password'>
					</div>
					
					<div class="form-group">
						<input name='signup' class="btn btn-primary" type="submit" value="Login">
					</div>
				</form>
				<hr>
				<a href="reg.php">Create an account</a>
			</div>
		</div>
	</div>

	<div style='cursor:pointer' class="wrap ">
		<div class="row">
		<?php  

		if(isset($_COOKIE['recent_login_id'])):
		$recent_login_user_arr = json_decode($_COOKIE['recent_login_id'],true);
		$user_id = implode(',',$recent_login_user_arr);
		$sql= "SELECT * FROM users WHERE id in ($user_id) ORDER BY name";
		$data = connect()->query($sql);
		
		while($user = $data->fetch_array()):
		?>
			<div class="col-md-4 mt-2">
			 <div class="card shadow">
			  <div style='position:relative;' class="card-body">
			    <a style='position:absolute; top:-18px; right:-12px;background-color:gray;color:#fff;padding:5px;border-radius:50%;' class='close' href="?rlc_id=<?php echo $user['id'];?>">&times;</a>
				<a href="?recent_login_now=<?php echo $user['id'];?>">
				<img style='width:100%; height:120px' src="media/users/<?php echo $user['photo']?>" alt="">
				<h4 style='font-size:13px; '><?php echo $user['name'];?></h4>
				</a>
				
			</div>
			</div>
			</div>

		<?php endwhile;
		endif;
		?>	

		</div>

	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>