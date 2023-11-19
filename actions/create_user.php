<div class="container">
    <div class="modal" id="ajoutMembreModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouterUser"])) {
                        // Récupération des données du formulaire
                        $matricule = $_POST["Matricule"];
                        $nom = $_POST["Nom"];
                        $prenom = $_POST["Prenom"];
                        $email = $_POST["Email"];
                        $telephone = $_POST["Telephone"];
                        $role = $_POST["Role"];
                        $idEquipe = $_POST["ID_Equipe"];
                        $statut = $_POST["Statut"];
                        $dateNaissance = $_POST["Date_naissance"];
                        $adresse = $_POST["Adresse"];
                        $password = $_POST["Password"];

                        // Vérification si l'email existe déjà
                        $sqlCheckEmail = "SELECT COUNT(*) as count FROM Users WHERE Email = '$email'";
                        $resultCheckEmail = mysqli_query($db, $sqlCheckEmail);
                        $row = mysqli_fetch_assoc($resultCheckEmail);
                        $emailCount = $row['count'];

                        if ($emailCount > 0) {
                            echo "Erreur : L'adresse e-mail existe déjà.";
                        } else {
                            // Ajout des données dans la base de données
                            $sqlInsert = "INSERT INTO Users (Matricule, Nom, Prenom, Email, Telephone, Role, ID_Eq, Statut, Date_naissance, Adresse, Password) 
                            VALUES ('$matricule', '$nom', '$prenom', '$email', '$telephone', '$role', '$idEquipe', '$statut', '$dateNaissance', '$adresse', '$password');";

                            $resInsert = mysqli_query($db, $sqlInsert);

                            if ($resInsert) {
                                // Redirection vers la page index.php après l'ajout réussi
                                header('Location: /DataWare/index.php');
                                exit();
                            } else {
                                echo "Erreur lors de l'ajout de l'employé : " . mysqli_error($db);
                            }
                        }
                    }
                    ?>
                    <form action="index.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Matricule" class="form-label">Matricule</label>
                                <input type="text" class="form-control" id="Matricule" name="Matricule" placeholder="Entrez le matricule" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="Nom" name="Nom" placeholder="Entrez le nom" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="Prenom" name="Prenom" placeholder="Entrez le prénom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" placeholder="Entrez l'adresse e-mail" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Telephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" id="Telephone" name="Telephone" placeholder="Entrez le numéro de téléphone" required>
                            </div>
                            <div class="col-md-6">
                            <label for="Role" class="form-label">Role</label>
                            <select class="form-select" id="Role" name="Role" aria-label="Default select example">
                                <option selected disabled>Choisissez un rôle</option>
                                <option value="Admin">Admin</option>
                                <option value="Developer">Developer</option>
                                <option value="Tester">Tester</option>
                                <option value="Security Analyst">Security Analyst</option>
                                <option value="DevOps Engineer">DevOps Engineer</option>
                            </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ID_Equipe" class="form-label">ID Equipe</label>
                                <input type="text" class="form-control" id="ID_Equipe" name="ID_Equipe" placeholder="Entrez l'ID de l'équipe" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Statut" class="form-label">Statut</label>
                                <select class="form-select" id="Statut" name="Statut" aria-label="Default select example">
                                    <option selected>Choisissez un statut</option>
                                    <option value="Actif">Actif</option>
                                    <option value="Inactif">Inactif</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="Date_naissance" name="Date_naissance" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="Adresse" name="Adresse" placeholder="Entrez l'adresse" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Entrez le mot de passe" required>
                            </div>
                            <!-- Ajoutez d'autres champs de la même manière -->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-success" name="ajouterUser">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
