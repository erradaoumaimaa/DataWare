<?php
$sql = "SELECT 
        Users.ID_Users,
        Users.Matricule,
        CONCAT(Users.Nom, ' ', Users.Prenom) AS NomPrenom,
        Users.Email,
        Users.Telephone,
        Users.Role,
        Users.Statut,
        Users.Date_naissance,
        Users.Adresse,
        Users.ID_Eq,  
        Equipes.Name_Eq AS NomEquipe
        FROM Users
        LEFT JOIN Equipes ON Users.ID_Eq = Equipes.ID_Eq"; 

// Exécution de la requête
$result = mysqli_query($db, $sql);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($db));
}
?>