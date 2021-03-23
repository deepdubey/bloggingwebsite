<?php
  session_start();
  if( !$_SESSION['loggedInEmail'] ){
      header( "Location: login.php" );
  }
  require_once('dbConn.php');

  $forEditQuery = "SELECT title FROM blogcreated WHERE id='$_GET[id]'";
  $fetchData = $conn -> query($forEditQuery);
  if($fetchData -> num_rows){
    $row = $fetchData -> fetch_assoc();
    $titleData = $row['title'];
    // echo $titleData;
  }

  if (isset( $_POST['saveandnext'] )) {

    $blogId = $_GET['id'];
    $_SESSION['blogId'] = $blogId;

    function validateFormData( $formData ) {
      $formData = trim($formData);
      $formData = stripslashes($formData);
      $formData = htmlspecialchars($formData);
      return $formData;
    }
    $blogTitle = validateFormData($_POST['blogTitle']);
    if($blogTitle){
      $checkIfIdExistQuery = "SELECT id FROM blogcreated WHERE id='$blogId'";
      $checkIfIdExist = $conn -> query($checkIfIdExistQuery);
      // echo $checkIfIdExist;
      if($checkIfIdExist->num_rows){
        $titleUpdate = "UPDATE blogcreated SET title='$blogTitle' ,author='$_SESSION[loggedInEmail]' WHERE id='$blogId'";
        $titleResult = $conn->query($titleUpdate);
        // var_dump( $titleResult );
      }else {
        $query = "INSERT INTO blogcreated(id, title, author) VALUES('$blogId', '$blogTitle', '$_SESSION[loggedInEmail]')";
        $titleResult = $conn -> query($query);
        // var_dump( $titleResult );
      }
      
      if($titleResult){
        header("Location: ./createBlogStep2?id=$blogId");
      }else{
        echo "Error";
      }
    }
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
    #blogTitle{
      border: 0px;
      border-bottom: 2px solid blue;
      margin: 10px;
      background: aliceblue;
      width: 300px;
    }
    #blogTitle:focus{
      outline: none;
    }
    .card{
      background: aliceblue;
      width: 400px;
      height: 300px;
      margin-left: 40%;
      display: flex;
      align-items: center;
      flex-direction: column;
    }
    #save-btn{
      background: green;
      padding: 10px;
      color: white;
    }
    .save-btn-div{
      display: flex;
    justify-content: center;
    }
  </style>  
</head>
<body>
  <div class="card">
    <h1>Create your blog</h1>
    <h3>Step 1: Enter Title of Blog</h3>
    <form action=<?php echo "createBlogStep1.php?id=".$_GET['id']; ?> method="post">
      <?php 
        $title = "";
        if(isset($titleData)){
          $title = $titleData;
        }
        echo '<input type="text" id="blogTitle" name="blogTitle" maxlength="150" value="'. $title .'" >';
      ?>
      <br>
      <div class="save-btn-div"><input id="save-btn" type="submit" value="Save and Next" name="saveandnext"><br></div>
    </form>
  </div>
</body>
</html>