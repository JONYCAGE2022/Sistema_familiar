<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>SISTEMA FAMILIAR</title>
</head>

<body>

    <?php

    include 'conexion_db.php';

    $records_per_page = 10;

    require 'vendor/autoload.php';

    $pagination = new Zebra_Pagination();

    $pagination->labels('Anterior', 'Siguiente');
    $pagination->navigation_position('');

    $sql = "SELECT m.id_mov, m.fecha, m.tipo, m.descripcion, m.monto, m.forma_de_pago, f.nombre FROM movimientos m JOIN familiares f on f.id_familia = m.id_familia ORDER BY m.id_mov DESC LIMIT " .
        (($pagination->get_page() - 1) * $records_per_page) . ', ' .
        $records_per_page . ' ';

    if (!($result = @mysqli_query($connection, $sql)))
        die(mysqli_error($connection));

    $rows = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) AS 'rows' FROM movimientos"));

    $pagination->records($rows['rows']);

    $pagination->records_per_page($records_per_page);

    ?>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-5">
                <h1>ABM SISTEMA FAMILIAR</h1>
            </div>
            <div class="col-3">
                <form action="agregar.php" method="post">
                    <button class="btn btn-primary">
                        Agregar nuevo movimiento
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">

                <table class="table table-bordered" border="1">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Forma de pago</th>
                            <th>Nombre</th>
                            <th>Editar/ Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr<?php echo $index++ % 2 ? ' class="even"' : ''; ?>>
                                <td>
                                    <?php
                                    echo $row['fecha'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $row['tipo'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $row['descripcion'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '$' . $row['monto'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $row['forma_de_pago'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $row['nombre'];
                                    ?>
                                </td>
                                <td>
                                    <button onclick="window.location.href='editar.php?id_mov=<?php echo $row['id_mov']; ?>'" class="btn btn-warning">Editar</button> - <button onclick="window.location.href='eliminar.php?id_mov=<?php echo $row['id_mov']; ?>'" class="btn btn-danger">Eliminar</button>
                                </td>
                                </tr><?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="text-center">
        <?php
        $pagination->render();
        ?>
    </div>
</body>

</html>