<?php


if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);

}

header("Location: /auth/login-modal.php");
die;