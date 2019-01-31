<?php
   function signup(){
        include('connection.php');
   		if (isset($_POST['submit'])) {
   			$first_name = $_POST['first_name'];
   			$last_name = $_POST['last_name'];
   			$email = $_POST['email'];
   			$password = $_POST['password'];
   			$confirm_password = $_POST['confirm_password'];
   			if ($password != $confirm_password) {
   				?>
   				<div class="alert alert-danger" role="alert">
   				  Password Does Not Match!
   				</div>

   				<?php
   			}else
   			{
   				$query = "select * From signup where email = '$email'";
   				$run = mysqli_query($conn, $query);
   				$count = mysqli_num_rows($run);
   				if ($count > 0) {
   					?>
   					<div class="alert alert-danger" role="alert">
   					  User Already Exists!
   					</div>

   					<?php
   				}else
   				{
   					$query = "INSERT INTO signup (f_name, l_name , email, password, c_password) VALUES ('$first_name', '$last_name', '$email', '$password', '$confirm_password')";
   					$run = mysqli_query($conn, $query);
   					if ($run) {
   						?>
   						<div class="alert alert-success" role="alert">
   						  User Added Successfully!
   						</div>
   						<?php
   					}
   				}
   			}
   		}
   	}
   	function signin(){
   		include('connection.php');
   		if (isset($_POST['submit'])) {
   			$email = $_POST['email'];
   			$password = $_POST['password'];
   			$query = "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
   			$run = mysqli_query($conn, $query);
   			$count = mysqli_num_rows($run);
   			if ($count > 0) {
               while ($row = mysqli_fetch_array($run)) {
                  $userID = $row['id'];
               }
   				$_SESSION['email'] = $email;
               $_SESSION['userID'] = $userID;
   				header("location: welcome.php");
   			}else
   			{
   				?>
   				<div class="alert alert-danger" role="alert">
   				  Email or Password does not match!
   				</div>
   				<?php
   			}
   		}
   	}
?>