<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // return an HTTP 405 Method Not Allowed response
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    echo "405 Method Not Allowed";
    exit;
}

$requiredFields = ['nom', 'email', 'password', 'sexe', 'ville', 'loisir'];
$allowedSexe = ['Homme', 'Femme'];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
        $error = "400 Bad Request: Missing field '$field'";
        echo $error;
        header("Location: ./index.html?message=" . urlencode($error));
        exit;
    }
}

$nom = trim($_POST['nom']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$sexe = $_POST['sexe'];
$ville = trim($_POST['ville']);
$loisir = $_POST['loisir'];

if (strlen($nom) < 2 || strlen($nom) > 16) {
    header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
    $error = "400 Bad Request: 'nom' must be between 2 and 16 characters.";
    echo $error;
    header("Location: ./index.html?message=" . urlencode($error));
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
    $error = "400 Bad Request: Invalid email format.";
    echo $error;
    header("Location: ./index.html?message=" . urlencode($error));
    exit;
}

if (strlen($password) < 8 || strlen($password) > 64) {
    header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
    $error = "400 Bad Request: 'password' must be at least 8 characters long.";
    echo $error;
    header("Location: ./index.html?message=" . urlencode($error));
    exit;
}

if (!in_array($sexe, $allowedSexe)) {
    header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request", true, 400);
    $error = "400 Bad Request: 'sexe' must be either 'Homme' or 'Femme'.";
    echo $error;
    header("Location: ./index.html?message=" . urlencode($error));  
    exit;
}

