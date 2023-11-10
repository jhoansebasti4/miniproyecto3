register.php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../user/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $conn = openConnection();

    // Verificar si el usuario ya está registrado
    $check_query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($check_query);

    if ($result && $result->num_rows > 0) {
        // El usuario está registrado, verificar la contraseña
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Contraseña válida, iniciar sesión
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            // Después de verificar las credenciales
            header("Location: ../user/personal_info.php");
            exit();
        } else {
            // Contraseña inválida
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
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
    <title>Registro</title>
</head>
<body>

<div class="container-grande">
    <div class="container-card">
        <div class="logo-text">
            <img src="../assets/devchallenges.svg" alt="Logo">
        </div>
        <div class="card-text">
            <p id="tex1">Join thousands of students from around the world</p>
            <p id="tex2">Master web development by doing real projects. There are multiple paths for you to choose from.</p>
        </div>
        <div class="input-section">
            <form method="POST" action="register.php">
                <div class="input-box">
                    <img class="lockmail" src="../assets/mail.svg" alt="email">
                    <input name="email" type="email" placeholder="email">
                </div>

                <div class="input-box">
                    <img class="lockmail" src="../assets/lock.svg" alt="password">
                    <input name="password" type="password" placeholder="password">
                </div>
                <button type="submit">Star coding now</button>
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
                    <p>Already a member? <a href='/auth/login.php'>Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>