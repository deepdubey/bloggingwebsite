<?php 
  session_start();
  require_once('dbConn.php');
  $query = "SELECT title, image, textarea FROM blogcreated WHERE id='$_SESSION[blogId]'";
  $result = $conn->query($query);
  if($result){
    $blogRow = $result -> fetch_assoc();
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
    body {
    font-family: Arial;
    font-size: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    }
    .bgColor {
    height:150px;
    background-color: #fff4be;
    border-radius: 4px;
    }
    .bgColor label{
    font-weight: bold;
    color: #A0A0A0;
    }
    #targetLayer{
    float:left;
    width:150px;
    height:150px;
    text-align:center;
    line-height:150px;
    font-weight: bold;
    color: #C0C0C0;
    background-color: #F0E8E0;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    }
    #uploadFormLayer{
      float:left;
      padding: 20px;
    }
    .btnSubmit {
      background-color: #696969;
        padding: 5px 30px;
        border: #696969 1px solid;
        border-radius: 4px;
        color: #FFFFFF;
        margin-top: 10px;
    }
    .inputFile {
      padding: 5px;
      background-color: #FFFFFF;
      border:#F0E8E0 1px solid;
      border-radius: 4px;
    }
    .image-preview {	
    width:150px;
    height:150px;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    }
    #ack{
      position: absolute;
      top: 10px;
      border: 1px solid green;
      background: lightgreen;
      padding: 20px;
      font-size: 20px;
    }
  </style>
</head>
<body>
  <h1>Create your blog: Step 2</h1>

  <!-- <form method="post" onsubmit="return false" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="imageToUpload" id="imageToUpload">
    <input type="button" value="Upload" id="uploadImage" name="uploadImage">
  </form> -->
  <div class="bgColor">
    <form id="uploadForm" action="imageUpload.php" method="post">
      <div id="targetLayer">
        <?php if($blogRow['image']){ ?>
          <img class="image-preview" src="../blogImage/<?php echo $blogRow['image']; ?>" class="upload-preview" /><?php }else{?>No Image
        <?php }?>
      </div>
      <div id="uploadFormLayer">
        <input name="userImage" type="file" class="inputFile" /><br/>
        <input type="submit" value="Upload" class="btnSubmit" />
      </div>
    </form>
  </div>

  <br>
  <form action="blogSavePublish.php" method="post">
    <!-- <input type="hidden" name="imagePath" value="<?php //echo $_SESSION['imagePath']?>"> -->
    <br><br><h3>Write your blog content here</h3>
    <textarea id="blogData" name="blogData" rows="40" cols="100">
      <?php if($blogRow['textarea']){ echo $blogRow['textarea']; }?>
    </textarea><br>
    <input type="submit" value="Save as Draft" name="saveblog">
    <input type="submit" value="Publish" name="publish">
  </form><br>

  
    <?php 
      if(isset($_SESSION['savedBlogMsg'])) 
        echo '<div id="ack">'.$_SESSION['savedBlogMsg'].'</div>';
      unset($_SESSION['savedBlogMsg']);
    ?>

  <div>
    <a href="../">Back to Home</a>
  </div>
  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="../js/ajaxImageUpload.js"></script>
</html>