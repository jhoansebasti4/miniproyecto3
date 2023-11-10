<?php
// edit_info.php
require_once('db_connection.php');

session_start();

// Abre la conexión a la base de datos
$conn = openConnection();

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

        // Verifica si se subió una nueva foto
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $target_directory = 'user/uploads/';

            // Crea el directorio si no existe
            if (!file_exists($target_directory)) {
                mkdir($target_directory, 0777, true);
            }

            $target_file = $target_directory . basename($_FILES["photo"]["name"]);
            
            // Mueve el archivo al directorio de destino
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Actualiza la ruta de la foto en la base de datos
                $update_photo_query = "UPDATE usuarios SET photo='$target_file' WHERE id=" . $_SESSION['user_id'];
                $conn->query($update_photo_query);
            } else {
                echo "Error al subir la foto.";
            }
        }

        // Crear la consulta para actualizar la información del usuario
        $update_query = "UPDATE usuarios 
                         SET name='$name', bio='$bio', phone='$phone', email='$email', password='$hashed_password' 
                         WHERE id=" . $_SESSION['user_id'];

        if ($conn->query($update_query) === TRUE) {
            // Éxito
        } else {
            echo "Error al actualizar la información del usuario: " . $conn->error;
        }
    }
}

$userInfo = getUserInfo($_SESSION['user_id']);

$conn->close();
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
<div class="registration-view">
<div class="header">
    <div class="logo-text">
        <img src="../assets/devchallenges.svg" alt="Logo">
    </div>
    <div class="user-profile">
        <img src="<?= $userInfo['photo'] ?>" alt="Foto Usuario">
        <p><?= $userInfo['name'] ?></p>
        <span class="arrow-icon"></span>
        <div class="form-floating">
        <select id="menuSelect">
            <option value="1" data-url="/user/personal_info.php">My profile</option>
            <option value="2" data-url="">Group Chat</option>
            <option value="3" data-url="/auth/logout.php">Logout</option>
        </select>
        
        </div>
    </div>
</div>

<div class="back">
<button class="back" type="button" id="backButton"> < Back</button>    
</div>

<div class="main-content">
    <div class="info-section">
        <form method="POST" enctype="multipart/form-data" id="editForm" class="info-section">
            <!-- Campo PHOTO -->
            <div class="info-row">
                <div>
                    <h2>Change Info</h2>
                    <p id="some">Changes will be reflected to every service</p>
                    <div class="info-row">
                    <input type="file" name="photo" id="fileInput" style="display: none;">
                    <label class="fileInput" for="fileInput">
                        <img class="fileInput"  src="<?= $userInfo['photo'] ?>" alt="Foto de usuario" input type="file" name="photo">
                    </label> 
                    <p id="change">CHANGE PHOTO</p>  
                    </div>              
                </div>
            </div>
            
            <!-- Campo NAME -->
            <div>
                <p class="title-info">NAME</p>
                <div>
                    <input  class="editinfo" name="name" type="text" placeholder="Enter your name..." value="<?= $userInfo['name'] ?>">
                </div>
            </div>
            <!-- Campo BIO -->
            <div >
                <p class="title-info">BIO</p>
                <input class="editinfo" name="bio" type="text" placeholder="Enter your bio..." value="<?= $userInfo['bio'] ?>">
            </div>
            <!-- Campo PHONE -->
            <div >
                <p class="title-info">PHONE</p>
                <input class="editinfo" name="phone" type="text" placeholder="Enter your phone..." value="<?= $userInfo['phone'] ?>">
            </div>
            <!-- Campo EMAIL -->
            <div >
                <p class="title-info">EMAIL</p>
                <input class="editinfo" name="email" type="email" placeholder="Enter your email..." value="<?= $userInfo['email'] ?>">
            </div>
            <!-- Campo PASSWORD -->
            <div >
                <p class="title-info">PASSWORD</p>
                <input class="editinfo" name="password" type="password" placeholder="Enter your password...">
            </div>
            <!-- Botón Save -->
            <button class="button-edit" type="submit" id="saveButton">Save</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('menuSelect').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var redirectUrl = selectedOption.getAttribute('data-url');

        console.log("Redirecting to:", redirectUrl);

        if (redirectUrl) {
            // Si seleccionó "Logout", cerrar la sesión después de redirigir
            if (selectedOption.value === '3') {
                // Puedes realizar una llamada a tu script de logout en el servidor
                // Ejemplo de cómo podría ser:
                // fetch(redirectUrl, { method: 'POST' });

                // Redirige a la página de logout después de cerrar la sesión
                window.location.href = redirectUrl;
            } else {
                // Redirige a otras páginas inmediatamente
                window.location.href = redirectUrl;
            }
        }
    });

    document.getElementById('backButton').addEventListener('click', function () {
        window.location.href = '/user/personal_info.php';
    });

    document.getElementById('fileInput').addEventListener('change', function (e) {
        const fileInput = e.target;
        const label = fileInput.nextElementSibling;
        const img = label.querySelector('.fileInput');

        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                img.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>
