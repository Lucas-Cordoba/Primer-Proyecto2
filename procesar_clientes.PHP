<?php 
try {
    $pdo = new PDO("sqlsrv:Server=localhost\\MSSQLSERVER02;Database=procesar_clientes;ConnectionPooling=0", "Admin-12\\Admin-12","");
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    // Preparar la consulta SQL para insertar los datos en la tabla "clientes"
    $sql = "INSERT INTO clientes (nombre, apellido, telefono, email) VALUES (:nombre, :apellido, :telefono, :email)";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta con los datos recibidos del formulario
    try {
        $stmt->execute(array(
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':telefono' => $telefono,
            ':email' => $email
        ));
        echo "Los datos se han insertado correctamente en la base de datos.";
    } catch (PDOException $e) {
        die("Error al insertar datos en la base de datos: " . $e->getMessage());
    }
}

?>