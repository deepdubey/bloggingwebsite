<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php 
    session_start();
    require_once('dbConn.php');
    $fetchBlogData = "SELECT p.id as bId, title, textarea, image, fname, lname, publish_date FROM blogpublished p, blogcreated c, user u WHERE p.id='$_GET[id]' AND p.id=c.id AND c.author=u.email";
    $blogData = $conn -> query($fetchBlogData);
    if($blogData){
      // $numRow = $blogData->num_rows;
      // for( $i=0; $i< $numRow; $i++){
      //   $blogData -> data_seek($i);
        $blogDetail = $blogData->fetch_array(MYSQLI_ASSOC);
        if($blogDetail){
  ?>

      <div class="card-div">
        <h4><b><?php echo $blogDetail['title'] ?></b></h4>
        <div class="text-area">
          <p><?php echo $blogDetail['fname']. ' ' . $blogDetail['lname'] ?></p>
          <p><?php echo $blogDetail['publish_date'] ?></p> 
        </div>
        <img style="width: 600px; height: 400px;" src=<?php echo "../blogImage/".$blogDetail['image'] ?> alt="Avatar">
        <div>
          <p><?php echo $blogDetail['textarea'] ?></p>
        </div>
      </div>

  <?php }}?>
</body>
</html>