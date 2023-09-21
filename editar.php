<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <title>Editar un movimiento</title>
</head>

<body>
  <?php
  include("conexion_db.php");

  if (!isset($_GET["id_mov"])) {
    echo "No se pasó el movimiento";
  } else {
    $sql = "SELECT M.*, F.nombre FROM `movimientos` M INNER JOIN `familiares` F ON F.id_familia = M.id_familia WHERE M.id_mov=" . $_GET["id_mov"] . ";";
    $resultado = mysqli_query($connection, $sql);
    if (mysqli_num_rows($resultado) == 1) {
      $row = mysqli_fetch_array($resultado);
      $id = $row["id_mov"];
      $id_mov = $row["id_familia"];
      $id_movcompleto = $row["nombre"];
      $fecha = $row["fecha"];
      $tipo = $row["tipo"];
      $descripcion = $row["descripcion"];
      $monto = $row["monto"];
      $forma = $row["forma_de_pago"];
    } else {
      echo "No se encuentra el id_mov del empleado.";
      exit();
    }

    $resultado2 = mysqli_query($connection, "SELECT `id_familia`,`nombre` FROM `familiares` WHERE  id_familia <> $id_mov");
    if (!$resultado2) {
      die("Error en la consulta: " . mysqli_error($connection));
    }

    mysqli_close($connection);
  ?>

    <div class="container">
      <h1>ACTUALIZAR UN MOVIMIENTO</h1>
      <div class="row justify-content-start">
        <div class="col-6">
          <form action="modificar.php" method="post">
            <label>Identificación de movimiento</label><input type="text" name="idm" id="idm" value="<?php echo $id; ?>" readonly class="form-control">
            <label>Fecha: </label><br>
            <input type="date" name="fecham" id="fecham" value="<?php echo $fecha; ?>"><br>
            <label>Usuario: </label>
            <select id="nombrem" name="nombrem" class="form-select" aria-label="Default select example">
              <option value="<?php echo $row["id_familia"] . $row["nombre"]; ?>">
                <?php echo $row["id_familia"] . '-' . $row["nombre"]; ?>
                <?php  ?>
                <?php while ($row2 = mysqli_fetch_assoc($resultado2)) { ?>
              <option value="<?php echo $row2["id_familia"] . $row2["nombre"]; ?>">
                <?php echo $row2["id_familia"] . '-' . $row2["nombre"]; ?>
              </option>
            <?php } ?>
            </select>
            <label>Tipo: </label>
            <select id="tipom" name="tipom" class="form-select" aria-label="Default select example">
              <option value="egreso" <?php if ($tipo == "egreso") {
                                        echo "selected";
                                      } ?>>Egreso</option>
              <option value="ingreso" <?php if ($tipo == "ingreso") {
                                        echo "selected";
                                      } ?>>Ingreso</option>
            </select>
            <label>Descripción:</label><input type="text" name="descripcionm" id="descripcionm" value="<?php echo $descripcion; ?> " class="form-control">
            <label>Monto: </label> <input type="float" name="montom" id="montom" value="<?php echo $monto; ?>" class="form-control">
            <label>Forma: </label>
            <select id="formam" name="formam" class="form-select" aria-label="Default select example">
              <option value="transferencia bancaria" <?php if ($tipo == "transferencia bancaria") {
                                                        echo "selected";
                                                      } ?>>Transferencia bancaria</option>
              <option value="tarjeta de crédito" <?php if ($tipo == "tarjeta de crédito") {
                                                    echo "selected";
                                                  } ?>>Tarejta de crédito</option>
              <option value="efectivo" <?php if ($tipo == "efectivo") {
                                          echo "selected";
                                        } ?>>Efectivo</option>
            </select>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>
</body>

</html>