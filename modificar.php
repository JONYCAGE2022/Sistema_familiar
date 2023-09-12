<?php
if (isset($_POST["idm"])) {
    editar();
}

function editar(){

    include("conexion_db.php");
    $id = $_POST['idm'];
    $nombre = $_POST['nombrem'];
    $fecha = $_POST["fecham"];
    $tipo = $_POST["tipom"];
    $descripcion = $_POST["descripcionm"];
    $monto = $_POST["montom"];
    $forma = $_POST["formam"];

    // Utiliza una expresión regular para extraer solo los dígitos del comienzo de la cadena
    preg_match('/^\d+/', $nombre, $matches);

// $matches[0] contendrá el número extraído
    $id_familia = $matches[0];

    $sql = "UPDATE `movimientos` SET `id_familia`='$id_familia', `fecha`='$fecha', `tipo`='$tipo', `descripcion`='$descripcion', `monto`='$monto', `forma_de_pago`='$forma' WHERE `id_mov`=$id";
    $resultado = mysqli_query($connection, $sql);
    mysqli_close($connection);
    if ($resultado) {
        $mensaje = "Movimiento modificado con éxito.";
    } else {
        $mensaje = "Ocurrió un error. No se pudo modificar el movimiento.";
    }
    
    // Muestra el mensaje en una ventana emergente (popup)
    echo '<script>
            alert("' . $mensaje . '");
            window.location.href = "index.php";
          </script>';
}
?>


