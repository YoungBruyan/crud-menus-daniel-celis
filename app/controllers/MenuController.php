<?php

class MenuController extends Controller
{
    private $menuModel;

    // Constructor: instancia el modelo Menu
    public function __construct()
    {
        $this->menuModel = new Menu();
    }

    // Muestra la vista de administración con todos los menús y su padre
    public function admin()
    {
        $menus = $this->menuModel->getAllWithParentName();
        $this->view('menu/admin', ['menus' => $menus]);
    }

    // Muestra la vista principal con el árbol de menús
    public function index()
    {
        $menus = $this->menuModel->getAll();
        $estructura = $this->construirArbol($menus);
        $this->view('menu/index', ['menuArbol' => $estructura]);
    }

    // Función recursiva para construir árbol jerárquico de menús
    private function construirArbol(array $menus, $padreId = null)
    {
        $ramas = [];
        foreach ($menus as $menu) {
            if ($menu['menu_padre_id'] == $padreId) {
                $hijos = $this->construirArbol($menus, $menu['id']);
                if (!empty($hijos)) {
                    $menu['hijos'] = $hijos;
                }
                $ramas[] = $menu;
            }
        }
        return $ramas;
    }

    // Crear un nuevo menú (POST)
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');

            $nombre = $_POST['nombre'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $padre = !empty($_POST['menu_padre_id']) ? intval($_POST['menu_padre_id']) : null;
            $descripcion = $_POST['descripcion'] ?? null;

            if (empty($nombre)) {
                ob_clean();
                echo json_encode(['status' => 'error', 'message' => 'El nombre es obligatorio']);
                return;
            }

            // Inserta el nuevo menú en la base de datos
            $stmt = Database::getInstance()->prepare("INSERT INTO menus (nombre, menu_padre_id, precio, descripcion) VALUES (?, ?, ?, ?)");
            $ok = $stmt->execute([$nombre, $padre, $precio, $descripcion]);

            echo json_encode(['status' => $ok ? 'ok' : 'error']);
        }
    }

    // Actualizar un menú existente (POST)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');

            $id = $_POST['id'] ?? null;
            $nombre = $_POST['nombre'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $padre = !empty($_POST['menu_padre_id']) ? intval($_POST['menu_padre_id']) : null;
            $descripcion = $_POST['descripcion'] ?? null;

            if (!$id || empty($nombre)) {
                echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
                return;
            }

            // Actualiza el menú en la base de datos
            $stmt = Database::getInstance()->prepare("UPDATE menus SET nombre = ?, menu_padre_id = ?, precio = ?, descripcion = ? WHERE id = ?");
            $ok = $stmt->execute([$nombre, $padre, $precio, $descripcion, $id]);

            echo json_encode(['status' => $ok ? 'ok' : 'error']);
        }
    }

    // Eliminar un menú (POST), solo si no tiene submenús
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');

            $id = $_POST['id'] ?? null;

            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'ID no válido']);
                return;
            }

            $db = Database::getInstance();

            // Verificar si tiene submenús
            $stmt = $db->prepare("SELECT COUNT(*) as total FROM menus WHERE menu_padre_id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();

            if ($result['total'] > 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No se puede eliminar este menú porque tiene submenús asociados.'
                ]);
                return;
            }

            // Eliminar menú si no tiene hijos
            $stmt = $db->prepare("DELETE FROM menus WHERE id = ?");
            $ok = $stmt->execute([$id]);

            echo json_encode(['status' => $ok ? 'ok' : 'error']);
        }
    }
}
