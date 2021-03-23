<?php 
  session_start();
  if (isset( $_POST['saveblog'] ) or isset( $_POST['publish'] ) ) {
    $blogImage = $_SESSION['imagePath'];
    $blogId = $_SESSION['blogId'];
    $blogData = trim($_POST['blogData']);

    if($blogImage && $blogData){
      require_once('dbConn.php');
      $query = "UPDATE blogcreated SET image='$blogImage', textarea='$blogData' WHERE id='$blogId'";
      $result = $conn->query($query);
      if($result){
        if(isset( $_POST['publish'] )){
          $checkIfIdExistQuery = "SELECT id FROM blogpublished WHERE id='$blogId'";
          $checkIfIdExist = $conn -> query($checkIfIdExistQuery);
          // var_dump($checkIfIdExist);
          if($checkIfIdExist->num_rows){
            $publishInsert = "UPDATE blogpublished SET publish_date=CURRENT_TIMESTAMP WHERE id='$blogId'";
            $publishedResult = $conn->query($publishInsert);
          }else{
            $publishInsert = "INSERT INTO blogpublished(id, publish_date) VALUES('$_SESSION[blogId]', CURRENT_TIMESTAMP)";
            $publishedResult = $conn->query($publishInsert);
          }
          if($publishedResult){
            header("Location: ./dashboard");
            // echo "Congratulations your blog is published!";
          }else{
            // echo "Error";
          }
        }else{
          header("Location: ./createBlogStep2?id=$blogId");
          $_SESSION['savedBlogMsg'] = "Saved your blog as draft. To publish click on publish";
        }
      }
    }
  }
?>