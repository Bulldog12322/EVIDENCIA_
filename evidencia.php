<?php
// Conexión a la base de datos (ajusta los datos de conexión)
$servername = "tu_servidor";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL (similar a la proporcionada anteriormente)
    $sql = "SELECT c.id_cliente, c.nombre AS nombre_cliente, p.id_producto, se_entrego, c.telefono AS telefono_cliente
            FROM pedidos p
            INNER JOIN clientes c ON p.id_cliente = c.id_cliente";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Generar la tabla HTML
    echo "<table>";
    echo "<tr><th>ID Cliente</th><th>Nombre Cliente</th><th>ID Producto</th><th>Se Entregó</th><th>Teléfono</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['id_cliente'] . "</td>";
        echo "<td>" . $row['nombre_cliente'] . "</td>";
        echo "<td>" . $row['id_producto'] . "</td>";
        echo "<td>" . ($row['se_entrego'] ? 'Sí' : 'No') . "</td>";
        echo "<td>" . $row['telefono_cliente'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>