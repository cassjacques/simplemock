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
<form id="assetsForm" class="boxForm" method="POST" action="upload.php" enctype="multipart/form-data">

    <h1 class="assetsTitle">Assets</h1>
    <p class="assetsText">Selected items will be featured on website</p>

    <div class="boxes">
        <div class="box">Horizontal
            <input type="file" id="horizontal-upload" name="horizontalUpload">
            <label for="horizontal-upload">Upload file</label>
        </div>
        
        <div class="box">Vertical
            <input type="file" id="vertical-upload" name="verticalUpload" >
            <label for="vertical-upload">Upload file</label>
        </div>

        <div class="box">Mobile
            <input type="file" id="mobile-upload" name="mobileUpload" >
            <label for="mobile-upload">Upload file</label>
        </div>
    </div>

    <div class="urlForm">
            <div class="urlBox">
                <p>URL</p>
            </div>
            <div class="nonUrl">
                <p class="smallgrey">To what URL should this link go?</p>
                <br>
                <input class="textbox" placeholder="https://www.site.com" type="text" name="website">
            </div>

            <button class="submitButton" >Submit</button>
            </form>
            </div>
            <script>
            var myForm = document.getElementById("assetsForm");  
            var myFiles = [
                document.getElementById("horizontal-upload"),
                document.getElementById("vertical-upload"),
                document.getElementById("mobile-upload")
            ];
        
            myForm.onsubmit = function(event)    { 
                event.preventDefault();
                var formData = new FormData();

                function attachFile(f) {
                    if (!f.files[0] || !f.files[0].type.match("image.*")) {
                        return;
                    }     
                    formData.append(f.id, f.files[0], f.files[0].name);
                }
                myFiles.forEach(file => attachFile(file));

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "upload.php", true);
        
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        let myURL = document.querySelector("input[name=website]").value;
                        if (myURL.length || myURL !== "https://www.site.com") {
                            window.open("index.php?website="+myURL, "_blank");
                        } else {
                            alert("Invalid URL");
                        }
                    }
                };
    
                xhr.send(formData);
            }
        </script>';


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
                    name: "vertical",
                    sizes: [
                        "300, 250",
                        "300, 600",
                        "160, 600"
                    ]
                },
                {
                    name: "horizontal",
                    sizes: [
                        "970, 250",
                        "728, 90",
                        "970, 90"
                    ]
                },                
                {
                    name: "mobile",
                    sizes: [
                        "300, 50",
                        "320, 50"
                    ]
                }

            ];

            function replaceIframe(iframe) {
                if (!iframe || iframe.width < 1){
                    console.log("SimpleMock -- iFrame has no size.");
                    iframe.parentNode.removeChild(iframe);
                    return;
                }
                
                var name = [];

                var testSize = iframe.parentNode.parentNode.getAttribute("data-sizes");

                function testOrientations(ori) {
                    ori.sizes.forEach(function(s){
                        if(testSize.includes(s)){
                            name.push(ori.name);
                        }
                    });
                }

                orientations.forEach(o => testOrientations(o));

                if (name.length < 1){
                    console.log("SimpleMock -- Invalid iFrame Size. Rejecting.");
                    return;
                }

                if (name.length > 1) {
                    if (window.innerWidth > 728) {
                        name[0] = "horizontal";
                    } else {
                        name[0] = "mobile";
                    }
                }

                var placeholder = document.createElement("img");
                placeholder.src = "uploaded_files/" + name[0] + ".jpg";
                placeholder.classList.add("simpleMock--ad");

                iframe.parentNode.appendChild(placeholder);
                iframe.parentNode.removeChild(iframe);

                if (googletag) {
                    googletag.cmd.push(function(){
                        googletag.destorySlots();
                    });
                }
                
                placeholder.onload = function() {
                    console.log("hey");
                    this.setAttribute("style", "width: " + this.naturalWidth + "px !important;height: " + this.naturalHeight + "px !important;" );
                };
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