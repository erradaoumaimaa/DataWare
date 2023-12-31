<?php  require 'C:\xampp\htdocs\DataWare\includes\connexion.php';
    include './actions/Join_Arrays.php';
?>
<?php include './actions/delete_user.php'; ?>

<!-- bibliotheque Bootstrap(JQUERY JS) FontAwsome(Icon) -->
<?php include './includes/biblio_bootstrap.php'; ?>

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
        color: #333333; 
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
<?php include './includes/navbar_admin.php'; ?>
<body>
<div class="container mt-5">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-12 text-center"> <!-- Utilisation de text-center pour centrer le titre -->
                <h2 class="text-info"><b > Liste Agents:</b></h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 mx-auto"></div> 
            <div class="col-sm-6 text-right"> 
                <button type="button" class="btn btn-primary ajout-agent-btn" data-toggle="modal" data-target="#ajoutMembreModal">
                    <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i> Ajouter Agent
                </button>
            </div>
        </div>
    </div>
        <?php include './actions/create_user.php'; ?>
        <!-- Tableau pour afficher la liste des utilisateurs -->
        <table class="table table-dark table-striped custom-table" >
            <thead>
            <tr>
                <th style="width: 10%; padding-right: 10px;">Matricule</th>
                <th style="width: 15%; padding-right: 10px;">Nom</th>
                <th style="width: 20%; padding-right: 10px;">Email</th>
                <th style="width: 10%; padding-right: 10px;">Poste</th>
                <th style="width: 10%; padding-right: 10px;">Statut</th>
                <th style="width: 10%; padding-right: 10px;">Naissance</th>
                <th style="width: 10%; padding-right: 10px;">Equipe</th>
                <th style="width: 10%; padding-right: 10px;">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['Matricule']}</td>";
                    echo "<td>{$row['NomPrenom']}</td>";
                    echo "<td>{$row['Email']}</td>";
                    echo "<td>{$row['Role']}</td>";
                    echo "<td>{$row['Statut']}</td>";
                    echo "<td>{$row['Date_naissance']}</td>";
                    echo "<td>{$row['NomEquipe']}</td>";
                    echo "<td>
                              <a href='./actions/delete_user.php?id={$row['ID_Users']}' class='action-column delete' data-toggle='tooltip' title='Delete' onclick='confirmDelete(\"{$row['NomPrenom']}\", {$row['ID_Users']}, event);'>
                                  <i class='material-icons text-danger'>&#xE872;</i>
                              </a>
                    </td>";
                }
                ?>
            </tbody>
        </table>
    </div>
   

</body>
</html>