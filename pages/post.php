<?php

include('../classes/Post.php');
include('../config/database.php');
session_start();

include('../includes/header.php');
include('../includes/navbar.php');

$obj = new post($pdo);

$posts=$obj->readonePost($_GET['id']);

$obj2=new post($pdo);

if(isset($_POST['delete']))
{
  if($result=$obj->delete_post($_GET['id']))
   {
     header('Location:home.php');
     exit;
   }
}


?>



<!-- Page Header-->
<header class="masthead" style="background-image: url('../assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">

      <form method="post">
        <button class="btn" type="submit" name="delete"><i class="fas fa-trash text-white fs-3"></i></button>

      </form>

      <a href=<?= "edit_post.php?id=" . $_GET['id'] ?> class=" btn" type="submit"><i
                class="fas fa-edit text-white fs-3"></i></a>

        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="post-heading">
                <h2>
                    <?php
                    if (isset($posts['title'])) :
                        echo $posts['title'];
                    endif
                    ?>
                </h2>

                <span class="meta">

                    Posted by
                    <a href="#!">
                        <?php
                        if (isset($posts['username'])) :
                            echo $posts['username'];
                        endif
                        ?>
                    </a>
                    <?php
                    if ($posts) :
                        echo $posts['created_at'];
                    endif
                    ?>
                </span>
            </div>
        </div>
    </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>
                    <?php
                    if ($posts) :
                        echo $posts['content'];
                    endif
                    ?>
                </p>
            </div>
        </div>
    </div>
</article>

<?php
include('../includes/footer.php');
?>