<?php
require '../includes/connexion.php';

// Vérifiez si l'ID de l'utilisateur est présent dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Échappez les données pour éviter les injections SQL
    $userId = mysqli_real_escape_string($db, $_GET['id']);

    // Récupérez les données de l'utilisateur à mettre à jour
    $sqlSelect = "SELECT * FROM Users WHERE ID_Users = $userId";
    $resultSelect = mysqli_query($db, $sqlSelect);

    if ($resultSelect) {
        $userData = mysqli_fetch_assoc($resultSelect);

        // Vérifiez si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérez les données du formulaire
            $newEmail = mysqli_real_escape_string($db, $_POST['email']);
            $newTelephone = mysqli_real_escape_string($db, $_POST['telephone']);
            // Ajoutez d'autres champs que vous souhaitez mettre à jour

            // Écrivez la requête de mise à jour
            $sqlUpdate = "UPDATE Users SET Email = '$newEmail', Telephone = '$newTelephone' WHERE ID_Users = $userId";

            // Exécutez la requête de mise à jour
            $resultUpdate = mysqli_query($db, $sqlUpdate);

            // Vérifiez si la mise à jour a réussi
            if ($resultUpdate) {
                echo "Mise à jour réussie.";
                // Redirigez vers la page principale après la mise à jour
                header('Location: ../admin/index.php');
                exit();
            } else {
                echo "Erreur lors de la mise à jour de l'utilisateur : " . mysqli_error($db);
            }
        }
    } else {
        echo "Erreur lors de la récupération des données de l'utilisateur : " . mysqli_error($db);
    }
} else {
    echo "ID d'utilisateur non spécifié ou invalide.";
}
}

?>
<form class="mt-3" method="POST" action="">
    <div class="mb-3">
        <label for="email" class="form-label">Nouvel Email :</label>
        <input type="text" class="form-control" name="email" value="<?php echo $userData['Email']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Nouveau Téléphone :</label>
        <input type="text" class="form-control" name="telephone" value="<?php echo $userData['Telephone']; ?>" required>
    </div>

    <!-- Ajoutez d'autres champs du formulaire selon vos besoins -->

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
?>
