<?php

session_start();

unset($_SESSION['utilizador']);
unset($_SESSION['password']);

header('Location: index.php');

?>