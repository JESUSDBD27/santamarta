<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario de XAMPP
$password = ""; // Contraseña vacía por defecto
$dbname = "contactos"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre']; // Cambia 'name' por 'nombre'
$resena = $_POST['resena']; // Cambia 'message' por 'resena'

// Preparar la consulta SQL
$sql = "INSERT INTO mensajes (nombre, calificacion) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Verificar si se preparó correctamente
if ($stmt === false) {
    die("Error en la preparación de la declaración: " . $conn->error);
}

// Vincular los parámetros
$stmt->bind_param("ss", $nombre, $resena); // Cambia 'mensaje' por 'resena'

// Ejecutar la consulta
if ($stmt->execute()) {
    // Mensaje de éxito con botón "Salir"
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reseña Enviada</title>
       
    </head>
    <body>
        <div class="container">
            <h1>Reseña enviada correctamente.</h1>
            <a href="http://127.0.0.1:3000/INDEX.html" class="btn">Salir</a>
        </div>
    </body>
    </html>';
} else {
    echo "Error al enviar la reseña: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>