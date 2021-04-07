<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:wght@100&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
$website = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (empty($_GET["website"])) {
    $website = "";
  } else {
    $website = test_input($_GET["website"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function formAction($sitename) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sitename);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
}

$form = '<div class="urlform"><form method="get" target="_blank"> <p class="smallgrey">To what URL should this link go?</p><br><div class="url"><p>URL</p> <input class="textbox" placeholder="https://www.site.com" type="text" name="website"></div><br><br><input  class="submitButton" type="submit" name="submit" value="Submit"></form></div>';
?>

<?php
if ($website) {
    formAction($website);
} else {
    echo $form;
}
?>
</body>
</html>