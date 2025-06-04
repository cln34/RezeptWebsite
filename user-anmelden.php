<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "php/controller/UserController.php";

$email = $_POST["email"] ?? null;
$passwort = $_POST["passwort"] ?? null;

if (!$email || !$passwort) {
    $_SESSION["message"] = "missing_required_parameters";
    header("Location: anmeldung.php");
    exit;
}

$userController = new UserController();
$user = $userController->readUser($email);

if ($user && $email === $user->getEmail() && password_verify($passwort, $user->getPassword())) {
    $_SESSION["email"] = $email;
    $_SESSION["rolle"] = $user->getRolle();
    $_SESSION["loggedin"] = true;
    $_SESSION["message"] = "login_success";
    header("Location: index.php");
    exit;
} else {
    $_SESSION["message"] = "invalid_credentials";
    header("Location: anmeldung.php");
    exit;
}

