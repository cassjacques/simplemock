<?php
if (isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['username'])) {
    echo "Welcome, " . $_SESSION['username'] . "!";
    include './auth/logout.php';
} else {
    include './auth/signup-modal.php';
    include './auth/login-modal.php';
}
?>
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
            <li>Upload any images.</li>
            <li>Copy/Paste a URL.</li>
            <li>Click Submit.</li>
            <li>That's it!</li>
        </ol>
    </div>
    <img class="video" src="video-comingsoon.jpg" alt="video">
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
                <label id="hlabel" for="horizontal-upload">Upload file</label>
            </div>
            <div class="box">
                <div class="boxlabel">Box</div>
                <div class="tooltip"><i class="far fa-question-circle"></i><span class="tooltiptext">[300x250], [300x600], [160x600]</span></div>
                <input type="file" id="vertical-upload" name="verticalUpload">
                <label id="vlabel" for="vertical-upload">Upload file</label>
            </div>
            <div class="box">
                <div class="boxlabel">Leaderboard (mobile)</div>
                <div class="tooltip"><i class="far fa-question-circle"></i><span class="tooltiptext">[300x50], [320x50]</span></div>
                <input type="file" id="mobile-upload" name="mobileUpload">
                <label id="mlabel" for="mobile-upload">Upload file</label>
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
        </div>
    </form>
</div>

<script type="text/javascript" src="lib/main.js" class="ignore-url-fix"></script>
<link rel="stylesheet" href="styles.css" class="ignore-url-fix">