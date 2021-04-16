<?php
session_start();

$message = ''; 
if (isset($_POST['horizontaluploadBtn']) && $_POST['horizontaluploadBtn'] == 'Upload')
{
  if (isset($_FILES['horizontalUpload']) && $_FILES['horizontalUpload']['error'] === UPLOAD_ERR_OK)
  {
    $fileTmpPath = $_FILES['horizontalUpload']['tmp_name'];
    $fileName = $_FILES['horizontalUpload']['name'];
    $fileSize = $_FILES['horizontalUpload']['size'];
    $fileType = $_FILES['horizontalUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = 'horizontal' . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      $uploadFileDir = './uploaded_files/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['horizontalUpload']['error'];
  }
}
$_SESSION['message'] = $message;
header("Location: index.php");

$message = ''; 
if (isset($_POST['verticaluploadBtn']) && $_POST['verticaluploadBtn'] == 'Upload')
{
  if (isset($_FILES['verticalUpload']) && $_FILES['verticalUpload']['error'] === UPLOAD_ERR_OK)
  {
    $fileTmpPath = $_FILES['verticalUpload']['tmp_name'];
    $fileName = $_FILES['verticalUpload']['name'];
    $fileSize = $_FILES['verticalUpload']['size'];
    $fileType = $_FILES['verticalUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = 'vertical' . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      $uploadFileDir = './uploaded_files/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['verticalUpload']['error'];
  }
}
$_SESSION['message'] = $message;
header("Location: index.php");

$message = ''; 
if (isset($_POST['mobileuploadBtn']) && $_POST['mobileuploadBtn'] == 'Upload')
{
  if (isset($_FILES['mobileUpload']) && $_FILES['mobileUpload']['error'] === UPLOAD_ERR_OK)
  {
    $fileTmpPath = $_FILES['mobileUpload']['tmp_name'];
    $fileName = $_FILES['mobileUpload']['name'];
    $fileSize = $_FILES['mobileUpload']['size'];
    $fileType = $_FILES['mobileUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = 'mobile' . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      $uploadFileDir = './uploaded_files/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['mobileUpload']['error'];
  }
}
$_SESSION['message'] = $message;
header("Location: index.php");