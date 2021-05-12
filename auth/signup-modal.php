<?php
   include("connection.php");
   include("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("insert.php");
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        $user_id = random_num(20);
        header("Location: ./index.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<button class="signupBtn" onclick="document.getElementById('id02').style.display='block'">Sign Up</button>

<div id="id02" class="modal">
    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>

    <form class="modal-content animate" action="/index.php" method="POST">
        <div class="container">
            <div for="uname"><b>Username</b></div>
            <input class="textspace" type="text" placeholder="Enter Username" name="username" required>

            <div for="email"><b>Email</b></div>
            <input type="text" placeholder="Enter Email" name="email" required>

            <div for="psw"><b>Password</b></div>
            <input type="password" placeholder="Enter Password" name="password" required>

            <div for="psw-repeat"><b>Repeat Password</b></div>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

            <button class="signupsubmit" type="submit" class="signup">Sign Up</button>

            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>

<script>
    var modal = document.getElementById('id02');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>

</html>