<?php
include_once 'C:/xampp/htdocs/ControleMobile/connexion/Connexion.php';

class MedicamentService {
    private $conn;

    public function __construct() {
        // Instancier la classe Connexion pour obtenir la connexion PDO
        $connexion = new Connexion();
        $this->conn = $connexion->getConnexion();
    }

    public function getAllMedicaments() {
        // Requête SQL pour récupérer tous les médicaments
        $sql = "SELECT * FROM medicament"; // Assurez-vous que le nom de la table est correct
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Récupérer tous les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourner le tableau de médicaments
    }

    public function create(Medicament $medicament) {
        $sql = "INSERT INTO medicament (nom, dosage, frequence, heure_pris) VALUES (:nom, :dosage, :frequence, :heure_pris)";
    
        try {
            $stmt = $this->conn->prepare($sql);

            // Assignez les valeurs à des variables
            $nom = $medicament->getNom();
            $dosage = $medicament->getDosage();
            $frequence = $medicament->getFrequence();
            $heure_pris = $medicament->getHeurePris();

            // Liaison des paramètres
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':dosage', $dosage);
            $stmt->bindParam(':frequence', $frequence);
            $stmt->bindParam(':heure_pris', $heure_pris);

            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout : " . $e->getMessage());
        }
    }

    public function delete($id) {
        // Code pour supprimer le médicament de la base de données
        $query = "DELETE FROM medicament WHERE id = ?"; // Assurez-vous que le nom de la table est correct
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT); // Lier l'ID

        try {
            if ($stmt->execute()) {
                return json_encode(["success" => true]); // Retourner un message de succès
            } else {
                return json_encode(["error" => "Échec de la suppression."]); // Retourner un message d'erreur
            }
        } catch (PDOException $e) {
            return json_encode(["error" => "Erreur lors de la suppression : " . $e->getMessage()]); // Gérer les erreurs
        }
    }
}
?>