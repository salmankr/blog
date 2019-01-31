<?php
session_start();
include "head.php";
?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <?php
        if (isset($_SESSION['email'])) {
        	?>
        	<th scope="col">button</th>
        	<?php
        }
      ?>
      <th scope="col">Likes</th>
    </tr>
  </thead>
  <tbody>
    <?php
     include "connection.php";
     // $query1 = "SELECT * FROM posts";
     $query1 = "SELECT posts.name, posts.description, posts.id, post_likes.likes FROM posts INNER JOIN post_likes ON posts.id = post_likes.post_id";
     $run = mysqli_query($conn, $query1);
     $count = mysqli_num_rows($run);
     if ($count > 0) {
     	while ($row1 = mysqli_fetch_array($run)) {
     		$postName = $row1['name'];
     		$postDescription = $row1['description'];
     		$postID = $row1['id'];
     		$postLikes = $row1['likes'];
     		?>
            <tr>
               <td> <?php echo $postName; ?> </td>
               <td><?php echo $postDescription; ?></td>
                <?php
                if (isset($_SESSION['email'])) {
                	$userID = $_SESSION['userID'];
                	$query2 = "SELECT * FROM user_likes WHERE user_id = '$userID' AND post_id = '$postID'";
                	$run2 = mysqli_query($conn, $query2);
                	$count2 = mysqli_num_rows($run2);
                	?>
                	<td class="like-button<?php echo $postID  ?>">
                	<?php
                	if ($count2 > 0) {
                		
                		while ($row2= mysqli_fetch_array($run2)) {
                			$likeStatus = $row2['like_status'];
                			if ($likeStatus == false) {
                				?>
                				<button type="button" class="btn btn-primary" onclick="likeFunction(<?php echo $postID ?>)">Like</button>
                				<?php
                			}else{
                				?>
                				<button type="button" class="btn btn-success"  onclick="unlikeFunction(<?php echo $postID ?>)">Liked</button>
                				<?php
                			}
                		}
            
                	}else{
                		?>
                		<button type="button" class="btn btn-primary" onclick="likeFunction(<?php echo $postID ?>)">Like</button>
                	</td>
                		<?php
                	}
                    ?>
                	<?php
                }
               ?>
               <td> <?php echo $postLikes; ?> </td>
            </tr>
     		<?php
     	}
     }
    ?>
  </tbody>
</table>

<?php
include "footer.php";
?>