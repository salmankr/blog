<?php
session_start();
if (!isset($_SESSION['email'])) {
	header('location: signIn.php');
}else{
	include 'head.php';
	?>
    <div class="row">
    	<div class="col-sm-8 offset-2">
    		<div class="row">
    			<div class="col-sm-8">
    				<h3>Welcome! you are signed in as 
    					<?php 
                        include('connection.php');
                        $email = $_SESSION['email'];
                        $query = "SELECT * FROM signup WHERE email = '$email'";
                        $run = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($run)){
                        	$userName = $row['f_name'];
                            $userID = $row['id'];
                        	echo $userName;
                        }
    				    ?>
    				</h3>
                    <form method="post" class="mt-3">
                        <div class="form-group">
                            <label for="postname">Name</label>
                            <input type="text" name="post_name" class="form-control" placeholder="Enter Post Name" required>
                        </div>

                        <div class="form-group">
                            <label for="postdescription">Description</label>
                            <input type="text" name="post_description" class="form-control" placeholder="Enter Post Description" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php
                       if (isset($_POST['submit'])) {
                           $postName = $_POST['post_name'];
                           $postDescription = $_POST['post_description'];
                           $query = "INSERT INTO posts (user_id, name, description) VALUES ('$userID', '$postName', '$postDescription')";
                           $run = mysqli_query($conn, $query);
                           if ($run) {
                              $postID = mysqli_insert_id($conn);
                              $q = "INSERT INTO post_likes (post_id, likes) VALUES ('$postID', '0')";
                              $r = mysqli_query($conn, $q);
                              if ($r) {
                                   ?>
                                  <div class="alert alert-success" role="alert">
                                   Post Created Successfuly!
                                  </div>
                                  <?php
                              }
                           }else{
                            ?>
                            <div class="alert alert-danger" role="alert">
                              some error occured!
                            </div>

                            <?php
                           }
                       }
                    ?>
    			</div>
    			<div class="col-sm-4">
    				<button class="btn btn-primary" onclick="window.location.href= 'logout.php'">logout</button>
    			</div>
    		</div>
    	</div>
    </div>
	<?php
	include "footer.php";
}
?>