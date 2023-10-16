<?php
require_once('db_connection.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($bio) || empty($phone) || empty($email) || empty($password)) {
        echo "<script>alert('Todos los campos son obligatorios.');</script>";
    } else {
        // Hash del password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Crear la consulta para insertar un nuevo usuario
        $insert_query = "INSERT INTO usuarios (name, bio, phone, email, password) 
                          VALUES ('$name', '$bio', '$phone', '$email', '$hashed_password')";

        $conn = openConnection();

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        if ($conn->query($insert_query) === TRUE) {
            echo "Nuevo usuario creado correctamente.";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }

        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/personal_info.css">
    <title>edit_info.php</title>
</head>
<body>

<div class="header">
    <div class="logo-text">
        <img src="../assets/devchallenges.svg" alt="Logo">
    </div>
    <div class="user-profile">
        <img src="" alt="Foto Usuario">
        <p><?php echo isset($name) ? $name : 'Name not found'; ?></p>
        <span class="arrow-icon"></span>
        <div class="form-floating">
            <select>
                <option value="1">My profile</option>
                <option value="2">Group Chat</option>
                <option value="3">Logout</option>
            </select>
        </div>
    </div>
</div>

<div class="">
    <p><a href='/auth/register.php'>Back</a></p>
</div>

<div class="main-content">
    <div class="info-section">
        <div class="info-row">
            <div>
                <h2>Change Info</h2>
                <p id="some">Changes will be reflected to every service</p>
                <div>
                    <img src="" alt="Foto Usuario">
                    <p>CHANGE PHOTO</p>
                </div>
            </div>
        </div>

        <form id="registrationForm" method="POST" action="edit_info.php">
            <div class="">
                <p class="title-info">NAME</p>
                <div class="input-box">
                    <input name="name" type="text" placeholder="Enter your name..." value="<?php echo isset($name) ? $name : ''; ?>">
                </div>
            </div>

            <div class="">
                <p class="title-info">BIO</p>
                <input name="bio" type="text" placeholder="Enter your bio..." value="<?php echo isset($userInfo['bio']) ? $userInfo['bio'] : ''; ?>">
            </div>

            <div class="">
                <p class="title-info">PHONE</p>
                <input name="phone" type="text" placeholder="Enter your phone..." value="<?php echo isset($userInfo['phone']) ? $userInfo['phone'] : ''; ?>">
            </div>

            <div class="">
             <p class="title-info">EMAIL</p>
            <input name="email" type="email" placeholder="Enter your email..." value="<?php echo isset($email) ? $email : ''; ?>">
            </div>


            <div class="">
                <p class="title-info">PASSWORD</p>
                <input name="password" type="password" placeholder="Enter your password...">
            </div>
            <button type="submit" id="saveButton">Save</button>
        </form>
    </div>
</div>

</body>
</html>
