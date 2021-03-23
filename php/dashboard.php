<?php
  session_start();
  require_once('dbConn.php');
  if(isset($_SESSION['loggedInEmail'])){  
    $query="SELECT fname,lname from user WHERE email='$_SESSION[loggedInEmail]'";
    $result = $conn->query($query);
    $authorName = $result -> fetch_assoc();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body{
      display: flex;
    flex-direction: column;
    align-items: center;
    }
    .card-div{
      width: 500px;
      display: flex;
      height: 120px;
      background: lightgray;
      border-radius: 10px;
      margin: 10px;
    }
    .card-div img{
      width: 100px;
      height: 100px;
      margin: 10px;
    }
    .text-area a{
      text-decoration: none;
    color: green;
    margin: 40px;
    padding: 10px;
    }
  </style>
</head>
<body>
  <h1>Dashboard</h1>
  <h2><?php echo $authorName['fname']. ' ' . $authorName['lname'] ?></h2>
  <h1>Your Blogs</h1>
  <?php 
    $fetchBlogData = "SELECT id, title, image FROM blogcreated WHERE author='$_SESSION[loggedInEmail]'";
    $blogData = $conn -> query($fetchBlogData);
    if($blogData){
      $numRow = $blogData->num_rows;
      for( $i=0; $i< $numRow; $i++){
        $blogData -> data_seek($i);
        $eachBlog = $blogData->fetch_array(MYSQLI_ASSOC);
        if($eachBlog){
  ?>

      <div class="card-div">
        <img src=<?php echo "../blogImage/".$eachBlog['image'] ?> alt="Avatar">
        <div class="text-area">
          <h2><b><?php echo $eachBlog['title'] ?></b></h2> 
          <a href=<?php echo "createBlogStep1?id=".$eachBlog['id']?> >Edit</a>
          <a href=<?php echo "blogDelete?id=".$eachBlog['id']?> style="color: red;">Delete</a>
        </div>
      </div>

  <?php }}}?>

  <div>
    <a href="../">Back to Home</a>
  </div>
</body>
</html>