<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;400;700;900&display=swap" rel="stylesheet">
    <title>SimpleMock</title>
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

$form = '
<nav>
    <div class="header">
        <h2 class="title">Simple Mock</h2>
        <br>
        <p class="subheader">Force ad creatives on any website</p>
    </div>
</nav>

<div class="middle">
    <div class="steps">
        <h1 class="instructions">Instructions</h1>
            <ol>
                <li>Lorem ipsum dolor</li>
                <li>Lorem ipsum dolor</li>
                <li>Lorem ipsum dolor</li>
                <li>Lorem ipsum dolor</li>
            </ol>
        </div>
        <img class="video" src="video-comingsoon.jpg" alt="video">
    </div>
</div>



<div class="urlForm">
    <form method="get" target="_blank"> 
    <div class="urlBox">
        <p>URL</p>
    </div>
    <div class="nonUrl">
        <p class="smallgrey">To what URL should this link go?</p>
        <br>
        <input class="textbox" placeholder="https://www.site.com" type="text" name="website">
    </div>
    <input class="submitButton" type="submit" name="submit" value="Submit"></form>
</div>';

if ($website) {
    formAction($website);
} else {
    echo $form;
}
?>
</body>
</html>