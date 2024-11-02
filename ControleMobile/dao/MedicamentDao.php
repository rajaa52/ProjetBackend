<?php
include_once 'C:/xampp/htdocs/ControleMobile/connexion/Connexion.php';
include_once 'C:/xampp/htdocs/ControleMobile/classes/Medicament.php';
include_once 'C:/xampp/htdocs/ControleMobile/dao/IMedicamentDao.php';

class MedicamentDao implements IMedicamentDao {
    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($medicament) {
        $query = "INSERT INTO medicaments (nom, dosage, frequence, heure_pris) VALUES (:nom, :dosage, :frequence, :heure_pris)";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindValue(':nom', $medicament->getNom());
        $req->bindValue(':dosage', $medicament->getDosage());
        $req->bindValue(':frequence', $medicament->getFrequence());
        $req->bindValue(':heure_pris', $medicament->getHeurePris());
        $req->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM medicaments WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function update($medicament) {
        $query = "UPDATE medicaments SET nom = :nom, dosage = :dosage, frequence = :frequence, heure_pris = :heure_pris WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindValue(':nom', $medicament->getNom());
        $req->bindValue(':dosage', $medicament->getDosage());
        $req->bindValue(':frequence', $medicament->getFrequence());
        $req->bindValue(':heure_pris', $medicament->getHeurePris());
        $req->bindValue(':id', $medicament->getId());
        $req->execute();
    }

    public function findAll() {
        $medicaments = [];
        $query = "SELECT * FROM medicaments";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_OBJ)) {
            $medicaments[] = new Medicament($row->id, $row->nom, $row->dosage, $row->frequence, $row->heure_pris);
        }
        return $medicaments;
    }

    public function findById($id) {
        $query = "SELECT * FROM medicaments WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindValue(':id', $id);
        $req->execute();
        
        if ($row = $req->fetch(PDO::FETCH_OBJ)) {
            return new Medicament($row->id, $row->nom, $row->dosage, $row->frequence, $row->heure_pris);
        }
        return null;
    }
}
?>