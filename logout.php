<?php

session_start();

$_SESSION = array();

// Jika ingin benar-benar bersih, hapus cookie sesi di browser user
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }

session_destroy();

header("location: signin.php");
exit;
?>