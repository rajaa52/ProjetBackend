<?php
interface IMedicamentDao {
    function create($medicament);
    function delete($id);
    function update($medicament);
    function findAll();
    function findById($id);
}
?>