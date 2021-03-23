<?php
  session_start();
  require_once('./php/dbConn.php');
  if(isset($_SESSION['loggedInEmail'])){  
    $query="SELECT fname,lname from user WHERE email='$_SESSION[loggedInEmail]'";
    $result = $conn->query($query);
    $authorName = $result -> fetch_assoc();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/index.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">myBlog</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
    <a href=<?php echo "./php/createBlogStep1?id=".uniqid(); ?>><button class="btn btn-danger navbar-btn">Create your Blog</button></a>
    <?php 
      if(isset($_SESSION['loggedInEmail'])){
    ?>
      <ul id="profile" onclick="slide()" style="color:white;margin: 10px 200px 0 0" class="nav navbar-nav navbar-right">
        <li><span class="glyphicon glyphicon-user"></span>Profile</li>
      </ul>

        <!-- <div id="profileSlider" class="container"> -->
          <!-- <div class="row profile"> -->
          <div id="slidingProfile" class="col-md-3">
            <div class="profile-sidebar">
              <!-- SIDEBAR USERPIC -->
              <!-- <div class="profile-userpic">
                <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
              </div> -->
              <!-- END SIDEBAR USERPIC -->
              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                  <?php 
                    if($authorName){
                      echo $authorName['fname'] . ' ' . $authorName['lname'];
                    }
                  ?>
                </div>
                <div class="profile-usertitle-job">
                  Blogger
                </div>
              </div>
              <!-- END SIDEBAR USER TITLE -->
              <!-- SIDEBAR BUTTONS -->
              <!-- <div class="profile-userbuttons">
                <button type="button" class="btn btn-success btn-sm">Follow</button>
                <button type="button" class="btn btn-danger btn-sm">Message</button>
              </div> -->
              <!-- END SIDEBAR BUTTONS -->
              <!-- SIDEBAR MENU -->
              <div class="profile-usermenu">
                <ul class="nav">
                  <li>
                    <a href="./php/dashboard">
                    <i class="glyphicon glyphicon-home"></i>
                    Dashboard</a>
                  </li>
                  <li>
                    <a href="./php/logout.php">
                    <i class="glyphicon glyphicon-flag"></i>
                    Log Out</a>
                  </li>
                </ul>
              </div>
              <!-- END MENU -->
            </div>
          </div>
        <!-- </div> -->
      <!-- </div> -->



    <?php }else{?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./php/signup"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
        <li><a href="./php/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    <?php }?>
  </div>
</nav>
  
<div class="main-container">

  <?php 
    $fetchBlogData = "SELECT p.id as bId, title, image, fname, lname, publish_date FROM blogpublished p, blogcreated c, user u WHERE p.id=c.id AND c.author=u.email";
    $blogData = $conn -> query($fetchBlogData);
    if($blogData){
      $numRow = $blogData->num_rows;
      for( $i=0; $i< $numRow; $i++){
        $blogData -> data_seek($i);
        $eachBlog = $blogData->fetch_array(MYSQLI_ASSOC);
        // if(($i+1) % 3 == 0) echo '<br>';
        if($eachBlog){
  ?>
      <br>
      <div class="card-div">
        <img src=<?php echo "./blogImage/".$eachBlog['image'] ?> alt="Avatar" style="width:100%">
        <div class="text-area">
          <h4><a href=<?php echo "./php/displayBlog?id=".$eachBlog['bId']?>><b><?php echo $eachBlog['title'] ?></b></a></h4> 
          <p><?php echo $eachBlog['fname']. ' ' . $eachBlog['lname'] ?></p>
          <p><?php echo $eachBlog['publish_date'] ?></p> 
        </div>
      </div>

  <?php }}}?>
</div>

  <!-- <div style="
    display: flex;
    justify-content: center;
  ">
    <div class="pagination">
      <a href="">&laquo;</a>
      <a class="active" href="">1</a>
      <a href="">2</a>
      <a href="#">3</a>
      <a href="#">4</a>
      <a href="#">5</a>
      <a href="#">6</a>
      <a href="#">&raquo;</a>
    </div>
  </div> -->
  

</body>
<script>
    function slide() {
      let v = document.getElementById("slidingProfile").style;
      v.display === "block" ? v.display = "none" : v.display = "block";
    }
</script>
</html>
