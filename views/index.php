<?php
 if (!isset($_SESSION['username']) ) {
        header("Location: /");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-6">
                <h1>Lista de Usuarios</h1>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-danger" href="?action=logout">Cerrar Sesión</a>
            </div>
        </div>
        <a class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">Crear Usuario</a>
        <table id="usuariosTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>CI / RUC</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $usuarios->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['ci_ruc']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal<?php echo $row['id']; ?>">Editar</a>
                            <a class="btn btn-danger btn-sm" href="?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</a>
                        </td>
                        <?php include 'components/ModalEditarUsuario.php'; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <!-- modales -->
    <?php include 'components/ModalCrearUsuario.php'; ?>

    <script>
        $(document).ready(function() {
            $('#usuariosTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
