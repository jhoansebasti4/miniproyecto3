<?php
// personal_info.php
require_once __DIR__ . '/db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$userInfo = getUserInfo($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/personal_info.css">
    <title>Personal_info.php</title>
</head>
<body>

<div class="registration-view">
    <div class="header">
        <div class="logo-text">
            <img src="../assets/devchallenges.svg" alt="Logo">
        </div>
        <div class="user-profile">
            <img src="<?= isset($userInfo['photo']) ? $userInfo['photo'] : 'ruta_a_la_foto_por_defecto.jpg'; ?>" alt="Foto de usuario">
            <p><?= isset($userInfo['name']) ? $userInfo['name'] : 'Name not found'; ?></p>
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

    <div class="title">
        <h1>Personal info</h1>
        <p id="bilynap">Basic info, like your name and photo</p>
    </div>

    <div class="main-content">
        <div class="info-section">
            <div class="info-row">
                <div>
                    <h2>Profile</h2>
                    <p id="some">Some info may be visible to other people</p>
                </div>
                <div class="butt">
                <button class="button-edit" onclick="redirectToEdit()">Edit</button>
                </div>
            </div>
           
            <hr>
            
            <!-- Datos del usuario en una tabla -->
            <table class="info-section" id="infoSection">
                <div class="info-row">
                    <div class="title-info">PHOTO</div>
                    <div class="info-cell">
                        <img class="user-photo" src="<?= isset($userInfo['photo']) ? $userInfo['photo'] : 'ruta_a_la_foto_por_defecto.jpg'; ?>" alt="Foto de usuario">
                    </div>
                </div>
                <hr>
                <div class="info-row">
                    <div class="title-info">NAME</div>
                    <div class="title-info2"><?= isset($userInfo['name']) ? $userInfo['name'] : 'Name not found'; ?></div>
                </div>
                <hr>
                <div class="info-row">
                    <div class="title-info">BIO</div>
                    <div class="title-info2"><?= isset($userInfo['bio']) ? $userInfo['bio'] : 'Bio not found'; ?></div>
                </div>
                <hr>
                <div class="info-row">
                    <div class="title-info">PHONE</div>
                    <div class="title-info2"><?= isset($userInfo['phone']) ? $userInfo['phone'] : 'Phone not found'; ?></div>
                </div>
                <hr>
                <div class="info-row">
                    <div class="title-info">EMAIL</div>
                    <div class="title-info2"><?= isset($userInfo['email']) ? $userInfo['email'] : 'Email not found'; ?></div>
                </div>
                <hr>
                <div class="info-row">
                    <div class="title-info">PASSWORD</div>
                    <div class="title-info2">********</div>
                </div>
            </table>
            

        </div>
    </div>
</div>

<script>
    function redirectToEdit() {
        window.location.href = '../user/edit_info.php';
    }

    document.getElementById('menuSelect').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var redirectUrl = selectedOption.getAttribute('data-url');

        console.log("Redirecting to:", redirectUrl);

        if (redirectUrl) {
            if (selectedOption.value === '3') {
 
                window.location.href = redirectUrl;
            } else {
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