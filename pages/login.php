<?php

include('../includes/header.php');
include('../classes/user.php');
include('../config/database.php');
include('../includes/navbar.php');


// if(isset($_SESSION['user_id']))
// {
//         // Redirect the user to the dashboard page
//             header('Location: home.php');
//             exit;
// }

if($_POST && isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']))
 {
    $email=$_POST['email'];
    $password=$_POST['password'];

    $user=new user($pdo);

    $result=$user->login($email,$password);

    if($result==true)
    {
       header('Location:home.php');
       exit;
    }
    else
       echo"email or password incorrect";
 }

?>

<!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Sign in now</h2>
        
                    <form method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input name="email" type="email" id="form3Example3" class="form-control" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input name="password" type="password" id="form3Example4" class="form-control" />
                        </div>



                        <!-- Submit button -->
                        <button name="login" type="submit" class="btn btn-primary btn-block mb-4">
                            Sign in
                        </button>

                        <!-- Register buttons -->
                        <div class="text-center">
                            <a href="register.php">or sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->

<?php

include('../includes/footer.php');

?>

