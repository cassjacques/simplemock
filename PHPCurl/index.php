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

<div class="assets">

    <h1 class="assetsTitle">Assets</h1>
    <p class="assetsText">Selected items will be featured on website</p>


    <div class="boxes">
    <div class="box">Horizontal<input class="fileupload" type="file" name="fileupload" /> 
    <button class="upload-button" onclick="uploadFile()"> Upload </button>
    <script>
    async function uploadFile() {
    let formData = new FormData(); 
    formData.append("file", fileupload.files[0]);
    await fetch(//WHERE DOES IT GO//; {
        method: "POST", 
        body: formData
    }); 
    alert(The file has been uploaded successfully.);
    };
    </script>
    </div>

    <div class="box">Vertical<input class="fileupload" type="file" name="fileupload" /> 
    <button class="upload-button" onclick="uploadFile()"> Upload </button>
    <script>
    async function uploadFile() {
    let formData = new FormData(); 
    formData.append("file", fileupload.files[0]);
    await fetch(//WHERE DOES IT GO//; {
        method: "POST", 
        body: formData
    }); 
    alert(The file has been uploaded successfully.);
    };
    </script>
    </div>

    <div class="box">Mobile<input class="fileupload" type="file" name="fileupload" /> 
    <button class="upload-button" onclick="uploadFile()"> Upload </button>
    <script>
    async function uploadFile() {
    let formData = new FormData(); 
    formData.append("file", fileupload.files[0]);
    await fetch(//WHERE DOES IT GO//; {
        method: "POST", 
        body: formData
    }); 
    alert(The file has been uploaded successfully.);
    };
    </script>
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


    $extraJS = '<script>
    (function(){
        console.log("---------");
        console.log("SimpleMock: Started! ETA 5 Seconds.");
        console.log("---------");

        function checkIframes() {
            console.log("---------");
            console.log("SimpleMock: Attempting to find iFrames.");
            console.log("---------");

            var all_iframes = document.querySelectorAll("iframe");

            console.log("---------");
            console.log("SimpleMock: iFrames --");
            console.log(all_iframes);
            console.log("---------");

            return all_iframes;
        }

        function buildPlaceholder(size) {
            var placeholder = document.createElement("img");

            placeholder.src = "http://via.placeholder.com/" + size.width + "x" + size.height + ".png";

            placeholder.width = size.width;
            placeholder.height = size.height;

            return placeholder;
        }

        function replaceIframe(iframe) {
            var size = {
                width: iframe.width,
                height: iframe.height
            };
            var placeholder = buildPlaceholder(size);            

            iframe.parentNode.appendChild(placeholder);

            iframe.parentNode.removeChild(iframe);
        }


        window.setTimeout(function(){
            var all_buttons = document.querySelectorAll("button");
            console.log(all_buttons);

            var iframes = checkIframes();

            iframes.forEach(iframe => replaceIframe(iframe));
        }, 5000);
    })();        
    </script>';

    if ($website) {
        formAction($website);
        echo $extraJS;
    } else {
        echo $form;
    }
    ?>
</body>

</html>