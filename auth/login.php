<?php
require_once __DIR__ . '/../user/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = openConnection();

    $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];

            header("Location: ../user/personal_info.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no registrado.";
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registration.css">
    <title>Login</title>
</head>
<body>

<div class="container-grande">
    <div class="container-card">
        <div class="logo-text">
            <img src="../assets/devchallenges.svg" alt="Logo">
        </div>
        <div class="card-text">
            <p id="tex1">Login</p>
        </div>
        <div class="input-section">
            <form method="post" action="login.php" >
                <div class="input-box">
                    <img class="lockmail" src="../assets/mail.svg" alt="Correo">
                    <input type="email" name="email" placeholder="Email">
                </div>
                
                <div class="input-box">
                    <img class="lockmail" src="../assets/lock.svg" alt="Contraseña">
                    <input type="password" name="password" placeholder="Contraseña">
                </div>
                <button type="submit">Login</button>
            </form>
                <div class="social-profiles">
                 <p id="tex3">Or continue with these social profiles</p>
                <div class="images-container">
                <img src="../assets/Google.svg" alt="Red social 1">
                <img src="../assets/Facebook.svg" alt="Red social 2">
                <img src="../assets/Twitter.svg" alt="Red social 3">
                <img src="../assets/Gihub.svg" alt="Red social 4">
                </div>
                <div class="login-text">
                 <p>Don't have an account yet? <a href='/user/edit_info.php'>register</a></p>
               </div>
                 </div>
            
        </div>
    </div>
</div>

</body>
</html>

