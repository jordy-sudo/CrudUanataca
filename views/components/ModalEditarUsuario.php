<!-- Modal de Edición para este usuario -->
<div class="modal fade" id="editarUsuarioModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm<?php echo $row['id']; ?>" action="?action=edit" method="post">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" hidden>
                        <input type="text" class="form-control" id="editNombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCiRuc" class="form-label">CI / RUC:</label>
                        <input type="text" class="form-control ci-ruc" id="editCiRuc" name="ci_ruc" value="<?php echo htmlspecialchars($row['ci_ruc']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDireccion" class="form-label">Dirección:</label>
                        <input type="text" class="form-control" id="editDireccion" name="direccion" value="<?php echo htmlspecialchars($row['direccion']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTelefono" class="form-label">Teléfono:</label>
                        <input type="tel" class="form-control telefono" id="editTelefono" name="telefono" value="<?php echo htmlspecialchars($row['telefono']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.ci-ruc').on('input', function() {
            var ciRucValue = $(this).val().replace(/[^0-9]/g, '').substring(0, 10);
            $(this).val(ciRucValue);
        });

        $('.telefono').on('input', function() {
            var telefonoValue = $(this).val().replace(/[^0-9]/g, '').substring(0, 10);
            $(this).val(telefonoValue);
        });
    });
</script>