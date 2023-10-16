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
            <img src="" alt="Foto Usuario">
            <p><?php echo isset($userInfo['name']) ? $userInfo['name'] : 'Name not found'; ?></p>
            <span class="arrow-icon"></span>
            <div class="form-floating">
                <select id="menuSelect">
                    <option value="1">My profile</option>
                    <option value="2">Group Chat</option>
                    <option value="3">Logout</option>
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
                    <button class="button-edit">Edit</button>
                </div>
            </div>
            <hr>

            <div class="info-row">
                <p class="title-info">PHOTO</p>
                <img src="<?php echo isset($userInfo['photo']) ? $userInfo['photo'] : 'ruta_a_la_foto_por_defecto.jpg'; ?>" alt="Foto de usuario">
            </div>
            <hr>

            <div class="info-row">
                <p class="title-info">NAME</p>
                <p class="title-info2"><?php echo isset($userInfo['name']) ? $userInfo['name'] : 'Name not found'; ?></p>
            </div>
            <hr>

            <div class="info-row">
                <p class="title-info">BIO</p>
                <p class="title-info2"><?php echo isset($userInfo['bio']) ? $userInfo['bio'] : 'Bio not found'; ?></p>
            </div>
            <hr>

            <div class="info-row">
                <p class="title-info">PHONE</p>
                <p class="title-info2"><?php echo isset($userInfo['phone']) ? $userInfo['phone'] : 'Phone not found'; ?></p>
            </div>
            <hr>

            <div class="info-row">
                <p class="title-info">EMAIL</p>
                <p class="title-info2"><?php echo isset($userInfo['email']) ? $userInfo['email'] : 'Email not found'; ?></p>
            </div>
            <hr>

            <div class="info-row">
                <p class="title-info">PASSWORD</p>
                <p class="title-info2">********</p>
            </div>
            <hr>
        </div>
    </div>
</div>
<script>
    document.getElementById('menuSelect').addEventListener('change', function () {
        const selectedValue = this.value;

        if (selectedValue === '3') {
            window.location.href = '../auth/register.php';
        }
    });
</script>
</body>
</html>
