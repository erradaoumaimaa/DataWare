<?php require'../includes/connexion.php' ?>
<?php


// Vérifiez si l'ID de l'utilisateur est présent dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Échappez les données pour éviter les injections SQL
    $userId = mysqli_real_escape_string($db, $_GET['id']);

    // Écrivez votre requête de suppression
    $sql = "DELETE FROM Users WHERE ID_Users = $userId";

    // Exécutez la requête
    $result = mysqli_query($db, $sql);

    // Vérifiez si la suppression a réussi
    if ($result) {
        // Redirigez vers la page principale après la suppression
        header('Location: ../admin/index.php');
        exit();
    } else {
        // Gérez les erreurs de suppression ici
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($db);
    }
}
?>
