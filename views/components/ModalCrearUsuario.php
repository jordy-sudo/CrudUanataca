<div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>Crear Usuario</h1>
                <form id="crearUsuarioForm" action="?action=create" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="ci_ruc" class="form-label">CI / RUC:</label>
                        <input type="text" class="form-control" id="ci_ruc" name="ci_ruc" required required >
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required >
                        <div class="form-text">Ingrese un número de teléfono válido (10 dígitos).</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="form-text">Ingrese una dirección de correo electrónico válida.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('ci_ruc').addEventListener('input', function(event) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);
        });

        document.getElementById('telefono').addEventListener('input', function(event) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10); 
        });
    });
</script>