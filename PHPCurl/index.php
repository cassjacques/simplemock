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

        <div class="box">Horizontal
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="file" id="horizontal-upload" name="horizontalUpload">
                <input class="file-upload" type="submit" name="horizontaluploadBtn" value="Upload" />
            </form>
        </div>

        <div class="box">Vertical
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="file" id="vertical-upload" name="verticalUpload">
                <input class="file-upload" type="submit" name="verticaluploadBtn" value="Upload" />
            </form>
        </div>


        <div class="box">Mobile
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="file" id="mobile-upload" name="mobileUpload">
                <input class="file-upload" type="submit" name="mobileuploadBtn" value="Upload" />
            </form>
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
            <input class="submitButton" type="submit" name="submit" value="Submit">
        </form>
    </div>';


    $extraJS = '
    <script>
        (function () {
            console.log("---------");
            console.log("SimpleMock: Started");
            console.log("---------");

            function checkIframes() {
                var all_iframes = document.querySelectorAll("iframe");
                return all_iframes;
            }

            var orientations = [
                {
                    name: "horizontal",
                    sizes: [
                        "970x250",
                        "728x90",
                        "970x90"
                    ]
                },
                {
                    name: "vertical",
                    sizes: [
                        "300x250",
                        "300x600",
                        "160x600"
                    ]
                },
                {
                    name: "mobile",
                    sizes: [
                        "300x50",
                        "320x50"
                    ]
                }

            ];

            function replaceIframe(iframe) {
                if (iframe.width < 1){
                    console.log("SimpleMock -- iFrame has no size.");
                    iframe.parentNode.removeChild(iframe);
                    return;
                }
                
                var details = {
                    name: "",
                    width: iframe.width,
                    height: iframe.height
                };

                var testSize = iframe.width + "x" + iframe.height;

                function testOrientations(orientation) {
                    console.log("testSize: " + testSize);
                    if(orientation.sizes.includes(testSize)) {
                        details.name = orientation.name;
                    }
                }

                orientations.forEach(o => testOrientations(o));

                if (details.name.length < 1){
                    console.log("SimpleMock -- Invalid iFrame Size. Rejecting.");
                    return;
                }

                var placeholder = document.createElement("img");
                placeholder.src = "uploaded_files/" + details.name + ".jpeg";
                iframe.parentNode.appendChild(placeholder);
                iframe.parentNode.removeChild(iframe);
                if (googletag) {
                    googletag.destorySlots(iframe.parent.id);
                }

                // TO DO: add "natural size" of image to placeholder
            }


            window.setInterval(function () {
                var iframes = checkIframes();
                iframes.forEach(iframe => replaceIframe(iframe));
            }, 50);
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