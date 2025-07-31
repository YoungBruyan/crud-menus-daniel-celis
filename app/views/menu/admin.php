<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/public">Previsualizar Menu</a>
    </div>
</nav>

<main class="container my-5">

    <!-- Botón -->
    <div class="d-flex justify-content-end">
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalMenu">
            <i class="fa-solid fa-plus me-2"></i>Nuevo
        </button>
    </div>

    <!-- Modal Crear Menu-->
    <div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="modalMenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formCrearMenu" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMenuLabel">Crear nuevo menú</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre del Menú</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Menú Padre (opcional)</label>
                        <select name="menu_padre_id" class="form-select">
                            <option value="">Ninguno</option>
                            <?php foreach ($menus as $m): ?>
                                <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Editar Menú -->
    <div class="modal fade" id="modalEditarMenu" tabindex="-1" aria-labelledby="modalEditarMenuLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarMenu">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Menú</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">

                        <div class="mb-3">
                            <label for="edit_nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="edit_nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_precio" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" name="precio" id="edit_precio">
                        </div>

                        <div class="mb-3">
                            <label for="edit_menu_padre_id" class="form-label">Menú Padre</label>
                            <select class="form-select" name="menu_padre_id" id="edit_menu_padre_id">
                                <option value="">Ninguno</option>
                                <?php foreach ($menus as $opcion): ?>
                                    <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="edit_descripcion" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Eliminar Menú -->
    <div class="modal fade" id="modalEliminarMenu" tabindex="-1" aria-labelledby="modalEliminarMenuLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEliminarMenu">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Menú</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="delete_id">
                        <p>¿Estás seguro que deseas eliminar el menú <strong id="delete_nombre"></strong>?</p>
                        <p class="text-danger small">* Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Tabla de Menús -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre del Menú</th>
                <th>Menú Padre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><?= $menu['id'] ?></td>
                    <td><?= htmlspecialchars($menu['nombre']) ?></td>
                    <td><?= $menu['nombre_padre'] ?? '' ?></td>
                    <td><?= htmlspecialchars($menu['descripcion']) ?></td>
                    <td>$<?= number_format($menu['precio'], 2) ?></td>
                    <td width="150" align="center">
                        <div class="" style="max-height: 30px;">
                            <button data-id="<?= $menu['id'] ?>" data-nombre="<?= htmlspecialchars($menu['nombre']) ?>"
                                data-precio="<?= $menu['precio'] ?>" data-padre="<?= $menu['padre_id'] ?? 0 ?>" data-descripcion="<?= htmlspecialchars($menu['descripcion']) ?>"
                                class="btn btn-warning btn-sm btn-edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btnEliminar" data-id="<?= $menu['id'] ?>"
                                data-nombre="<?= htmlspecialchars($menu['nombre']) ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>


<!-- Scripts para los metodos -->
<script>
    $(document).ready(function () {
        $('#formCrearMenu').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/public/menu/store',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if (res.status === 'ok') {
                        alert('Menú creado correctamente');
                        location.reload();
                    } else {
                        alert('Error: ' + (res.message || 'Error inesperado'));
                    }
                },
                error: function () {
                    alert('Error de conexión con el servidor.');
                }
            });
        });
    });


    $(document).ready(function () {
        // ... tu código actual del formCrearMenu

        // Abrir modal con datos
        $('.btn-edit').on('click', function () {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const precio = $(this).data('precio');
            const padre = $(this).data('padre');
            const descripcion = $(this).data('descripcion');

            $('#edit_id').val(id);
            $('#edit_nombre').val(nombre);
            $('#edit_precio').val(precio);
            $('#edit_menu_padre_id').val(padre);
            $('#edit_descripcion').val(descripcion);

            $('#modalEditarMenu').modal('show');
        });

        // Enviar cambios
        $('#formEditarMenu').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/public/menu/update',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'ok') {
                        alert('Menú actualizado con éxito');
                        location.reload();
                    } else {
                        alert('Error: ' + (res.message || 'Error inesperado'));
                    }
                },
                error: function () {
                    alert('Error al comunicarse con el servidor.');
                }
            });
        });
    });


    $(document).ready(function () {
        // Botón eliminar abre el modal
        $('.btnEliminar').on('click', function () {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');

            $('#delete_id').val(id);
            $('#delete_nombre').text(nombre);
            $('#modalEliminarMenu').modal('show');
        });

        // Enviar petición AJAX para eliminar
        $('#formEliminarMenu').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/public/menu/delete',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'ok') {
                        alert('Menú eliminado correctamente');
                        location.reload();
                    } else {
                        alert('Error: ' + (res.message || 'No se pudo eliminar'));
                    }
                },
                error: function () {
                    alert('Error de conexión con el servidor.');
                }
            });
        });
    });



</script>