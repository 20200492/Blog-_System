<?php

class Post{

private $pdo;


function __construct(PDO $pdo)
{
    $this->pdo=$pdo;
}

public function AddPost($id,$title,$content)
{

  try
  {

    $sql=$this->pdo->prepare("INSERT INTO post(user_id,title,content) VALUES(:id,:title,:content)");
    $sql->execute(array(':id'=>$id,':title'=>$title,':content'=>$content));

    echo"Your Post is created";
    
    return true;
  }

  catch(PDOExeption $e)
  {
    echo $e->getMessage();
    return false;
  }

}

public function readAllPosts()
{

 $sql='SELECT post.*, users.username FROM post LEFT JOIN users
       ON (post.user_id=users.id) ORDER BY post.created_at DESC';
      

try{

    $result=$this->pdo->prepare($sql);
    $result->execute();
    $final_result=$result->fetchAll(PDO::FETCH_ASSOC);
    return $final_result;
}

catch(PDOException $e)
{
  echo $e->getMessage();
  return false;
}

}

public function readonePost($id)
{
  $query='SELECT p.title, p.content, p.user_id, p.created_at, u.username FROM 
        post p INNER JOIN users u ON p.user_id=u.id 
        WHERE p.id=:id';

  
try{

  $sql=$this->pdo->prepare($query);
  $sql->execute(array(':id'=>$id));

  $result=$sql->fetch(PDO::FETCH_ASSOC);

  return $result;

}

catch(PDOException $e)
{
  echo $e->getMessage();
  return false;

}


}


public function delete_post($id)
{
  $query='DELETE FROM post WHERE id=:id';

  
try{

  $sql=$this->pdo->prepare($query);
  $sql->execute(array(':id'=>$id));

  return true;

}

catch(PDOException $e)
{
  echo $e->getMessage();
  return false;

}


}


public function edit_post($title,$content,$id)
{
  $query="UPDATE post SET title=:title, content=:content WHERE id=:id";

  $stmt=$this->pdo->prepare($query);
  $stmt->execute(array(':title'=>$title,':content'=>$content,':id'=>$id));

  return true;

}


}

?>