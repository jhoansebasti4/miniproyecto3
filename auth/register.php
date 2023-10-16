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
    } else {
        // El usuario no está registrado
        // Insertar el nuevo usuario
        $insert_query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$hashed_password')";
        if ($conn->query($insert_query) === TRUE) {
            // Registro exitoso, iniciar sesión
            session_start();
            $_SESSION['user_id'] = $conn->insert_id; // Obtener el ID del usuario insertado
            $_SESSION['user_email'] = $email;
            header("Location: ../user/personal_info.php");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
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
            <p id="tex1">Unete a miles de estudiantes de todo el mundo</p>
            <p id="tex2">Domina el desarrollo web haciendo proyectos reales. Hay múltiples caminos para que elijas.</p>
        </div>
        <div class="input-section">
            <form method="POST" action="register.php">
                <div class="input-box">
                    <img class="lockmail" src="../assets/mail.svg" alt="Correo">
                    <input name="email" type="email" placeholder="Correo electrónico">
                </div>

                <div class="input-box">
                    <img class="lockmail" src="../assets/lock.svg" alt="Contraseña">
                    <input name="password" type="password" placeholder="Contraseña">
                </div>
                <button type="submit">Empieza a programar ahora</button>
            </form>
            <div class="social-profiles">
                <p id="tex3">O continua con estos perfiles sociales</p>
                <div class="images-container">
                    <img src="../assets/Google.svg" alt="Red social 1">
                    <img src="../assets/Facebook.svg" alt="Red social 2">
                    <img src="../assets/Twitter.svg" alt="Red social 3">
                    <img src="../assets/Gihub.svg" alt="Red social 4">
                </div>
                <div class="login-text">
                    <p>¿Ya eres miembro? <a href='/auth/login.php'>Iniciar sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
