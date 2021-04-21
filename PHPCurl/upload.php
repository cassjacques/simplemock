<?php
session_start();
$uploadFileDir = './uploaded_files/';
$allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');

if (isset($_FILES['horizontal-upload']) && $_FILES['horizontal-upload']['error'] === UPLOAD_ERR_OK) {
  $fileTmpPath1 = $_FILES['horizontal-upload']['tmp_name'];
  $fileName1 = $_FILES['horizontal-upload']['name'];
  $fileSize1 = $_FILES['horizontal-upload']['size'];
  $fileType1 = $_FILES['horizontal-upload']['type'];
  $fileNameCmps1 = explode(".", $fileName1);
  $fileExtension1 = strtolower(end($fileNameCmps1));
  $newFileName1 = 'horizontal' . '.' . $fileExtension1;

  if (in_array($fileExtension1, $allowedfileExtensions)){
    $dest_path1 = $uploadFileDir . $newFileName1;
    if(move_uploaded_file($fileTmpPath1, $dest_path1)) {
      $message ='File 1 is successfully uploaded.';
    }
  }
}

if (isset($_FILES['vertical-upload']) && $_FILES['vertical-upload']['error'] === UPLOAD_ERR_OK) {
  $fileTmpPath2 = $_FILES['vertical-upload']['tmp_name'];
  $fileName2 = $_FILES['vertical-upload']['name'];
  $fileSize2 = $_FILES['vertical-upload']['size'];
  $fileType2 = $_FILES['vertical-upload']['type'];
  $fileNameCmps2 = explode(".", $fileName2);
  $fileExtension2 = strtolower(end($fileNameCmps2));
  $newFileName2 = 'vertical' . '.' . $fileExtension2;

  if (in_array($fileExtension2, $allowedfileExtensions)){
    $dest_path2 = $uploadFileDir . $newFileName2;
    if(move_uploaded_file($fileTmpPath2, $dest_path2)) {
      $message ='File 2 is successfully uploaded.';
    }
  }
}

if (isset($_FILES['mobile-upload']) && $_FILES['mobile-upload']['error'] === UPLOAD_ERR_OK) {
  $fileTmpPath3 = $_FILES['mobile-upload']['tmp_name'];
  $fileName3 = $_FILES['mobile-upload']['name'];
  $fileSize3 = $_FILES['mobile-upload']['size'];
  $fileType3 = $_FILES['mobile-upload']['type'];
  $fileNameCmps3 = explode(".", $fileName3);
  $fileExtension3 = strtolower(end($fileNameCmps3));
  $newFileName3 = 'mobile' . '.' . $fileExtension3;

  if (in_array($fileExtension3, $allowedfileExtensions)){
    $dest_path3 = $uploadFileDir . $newFileName3;
    if(move_uploaded_file($fileTmpPath3, $dest_path3)) {
      $message ='File 3 is successfully uploaded.';
    }
  }
}