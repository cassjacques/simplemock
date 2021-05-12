<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {

        $query = "select * from users where username = '$username' limit 1";
        $result = mysqli_query($link, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: ./index.php");
                    die;
                }
            }
        }
        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
    }
}

?>

<button class="loginBtn" onclick="document.getElementById('id01').style.display='block'">Login</button>

<div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

    <form class="modal-content animate" action="./index.php" method="POST">
        <div class="container">
            <div for="uname"><b>Username</b></div>
            <input class="textspace" type="text" placeholder="Enter Username" name="username" required>

            <div for="psw"><b>Password</b></div>
            <input class="textspace" type="password" placeholder="Enter Password" name="password" required>

            <button class="loginsubmit" type="submit" class="login">Login</button>

            <input type="checkbox" checked="checked" name="remember"> Remember me

            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>

        </div>
    </form>
</div>

<script>
    var modal = document.getElementById('id01');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>

</html>