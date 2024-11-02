<?php
include_once 'C:/xamppp/htdocs/ControleMobile/service/MedicamentService.php';
include_once 'C:/xamppp/htdocs/ControleMobile/classes/Medicament.php'; // Assurez-vous que le fichier Medicament.php est inclus

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    create();
}

function create() {
    // Vérifie si les champs requis sont présents
    if (!isset($_POST['nom'], $_POST['dosage'], $_POST['frequence'], $_POST['heure_pris'])) {
        echo json_encode(["error" => "Certains champs sont manquantss."]);
        return;
    }

    // Créer une instance de Medicament avec les données POST
    $medicament = new Medicament(
        null, // ID, si nécessaire, peut être auto-incrémenté par la base de données
        $_POST['nom'],
        $_POST['dosage'],
        $_POST['frequence'],
        $_POST['heure_pris']
    );

    // Instancier le service et appeler la méthode create
    $service = new MedicamentService();
    
    try {
        $service->create($medicament); // Passez l'objet Medicament ici
        echo json_encode(["success" => "Médicament ajouté avec succès."]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Erreur lors de l'ajout : " . $e->getMessage()]);
    }
}
?>