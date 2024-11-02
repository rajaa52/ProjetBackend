<?php
class Medicament {
    private $id;
    private $nom;
    private $dosage;
    private $frequence;
    private $heure_pris;

    function __construct($id, $nom, $dosage, $frequence, $heure_pris) {
        $this->id = $id;
        $this->nom = $nom;
        $this->dosage = $dosage;
        $this->frequence = $frequence;
        $this->heure_pris = $heure_pris;
    }

    function getId() { return $this->id; }
    function getNom() { return $this->nom; }
    function getDosage() { return $this->dosage; }
    function getFrequence() { return $this->frequence; }
    function getHeurePris() { return $this->heure_pris; }

    function setId($id) { $this->id = $id; }
    function setNom($nom) { $this->nom = $nom; }
    function setDosage($dosage) { $this->dosage = $dosage; }
    function setFrequence($frequence) { $this->frequence = $frequence; }
    function setHeurePris($heure_pris) { $this->heure_pris = $heure_pris; }

    public function __toString() {
        return $this->nom . " (" . $this->dosage . ")";
    }
}
?>