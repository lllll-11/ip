<?php
// Nombre del archivo que almacenará las IP's y los nombres.
$file_with_data = 'data.json';

// Obtiene el contenido del archivo JSON.
$data = file_get_contents($file_with_data);

// Decodifica el contenido JSON.
$data = json_decode($data, true);

// Comprueba si se ha enviado un formulario.
if (isset($_POST['submit'])) {

    // Obtiene la IP del usuario.
    $ip = $_SERVER['REMOTE_ADDR'];

    // Obtiene el nombre del usuario.
    $name = $_POST['name'];

    // Agrega la nueva información al array.
    $data[$ip] = $name;

    // Codifica el array en formato JSON.
    $json_data = json_encode($data);

    // Guarda los datos en el archivo JSON.
    file_put_contents($file_with_data, $json_data);
}

// Muestra el formulario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recolectar datos</title>
</head>
<body>
    <h1>Recolectar datos</h1>

    <form method="post" action="">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required><br><br>
        <input type="submit" name="submit" value="Enviar">
    </form>

    <h2>Datos recolectados:</h2>
    <ul>
        <?php
        // Itera sobre los datos y muestra cada entrada.
        foreach ($data as $ip => $name) {
            echo "<li>IP: $ip - Nombre: $name</li>";
        }
        ?>
    </ul>
</body>
</html>