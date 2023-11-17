<?php require'./includes/connexion.php' ?>
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
<!--  bibliotheque Bootstrap(JQUERY JS) FontAwsome(Icon)  -->
<?php include './includes/biblio_bootstrap.php' ?>
<!-- Inclut la partie head du html  -->
<?php include './includes/head.php' ?>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
<style>
.avatar {
    border-radius: 50%;
  vertical-align: middle;
  margin-right: 10px;
  width: 50px;
  height: 50px;
  object-fit: cover;/* Assurez-vous que l'image remplit le cercle sans déformation */
  }
  .custom-table {
    margin-top:50px;
    width: 110%; /* Vous pouvez ajuster la largeur en pourcentage ou en pixels selon vos besoins */
    table-layout: fixed; /* Fixez la largeur de la table pour qu'elle respecte la largeur définie */
}
.action-column {
    margin-left:0.5rem;
}
</style>
</style>
</head>
<!--  NavBar  -->
<?php include './includes/navbar_admin.php'?>
<body>
<div class="container mt-5">
    <div class="table-title">
        <div class="row">
             <div class="col-sm-6" style="margin-left: 29rem;">
                <h2 class="text-info ">Liste <b class="text-info">Agents:</b></h2>
            </div>
        </div>
    </div>

    <!-- Tableau pour afficher la liste des utilisateurs -->
    <table class="table table-dark table-striped custom-table" style="margin-left: -3.3rem;">
        <thead>
            <tr>
            <th style="width: 2.5%;">ID</th>
            <th style="width: 8%;">Matricule</th>
            <th style="width: 8%;">Nom Prenom</th>
            <th style="width: 14%;">Email</th>
            <th style="width: 10%;">Telephone</th>
            <th style="width: 7%;">Poste</th>
            <th style="width: 7%;">Statut</th>
            <th style="width: 8%;">Date naissance</th>
            <th style="width: 8%;">Adresse</th>
            <th style="width: 8%;">Nom équipe</th>
            <th style="width: 8%;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Boucle pour afficher les résultats
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['ID_Users']}</td>";
            echo "<td>{$row['Matricule']}</td>";
            echo "<td>{$row['NomPrenom']}</td>";
            echo "<td>{$row['Email']}</td>";
            echo "<td>{$row['Telephone']}</td>";
            echo "<td>{$row['Role']}</td>";
            echo "<td>{$row['Statut']}</td>";
            echo "<td>{$row['Date_naissance']}</td>";
            echo "<td>{$row['Adresse']}</td>";
            echo "<td>{$row['NomEquipe']}</td>";
            echo "<td>
                    <a href='#' class='action-column 'class='edit' data-toggle='modal'><i class='material-icons text-warning' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                    <a href='#' class='action-column 'class='delete' data-toggle='modal'><i class='material-icons text-danger' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
                </td>";
            echo "</tr>";
        }
        ?>
            <!-- Les données de la base de données seront affichées ici -->
        </tbody>
    </table>
</div>

</body>
</html>
