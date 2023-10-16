<?php
// db_connection.php
function openConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

function getUserInfo($userId) {
    global $conn;  // Accede a la conexión global

    // Verifica si la conexión está establecida
    if ($conn === null) {
        $conn = openConnection();  // Si no está establecida, inicialízala
    }

    // Ahora intenta preparar la consulta
    $sql = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $sql->bind_param('i', $userId);
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    } else {
        return null;  // No se encontró el usuario
    }
}
?>