<?php
class Menu
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM menus ORDER BY menu_padre_id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllWithParentName()
    {
        $sql = "SELECT 
                m.id, 
                m.nombre, 
                m.precio,
                m.descripcion,
                p.nombre AS nombre_padre, 
                p.id AS padre_id
            FROM menus m
            LEFT JOIN menus p ON m.menu_padre_id = p.id
            ORDER BY m.menu_padre_id, m.id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuStructure()
    {
        $menus = $this->getAllWithParentName();
        $estructura = [];

        foreach ($menus as $menu) {
            if ($menu['nombre_padre']) {
                $estructura[$menu['nombre_padre']][] = $menu['nombre'];
            } else {
                $estructura[$menu['nombre']] = $estructura[$menu['nombre']] ?? [];
            }
        }

        return $estructura;
    }   
}
