<?php
require_once '../controllers/ClientController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new ClientController();

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->edit($id);
        } else {
            echo "ID du client non spécifié.";
        }
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->delete($id);
        } else {
            echo "ID du client non spécifié.";
        }
        break;
    case 'filter':
        $column = isset($_GET['filter_field']) ? $_GET['filter_field'] : null;
        $value = isset($_GET['filter_value']) ? $_GET['filter_value'] : null;
        if ($column && $value) {
            $controller->filter($column, $value);
        } else {
            echo "Critères de filtre non spécifiés.";
        }
        break;
    case 'sort':
        $column = isset($_GET['sort_field']) ? $_GET['sort_field'] : null;
        $order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';
        if ($column) {
            $controller->sort($column, $order);
        } else {
            echo "Critères de tri non spécifiés.";
        }
        break;
    case 'exportCSV':
        $controller->exportCSV();
        break;
    case 'exportPDF':
        $controller->exportPDF();
        break;
    default:
        $controller->index();
        break;
}
?>
