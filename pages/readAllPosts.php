<?php

 include('../config/database.php');
 include('../classes/Post.php');

 $post = new Post($pdo) ;

 $posts= $post->readPosts();

 if($posts)
   print_r($posts); 

?>