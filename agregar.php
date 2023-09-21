<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <title>Nuevo movimiento</title>
  <style>

  </style>
</head>

<body>

  <?php
  include 'conexion_db.php';
  $resultado = mysqli_query($connection, "SELECT `id_familia`,`nombre` FROM `familiares`");
  if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($connection));
  }
  ?>


  <div class="container">
    <h1>AGREGAR NUEVO MOVIMIENTO</h1>
    <div class="row justify-content-start">
      <div class="col-6">
        <form action="insertar.php" method="post">
          <label>Fecha: </label><br>
          <input type="date" name="fecham" id="fecham"><br>
          <label>Usuario: </label>
          <select id="nombrem" name="nombrem" class="form-select" aria-label="Default select example">
            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
              <option value="<?php echo $row["id_familia"] . $row["nombre"]; ?>">
                <?php echo $row["id_familia"] . '-' . $row["nombre"]; ?>
              </option>
            <?php } ?>
          </select>
          <label>Tipo: </label>
          <select id="tipom" name="tipom" class="form-select" aria-label="Default select example">
            <option value="egreso">egreso</option>
            <option value="ingreso">ingreso</option>
          </select>
          <label>Descripción:</label><input type="text" name="descripcionm" id="descripcionm" class="form-control" id="formGroupExampleInput" placeholder="Descripción del movimiento">
          <label>Monto: </label> <input type="float" name="montom" id="montom" class="form-control" id="formGroupExampleInput" placeholder="Por ejemplo 125056,20">
          <label>Forma: </label>
          <select id="formam" name="formam" class="form-select" aria-label="Default select example">
            <option value="transferencia bancaria">transferencia bancaria</option>
            <option value="tarjeta de crédito">tarejta de crédito</option>
            <option value="efectivo">efectivo</option>
          </select><br>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>