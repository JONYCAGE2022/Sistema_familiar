<?php
if (isset($_POST["nombrem"])) {
  alta();
}

function alta()
{
    include("conexion_db.php");
    $fecha = $_POST['fecham'];
    $id = $_POST["nombrem"];
    $tipo = $_POST["tipom"];
    $descripcion = $_POST["descripcionm"];
    $monto = $_POST["montom"];
    $forma = $_POST["formam"];

    // Asegúrate de rodear los valores de cadena con comillas simples
    $sql = "INSERT INTO `movimientos` (`id_mov`, `fecha`, `tipo`, `descripcion`, `monto`, `forma_de_pago`, `id_familia`) VALUES (NULL, '$fecha', '$tipo', '$descripcion', '$monto', '$forma', '$id')";

    $resultado = mysqli_query($connection, $sql);
    mysqli_close($connection);
    if ($resultado) {
        $mensaje = "Movimiento dado de alta con éxito.";
    } else {
        $mensaje = "Ocurrió un error. No se pudo dar de alta el movimiento.";
    }
    
    // Muestra el mensaje en una ventana emergente (popup)
    echo '<script>
            alert("' . $mensaje . '");
            window.location.href = "index.php";
          </script>';
}
?>    