<?php
require_once '../includes/connexion.php'; 
include '../includes/session.php';

$ID_Users = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if (isset($_POST['updateMembre'])) {
    // Récupération des données du formulaire
    $matricule = $_POST['Matricule'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $email = $_POST['Email'];
    $telephone = $_POST['Telephone'];
    $role = isset($_POST['Role']) ? $_POST['Role'] : '';
    $idEquipe = isset($_POST['ID_Eq']) ? $_POST['ID_Eq'] : '';
    $statut = isset($_POST['Statut']) ? $_POST['Statut'] : '';
    $dateNaissance = isset($_POST['Date_naissance']) ? $_POST['Date_naissance'] : '';
    $adresse = $_POST['Adresse'];
    $password = $_POST['Password'];

    // Construction de la requête SQL
    $query = "UPDATE Users SET
    Matricule = ?,
    Nom = ?,
    Prenom = ?,
    Email = ?,
    Telephone = ?,
    Role = ?,
    ID_Eq = ?,
    Statut = ?,
    Date_naissance = ?,
    Adresse = ?";

// Si le mot de passe n'est pas vide, mettre à jour également le mot de passe
if (!empty($password)) {
    $query .= ", Password = ?";
}

$query .= " WHERE ID_Users = ?";

// Utilisation de la requête préparée
$stmt = mysqli_prepare($db, $query);

if ($stmt) {
    // Liaison des paramètres
    if (!empty($password)) {
        mysqli_stmt_bind_param($stmt, 'sssssssssssi', $matricule, $nom, $prenom, $email, $telephone, $role, $idEquipe, $statut, $dateNaissance, $adresse, $hashedPassword, $ID_Users);
    } else {
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $matricule, $nom, $prenom, $email, $telephone, $role, $idEquipe, $statut, $dateNaissance, $adresse, $ID_Users);
    }
    echo $query;
    // Exécution de la requête préparée
    $result = mysqli_stmt_execute($stmt);

    // Fermer la requête préparée
    mysqli_stmt_close($stmt);

    // Vérification des erreurs
    if (!$result) {
        die(mysqli_error($db));
    }

    // Redirection vers la page d'accueil avec un paramètre de succès
    header('Location: ../admin/index.php?success=1');
    exit();
} else {
    die("Erreur lors de la préparation de la requête.");
}
}

// Fonction pour récupérer les données de l'utilisateur depuis la base de données
function fetchUserDataFromDatabase($ID_Users, $db) {
    $query = "SELECT * FROM Users WHERE ID_Users = '$ID_Users'";
    $result = mysqli_query($db, $query);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        die("Erreur lors de la récupération des données de l'utilisateur.");
    }
}

// Appel de la fonction pour récupérer les données de l'utilisateur
$userIDData = fetchUserDataFromDatabase($ID_Users, $db);
?>

<div class="container">
    <div class="modal" id="updateMembre" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier un Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./update_user.php" method="post">
                        <?php if ($userIDData): ?>
                            <div class="mb-3">
                                <label for="Matricule" class="form-label">Matricule</label>
                                <input type="text" class="form-control" id="Matricule" name="Matricule" value="<?php echo $userIDData['Matricule']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="Nom" name="Nom" value="<?php echo $userIDData['Nom']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?php echo $userIDData['Prenom']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $userIDData['Email']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?php echo $userIDData['Telephone']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Role" class="form-label">Rôle</label>
                                <input type="text" class="form-control" id="Role" name="Role" value="<?php echo $userIDData['Role']; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="ID_Equipe" class="form-label">ID Equipe</label>
                                <input type="hidden" id="ID_Eq" name="ID_Eq" value="<?php echo $userIDData['ID_Eq']; ?>">
                            </div>

                            <div class="mb-3">
                            <label for="Statut" class="form-label">Statut</label>
                            <input type="text" class="form-control" id="Statut" name="Statut" value="<?php echo $userIDData['Statut']; ?>" readonly>
                        </div>

                            <div class="mb-3">
                                <label for="Date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="Date_naissance" name="Date_naissance" value="<?php echo $userIDData['Date_naissance']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="Adresse" name="Adresse" value="<?php echo $userIDData['Adresse']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="Password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Laissez vide pour ne pas changer le mot de passe">
                            </div>
                        <?php endif; ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success" name="updateMembre">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
