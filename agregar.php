<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo movimiento</title>
</head>

<body>
  <h1>AGREGAR NUEVO MOVIMIENTO</h1>
  <?php
    include 'conexion_db.php';
    $resultado = mysqli_query($connection,"SELECT `id_familia`,`nombre` FROM `familiares`");
    if (!$resultado) {
      die("Error en la consulta: " . mysqli_error($connection));
    }
  ?>

  <form action="insertar.php" method="post">
    <label>Fecha: </label> <input type="date" name="fecham" id="fecham" ><br>
    <label>Usuario: </label>
    <select id="nombrem" name="nombrem">
          <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
          <option value="<?php echo $row["id_familia"]. $row["nombre"] ; ?>">
            <?php echo $row["id_familia"] . '-'. $row["nombre"]; ?>
          </option>
          <?php } ?>
    </select>
    <label>Tipo: </label>
    <select id="tipom" name="tipom">
      <option value="egreso">egreso</option>
      <option value="ingreso">ingreso</option>
    </select><br>
    <label>Descripción:</label><input type="text" name="descripcionm" id="descripcionm" ><br>
    <label>Monto: </label> <input type="float" name="montom" id="montom"><br>
    <label>Forma: </label>
    <select id="formam" name="formam">
      <option value="transferencia bancaria">transferencia bancaria</option>
      <option value="tarjeta de crédito" >tarejta de crédito</option>
      <option value="efectivo" >efectivo</option>
    </select><br>
    <button type="submit">Agregar</button>
  </form>

</body>

</html>