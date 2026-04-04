<?php
include 'connection.php';

function register($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data['username']);
    $email    = mysqli_real_escape_string($conn, $data['email']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

function login($identifier, $password) {
    global $conn;

    $identifier = mysqli_real_escape_string($conn, $identifier);
    
    $query = "SELECT * FROM users WHERE email = '$identifier' OR username = '$identifier'";
    $result = mysqli_query($conn, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}
?>