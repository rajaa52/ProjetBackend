<?php
include_once 'C:/xamppp/htdocs/TP/ControleMobile/MedicamentService.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    create();
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    delete();
}

function create() {
    if (!isset($_POST['nom'], $_POST['dosage'], $_POST['frequence'], $_POST['heure_pris'])) {
        echo json_encode(["error" => "Certains champs sont manquants."]);
        return;
    }

    $service = new MedicamentService();
    $medicament = new Medicament(null, $_POST['nom'], $_POST['dosage'], $_POST['frequence'], $_POST['heure_pris']);
    
    try {
        $service->create($medicament);
        echo json_encode(["success" => "Médicament ajouté avec succès."]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Erreur lors de l'ajout : " . $e->getMessage()]);
    }
}

function delete() {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'] ?? null;

    if ($id) {
        $service = new MedicamentService();
        try {
            $service->delete($id);
            echo json_encode(["success" => "Médicament supprimé avec succès."]);
        } catch (Exception $e) {
            echo json_encode(["error" => "Erreur lors de la suppression : " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "Aucun ID d'étudiant spécifié."]);
    }
}
?>