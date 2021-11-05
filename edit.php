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
			if(isset($_POST['update'])){
				$name = $_POST['name'];
				$email = $_POST['email'];
				$cell = $_POST['cell'];
				$uname = $_POST['uname'];
				$age = $_POST['age'];
				$edu = $_POST['edu'];
				$gender = $_POST['gender'];
				$updated_at = date('Y-m-d h:m:s');

				if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($gender)){
                    echo validation("All fields are required",'danger');
                }else{
                    $id =$login_user['id'];
                    connect()->query("UPDATE users SET name='$name', email='$email',cell='$cell', username='$uname', age='$age', edu='$edu', gender='$gender', updated_at='$updated_at' WHERE id='$id' ");
                    setMsg('success','Data Updated Successfull');
                    header('location:edit.php');
                    

                }
            }
            getMsg('success');
		?>

		<div class="card shadow">
			<div class="card-body">
				<form action="" method='POST'>
					<div class="form-group">
                            <label for="">Name</label>
							<input class='form-control' value="<?php echo $login_user['name'];?>"  type="text"
                             name="name" id="">
					</div>
					<div class="form-group">
                    <label for="">Email</label>
                    <input class='form-control' value="<?php echo $login_user['email'];?>"  type="text"
                             name="email" id="">
					</div>
					<div class="form-group">
                    <label for="">Cell Number</label>
                    <input class='form-control' value="<?php echo $login_user['cell'];?>"  type="text"
                             name="cell" id="">
					</div>
					<div class="form-group">
                    <label for="">Username</label>
                    <input class='form-control' value="<?php echo $login_user['username'];?>"  type="text"
                             name="uname" id="">
					</div>
					<div class="form-group">
                    <label for="">Age</label>
                    <input class='form-control' value="<?php echo $login_user['age'];?>"  type="text"
                             name="age" id="">
					</div>
					<div class="form-group">
                    <label for="">Education</label>
                    <input class='form-control' value="<?php echo $login_user['edu'];?>"  type="text"
                             name="edu" id="">
					</div>
					<div class="form-group">
						<label for="">Gender</label> <br>
						<input type="radio" <?php echo ($login_user['gender']=='Male')?'checked':''?>  name="gender" value='Male' id="Male"><label for="">Male</label>
						<input type="radio" <?php echo ($login_user['gender']=='Female')?'checked':''?>  name="gender" value='Female' id="Female"><label for="">Female</label>
					</div>
					<div class="form-group">
							<input type="submit" class='btn btn-primary' value='Update' name="update" id="">
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