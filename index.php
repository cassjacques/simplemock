<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
    <link rel="stylesheet" href="/modal.css">
    <title>Test</title>
</head>

<body>
    <?php
    session_start();
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

    $header_loggedin = '
        <a href="./auth/logout.php">logout</a>';

    $header_signin = '
        <span class="welcomeMessage">
            <div class="loginButton">LogIn</div>
            <div class="signupButton">SignUp</div>
        </span>';

    use Phppot\Member;

    require_once __DIR__ . '/auth/Member.php';
    $member = new Member();

    if (!empty($_POST["login-btn"])) {
        $loginResult = $member->loginMember();
    };

    if (!empty($loginResult)) {
        echo $loginResult;
    }

    $loginForm = '
    <div class="modalWrapper" id="loginModal">
        <div class="modalContent">
            <div class="sign-up-container">
                <div class="signup-align">
                    <form name="login" action="" method="post" onsubmit="return loginValidation()">
                        <div class="row">
                            <div class="inline-block">
                                <div class="form-label">
                                    Username<span class="required error" id="username-info"></span>
                                </div>
                                <input class="input-box-330" type="text" name="username" id="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="inline-block">
                                <div class="form-label">
                                    Password<span class="required error" id="login-password-info"></span>
                                </div>
                                <input class="input-box-330" type="password" name="login-password" id="login-password">
                            </div>
                        </div>
                        <div class="row">
                            <input class="btn" type="submit" name="login-btn" id="login-btn" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';

    if (!empty($_POST["signup-btn"])) {
        $registrationResponse = $member->registerMember();
    }

    if (!empty($registrationResponse["status"])) {
        if ($registrationResponse["status"] == "error") {
            echo $registrationResponse["message"];
        } else if ($registrationResponse["status"] == "success") {
            echo $registrationResponse["message"];
        }
    }

    $signupForm = '
    <div class="modalWrapper" id="signupModal">
        <div class="modalContent">
            <div class="phppot-container">
                <div class="sign-up-container">
                    <form name="sign-up" action="" method="post" onsubmit="return signupValidation()">
                        <div class="error-msg" id="error-msg"></div>
                        <div class="row">
                            <div class="inline-block">
                                <div class="form-label">
                                    Username<span class="required error" id="username-info"></span>
                                </div>
                                <input class="input-box-330" type="text" name="username" id="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="inline-block">
                                <div class="form-label">
                                    Email<span class="required error" id="email-info"></span>
                                </div>
                                <input class="input-box-330" type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="inline-block">
                                <div class="form-label">
                                    Password<span class="required error" id="signup-password-info"></span>
                                </div>
                                <input class="input-box-330" type="password" name="signup-password" id="signup-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="inline-block">
                                <div class="form-label">
                                    Confirm Password<span class="required error" id="confirm-password-info"></span>
                                </div>
                                <input class="input-box-330" type="password" name="confirm-password" id="confirm-password">
                            </div>
                        </div>
                        <div class="row">
                            <input class="btn" type="submit" name="signupbtn" id="signup-btn" value="Sign up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';

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
                <div class="box">
                    <div class="boxlabel">Leaderboard</div>
                    <div class="tooltip"><i class="far fa-question-circle"></i><span class="tooltiptext">[970x250], [728x90], [970x90]</span></div>
                    <input type="file" id="horizontal-upload" name="horizontalUpload">
                    <label for="horizontal-upload">Upload file</label>
                </div>
    
                <div class="box">
                    <div class="boxlabel">Box</div>
                    <div class="tooltip"><i class="far fa-question-circle"></i><span class="tooltiptext">[300x250], [300x600], [160x600]</span></div>
                    <input type="file" id="vertical-upload" name="verticalUpload">
                    <label for="vertical-upload">Upload file</label>
                </div>
    
                <div class="box">
                    <div class="boxlabel">Leaderboard (mobile)</div>
                    <div class="tooltip"><i class="far fa-question-circle"></i><span class="tooltiptext">[300x50], [320x50]</span></div>
                    <input type="file" id="mobile-upload" name="mobileUpload">
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
    
                <button class="submitButton">Submit</button>
        </form>
    </div>
    <script>
        function signupValidation() {
            var valid = true;
    
            $("#username").removeClass("error-field");
            $("#email").removeClass("error-field");
            $("#password").removeClass("error-field");
            $("#confirm-password").removeClass("error-field");
    
            var UserName = $("#username").val();
            var email = $("#email").val();
            var Password = $("#signup-password").val();
            var ConfirmPassword = $("#confirm-password").val();
            var emailRegex = /^[a-zA-Z0-9.!#$%&"*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    
            $("#username-info").html("").hide();
            $("#email-info").html("").hide();
    
            if (UserName.trim() == "") {
                $("#username-info").html("required.").css("color", "#ee0000").show();
                $("#username").addClass("error-field");
                valid = false;
            }
            if (email == "") {
                $("#email-info").html("required").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (email.trim() == "") {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000")
                    .show();
                $("#email").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#signup-password-info").html("required.").css("color", "#ee0000").show();
                $("#signup-password").addClass("error-field");
                valid = false;
            }
            if (ConfirmPassword.trim() == "") {
                $("#confirm-password-info").html("required.").css("color", "#ee0000").show();
                $("#confirm-password").addClass("error-field");
                valid = false;
            }
            if (Password != ConfirmPassword) {
                $("#error-msg").html("Both passwords must be same.").show();
                valid = false;
            }
            if (valid == false) {
                $(".error-field").first().focus();
                valid = false;
            }
            return valid;
        }
    
        function loginValidation() {
            var valid = true;
            $("#username").removeClass("error-field");
            $("#password").removeClass("error-field");
    
            var UserName = $("#username").val();
            var Password = $("#login-password").val();
    
            $("#username-info").html("").hide();
    
            if (UserName.trim() == "") {
                $("#username-info").html("required.").css("color", "#ee0000").show();
                $("#username").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#login-password-info").html("required.").css("color", "#ee0000").show();
                $("#login-password").addClass("error-field");
                valid = false;
            }
            if (valid == false) {
                $(".error-field").first().focus();
                valid = false;
            }
            return valid;
        }
    
        var signuplaunchbutton = document.querySelector(".signupButton");
        var signupmodal = document.querySelector("#signupModal");
        signuplaunchbutton.onclick = function() {
            signupmodal.classList.toggle("modal-on");
        };
    
        var launchbutton = document.querySelector(".loginButton");
        var loginmodal = document.querySelector("#loginModal");
        launchbutton.onclick = function() {
            loginmodal.classList.toggle("modal-on");
        };
    
        var myForm = document.getElementById("assetsForm");
        var myFiles = [
            document.getElementById("horizontal-upload"),
            document.getElementById("vertical-upload"),
            document.getElementById("mobile-upload")
        ];
    
        myForm.onsubmit = function(event) {
            event.preventDefault();
            // not logged in
            //check  if logged in
    
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
    
            xhr.onload = function() {
                if (xhr.status == 200) {
                    let myURL = document.querySelector("input[name=website]").value;
                    if (myURL.length || myURL !== "https://www.site.com") {
                        window.open("index.php?website=" + myURL, "_blank");
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
        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return "";
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    
        function extractHostname(url) {
            var hostname;
            if (url.indexOf("//") > -1) {
                hostname = url.split("/")[2];
            } else {
                hostname = url.split("/")[0];
            }
            hostname = hostname.split(":")[0];
            hostname = hostname.split("?")[0];
            return hostname;
        }
    
        var parentURL = getParameterByName("website");
    
        function getPosition(string, subString, index) {
            return string.split(subString, index).join(subString).length;
        }
    
        function replaceHost(url) {
            url = url.substring(getPosition(url, "/", 3), url.length);
            console.log("Attempting to fix CSS hostnames.");
    
            // TO DO -- make sure original url has HTTP
            return parentURL + url;
        }
    
        var styleSheets = document.querySelectorAll("link");
    
        function fixStyles(sheet) {
            console.log("Sheet.href (unmodified)");
            console.log(sheet.href);
            if (extractHostname(parentURL) != extractHostname(sheet.href)) {
                sheet.href = replaceHost(sheet.href);
                console.log("sheet.href (modified)");
                console.log(sheet.href);
            }
        }
    
        styleSheets.forEach(ss => fixStyles(ss));
    
        (function() {
            console.log("---------");
            console.log("SimpleMock: Started");
            console.log("---------");
    
            function checkIframes() {
                var all_iframes = document.querySelectorAll("iframe");
                return all_iframes;
            }
    
            var orientations = [{
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
                if (!iframe || iframe.width < 1) {
                    console.log("SimpleMock -- iFrame has no size.");
                    iframe.parentNode.removeChild(iframe);
                    return;
                }
    
                var name = [];
    
                var testSize = iframe.parentNode.parentNode.getAttribute("data-sizes");
    
                function testOrientations(ori) {
                    ori.sizes.forEach(function(s) {
                        if (!testSize) {
                            testSize = iframe.width + ", " + iframe.height;
                        }
    
                        if (testSize.includes(s)) {
                            name.push(ori.name);
                        }
                    });
                }
    
                orientations.forEach(o => testOrientations(o));
    
                if (name.length < 1) {
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
                placeholder.src = "uploaded_files/" + name[0] + ".png ";
                placeholder.classList.add("simpleMock--ad");
    
                iframe.parentNode.appendChild(placeholder);
                iframe.parentNode.removeChild(iframe);
    
                if (googletag) {
                    googletag.cmd.push(function() {
                        googletag.destorySlots();
                    });
                }
    
                placeholder.onload = function() {
                    console.log("hey");
                    this.setAttribute("style", "width: " + this.naturalWidth + "px !important;height: " + this.naturalHeight + "px !important;");
                };
            }
    
    
            window.setInterval(function() {
                var iframes = checkIframes();
                iframes.forEach(iframe => replaceIframe(iframe));
            }, 50);
        })();
    </script>';



    if ($website) {
        formAction($website);
        echo $extraJS;
    } else {
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            echo "<span class=welcomeMessage>
            Welcome, 
            $_SESSION[username]!
            $header_loggedin
            </span>";
        } else {
            echo $loginForm;
            echo $signupForm;
            session_unset();
            session_write_close();
            echo $header_signin;
        }
        echo $form;
    }
    ?>
</body>

</html>