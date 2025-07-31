<div class="container mt-5">
    <div class="row">
        <!-- Árbol del Menú -->
        <div class="col-md-4">
            <div id="menu-container">
                <?= renderMenu($menuArbol) ?>
            </div>
        </div>

        <!-- Descripción al centro -->
        <div class="col-md-8">
            <div id="descripcion-menu" class="border p-4 rounded text-center">
                <p class="text-muted">Haz clic en un menú para ver su descripción.</p>
            </div>
            <a href="/public/menu/admin" class="btn btn-primary mt-3">Administrar Menú</a>
        </div>
    </div>
</div>
<?php
function renderMenu($menus)
{
    $html = '<ul class="list-group list-group-flush">';
    foreach ($menus as $menu) {
        $html .= '<li class="list-group-item">';
        $html .= '<a href="#" class="menu-item text-decoration-none" data-nombre="' . htmlspecialchars($menu['nombre']) . '" data-descripcion="' . htmlspecialchars($menu['descripcion']) . '">';
        $html .= htmlspecialchars($menu['nombre']);
        $html .= '</a>';
        if (!empty($menu['hijos'])) {
            $html .= renderMenu($menu['hijos']);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.menu-item').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const nombre = this.dataset.nombre;
            const descripcion = this.dataset.descripcion;

            document.getElementById('descripcion-menu').innerHTML = `
                <h4>${nombre}</h4>
                <p>${descripcion || '-Aun no tiene descripcion-'}</p>
            `;
        });
    });
});
</script>
