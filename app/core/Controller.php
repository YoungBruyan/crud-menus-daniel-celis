<?php
class Controller
{
    public function view($view, $data = [], $title = 'Mi App')
    {
        extract($data);

        // Carga contenido de la vista específica
        ob_start();
        require_once __DIR__ . '/../views/' . $view . '.php';

        $content = ob_get_clean();

        // Carga layout general
        require_once __DIR__ . "/../views/layout.php";
    }

}
