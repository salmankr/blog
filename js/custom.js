function likeFunction(postID){
	$.ajax({
		method: 'POST',
		url: 'likefunction.php',
		data: {
			postID : postID
		},
		success: function(response){
			console.log(response);
			var btn = '<button type="button" class="btn btn-success" onclick="unlikeFunction('+postID+')">Liked</button>';
			$('.like-button'+postID).html(btn);
			alert('post liked');
		}
	})
}

function unlikeFunction(postID){
	$.ajax({
		method: 'POST',
		url: 'unlikefunction.php',
		data: {
			postID : postID
		},
		success: function(response){
			console.log(response);
			var btn = '<button type="button" class="btn btn-primary" onclick="likeFunction('+postID+')">Like</button>';
			$('.like-button'+postID).html(btn);
			alert('post unliked');
		}
	})
}