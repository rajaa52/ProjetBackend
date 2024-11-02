<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'C:/xamppp/htdocs/ControleMobile/service/MedicamentService.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    getMedicaments();
}

function getMedicaments() {
    $service = new MedicamentService();
    try {
        $medicaments = $service->getAllMedicaments();
        header('Content-Type: application/json');
        echo json_encode($medicaments);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Erreur lors de la récupération des médicaments : " . $e->getMessage()]);
    }
}
?>