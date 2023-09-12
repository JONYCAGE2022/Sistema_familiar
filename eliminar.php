<?php

include("conexion_db.php");

if(isset($_GET['id_mov'])) {
    
    $id_mov = $_GET['id_mov'];

    $sql = "DELETE FROM movimientos WHERE id_mov = $id_mov";

    $resultado = mysqli_query($connection, $sql);

    if ($resultado) {
        $mensaje= "Movimiento eliminado con éxito.";
    } else {
        $mensaje= "No se pudo eliminar el movimiento";
    }
} else {
    echo "Falta el parámetro 'id_mov' en la solicitud.";
    exit();
}

mysqli_close($connection);

// Muestra el mensaje en una ventana emergente (popup)
echo '<script>
alert("' . $mensaje . '");
window.location.href = "index.php";
</script>';
