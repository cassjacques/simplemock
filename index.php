<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;400;700;900&display=swap" rel="stylesheet" class="ignore-url-fix">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" class="ignore-url-fix">
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

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function formAction($sitename)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sitename);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    };

    if ($website) {
        formAction($website);
        echo '<script type="text/javascript" src="./lib/page-request-fixes.js" class="ignore-url-fix"></script>';
        echo '<script type="text/javascript" src="./lib/mock.js" class="ignore-url-fix"></script>';
    } else {
        include 'lib/form.php';
    }


    ?>
</body>

</html>