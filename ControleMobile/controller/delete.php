<?php
include_once 'C:/xamppp/htdocs/ControleMobile/service/MedicamentService.php'; // Vérifiez que le chemin est correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Requête POST reçue."); // Log pour indiquer que la requête a été reçue
    delete(); // Appel de la fonction delete
}

function delete() {
    // Récupérer l'ID du médicament depuis les données POST
    $id = $_POST['id'] ?? null;
    error_log("ID reçu: " . json_encode($id)); // Log de l'ID reçu

    if ($id) {
        $service = new MedicamentService(); // Instancier le service
        try {
            error_log("Tentative de suppression de l'ID: " . $id); // Log avant l'appel à la méthode delete
            $response = $service->delete($id); // Appeler la méthode delete
            error_log("Réponse du service: " . json_encode($response)); // Log de la réponse
            echo $response; // Renvoyer la réponse JSON
        } catch (Exception $e) {
            error_log("Erreur lors de la suppression: " . $e->getMessage()); // Log de l'exception
            echo json_encode(["error" => "Erreur lors de la suppression : " . $e->getMessage()]);
        }
    } else {
        error_log("Erreur: Aucun ID de médicament spécifié."); // Log d'erreur pour l'ID manquant
        echo json_encode(["error" => "Aucun ID de médicament spécifié."]);
    }
}
?>