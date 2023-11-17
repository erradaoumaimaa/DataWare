<!-- bibliotheque Bootstrap(JQUERY JS) FontAwsome(Icon) -->
<?php include '../includes/biblio_bootstrap.php'; ?>
<div class="container">
    <div class="modal" id="ajoutMembreModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Matricule" class="form-label">Matricule</label>
                                    <input type="text" class="form-control" id="Matricule" name="Matricule" placeholder="Matricule" required>
                                </div>

                                <div class="mb-3">
                                    <label for="NomPrenom" class="form-label">Nom et Prenom</label>
                                    <input type="text" class="form-control" id="NomPrenom" name="NomPrenom" placeholder="Nom et Prenom" required>
                                </div>

                                <div class="mb-3">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="Telephone" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" id="Telephone" name="Telephone" placeholder="Telephone" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Role" class="form-label">Role</label>
                                    <select class="form-select" id="Role" name="Role" aria-label="Default select example">
                                        <option selected>Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Developer</option>
                                        <option value="3">Tester</option>
                                        <option value="4">Security Analyst</option>
                                        <option value="5">DevOps Engineer</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="Statut" class="form-label">Statut</label>
                                    <select class="form-select" id="Statut" name="Statut" aria-label="Default select example">
                                        <option selected>Statut</option>
                                        <option value="1">Actif</option>
                                        <option value="2">Inactif</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="equipe_membre" class="form-label">Equipe</label>
                                    <select class="form-select" id="equipe_membre" name="equipe_membre" aria-label="Default select example">
                                        <option selected>Equipe</option>
                                        <option value="1">Développement Backend</option>
                                        <option value="2">Développement Frontend</option>
                                        <option value="3">QA et Tests</option>
                                        <option value="4">Sécurité Informatique</option>
                                        <option value="5">Infrastructure et DevOps</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="Date_naissance" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control" id="Date_naissance" name="Date_naissance" required>
                                </div>

                                <div class="mb-3">
                                    <label for="Adresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="Adresse" name="Adresse" placeholder="Adresse" required>
                                </div>
                                <select class="form-select" id="equipe_membre" name="equipe_membre"
                                    aria-label="Default select example">
                                    <option selected>Equipe</option>
                                    <?php

                                    $sql = "SELECT ID_Eq,NomEquipe FROM Equipes;";
                                    $res = mysqli_query($db, $sql);
                                    while ($ligne = mysqli_fetch_assoc($res)) {
                                        echo "<option value='" . $ligne['ID_Eq'] . "'>" . $ligne['NomEquipe'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" name="ajouterUser">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["ajouterUser"])) {
        // Récupération des données du formulaire
        $matricule = $_POST["Matricule"];
        $nomPrenom = $_POST["NomPrenom"];
        $email = $_POST["Email"];
        $telephone = $_POST["Telephone"];
        $role = $_POST["Role"];
        $statut = $_POST["Statut"];
        $equipe = $_POST["equipe_membre"];
        $dateNaissance = $_POST["Date_naissance"];
        $adresse = $_POST["Adresse"];
        
        // Nouveau champ pour le nom de l'équipe
        $nomEquipe = $_POST["nom_equipe"];

        // Ajout des données dans la base de données
        $sqlInsert = "INSERT INTO Users (Matricule, Nom, Prenom, Email, Telephone, Role, ID_Equipe, Statut, Date_naissance, Adresse, Password, EstAdmin) 
        VALUES ('$matricule', '$nomPrenom', '$email', '$telephone', '$role', '$idEquipe', '$statut', '$dateNaissance', '$adresse', '$password', '$estAdmin');";
        
        $resInsert = mysqli_query($db, $sqlInsert);

        if ($resInsert) {
            // Redirection vers la page index.php après l'ajout réussi
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'employé : " . mysqli_error($db);
        }
    }
}
?>



               