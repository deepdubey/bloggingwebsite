<?php
session_start();
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name']; 

$targetPath = "../blogImage/".$_SESSION['blogId'].'.'.explode('/',$_FILES['userImage']['type'])[1];
if(move_uploaded_file($sourcePath,$targetPath)) {
  $_SESSION['imagePath'] = $_SESSION['blogId'].'.'.explode('/',$_FILES['userImage']['type'])[1];
?>
<img class="image-preview" src="<?php echo $targetPath; ?>" class="upload-preview" />
<?php
}
}
}
?>