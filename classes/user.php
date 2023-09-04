<?php

session_start();

class user{
  private $pdo;

  function __construct(PDO $pdo)
  {
    $this->pdo=$pdo;
  }

  public function register($username,$password,$email)
  { 
    $errors = array();

    
   if(empty($username))
     $errors[]="please enter your username";

   if(empty($email))
     $errors[]="please enter your email"; 

   if(empty($password))
     $errors[]="please enter your password";
   
   if(!filter_var($email,FILTER_VALIDATE_EMAIL))
     $errors[]="please enter a valid email"; 
     
   $stmt=$this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username=:username OR PASSWORD=:password OR email=:email");
   $stmt->execute(array(':username'=>$username,':password'=>$password,':email'=>$email));

   $count=$stmt->fetchColumn();

   if($count>0)
     $errors[]="user already registered before"; 
  
   if(empty($errors))
    {
      $hash=password_hash($password,PASSWORD_DEFAULT);

      $stmt=$this->pdo->prepare("INSERT INTO users(username,PASSWORD,email) VALUES(:username,:password,:email)");
      $stmt->execute(array(':username'=>$username,':password'=>$hash,':email'=>$email));

      $stmt2=$this->pdo->prepare("SELECT * FROM users WHERE email=:email");
      $stmt2->execute(array(':email'=>$email));
      $user=$stmt2->fetch(PDO::FETCH_ASSOC);

      $_SESSION['login'] = true;
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $username;

      return true;
    }

   else
      return $errors;
  }

  public function login($email,$password)
  {
    $stmt=$this->pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->execute(array(':email'=>$email));

    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user && password_verify($password,$user['PASSWORD']))
      {
        $_SESSION['user_name']=$user['username'];
        $_SESSION['email']=$user['email'];
        $_SESSION['user_id']=$user['id'];
        $_SESSION['login'] = true;

       return true;
      }
    else
       return false;          

  }


}

?>