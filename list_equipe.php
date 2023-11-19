<?php require './includes/connexion.php'; 
?>
<!-- bibliotheque Bootstrap(JQUERY JS) FontAwsome(Icon) -->
<?php include './includes/biblio_bootstrap.php'; ?>
<?php
    $sql = "SELECT 
    equipes.ID_Eq,
    equipes.Name_Eq,
    equipes.Date_Eq,
    equipes.Desc_Eq
FROM equipes
";
// Exécution de la requête
$result = mysqli_query($db, $sql);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($db));
}
?>
<!-- Inclut la partie head du html  -->
<?php include './includes/head.php'; ?>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .custom-navbar-color {
    background-color: #fff; /* Utilisez le code hexadécimal de la couleur de votre choix */
}
    .custom-table {
        margin-top: 50px;
        margin-left:20px;
        width: 100%;
        table-layout: fixed;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-collapse: collapse;
        overflow: hidden;
        color: #333333; /* Couleur du texte */
    }

    .custom-table th,
    .custom-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    .custom-table th {
        background-color: #083C5A;
        color:#fff;
        font-weight: bold;
        text-transform: uppercase;
    }

    .custom-table tr:hover {
        background-color: #f5f5f5;
    }

    .action-column {
        margin-left: 1rem;
    }

    .ajout-agent-btn {
        margin-left: 0;
        background-color: #28a745;
        color: #ffffff;
        border: 1px solid #218838;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
    }

    .ajout-agent-btn:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    .custom-select-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .custom-select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #fff;
    }
    .text-info {
    color: #FCC72C !important;
}
</style>
</head>
<!--  NavBar  -->
<?php include './includes/navbar_admin.php'?>
<body>
<div class="container mt-5">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-12 text-center"> <!-- Utilisation de text-center pour centrer le titre -->
                <h2 class="text-info"><b > Liste Equipes:</b></h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 mx-auto"></div> 
            <div class="col-sm-6 text-right"> 
                <button type="button" class="btn btn-primary ajout-agent-btn" data-toggle="modal" data-target="#ajoutMembreModal">
                    <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i> Ajouter Equipe
                </button>
            </div>
        </div>
    </div>
    <!-- Tableau pour afficher la liste des utilisateurs -->
    <table class="table table-dark table-striped custom-table" style="margin-left: -3.3rem;">
       
    <div class="table-responsive">
    <table class="table table-dark table-striped custom-table">
        <thead>
            <tr>
            <th style="width: 5%;" class="text-nowrap">ID</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Descrp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Boucle pour afficher les résultats
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['ID_Eq']}</td>";
            echo "<td>{$row['Name_Eq']}</td>";
            echo "<td>{$row['Date_Eq']}</td>";
            echo "<td>{$row['Desc_Eq']}</td>";
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
