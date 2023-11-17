<?php require'../includes/connexion.php' ?>
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
<?php include '../actions/delete_user.php' ?>
<!--  bibliotheque Bootstrap(JQUERY JS) FontAwsome(Icon)  -->
<?php include '../includes/biblio_bootstrap.php' ?>
<!-- Inclut la partie head du html  -->
<?php include '../includes/head.php' ?>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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
    background-color: #f8f9fa;
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

  /* Ajout du style pour le titre "Liste des Agents"
  .table-title h2 {
    color: #343a40;
    text-decoration: none;
    border-bottom: 2px solid #28a745;
    display: inline-block;
    padding-bottom: 8px;
    margin-bottom: 20px;
  } */
</style>


</head>
<!--  NavBar  -->
<?php include '../includes/navbar_admin.php'?>
<body>
<div class="container mt-5">
    <div class="table-title">
        <div class="row">
             <div class="col-sm-6" style="margin-left: 29rem;">
                <h2 class="text-info ">Liste <b class="text-info">Agents:</b></h2>
            </div>
            <button type="button" class="btn btn-primary ajout-agent-btn" data-toggle="modal" data-target="#ajoutMembreModal">
            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>  Ajouter Agent
            </button>
        </div>
    </div>
    <?php include '../actions/create_user.php' ?>
    <!-- Tableau pour afficher la liste des utilisateurs -->
    <table class="table table-dark table-striped custom-table" style="margin-left: -3.3rem;">
        <thead>
            <tr>
            <th style="width: 2.5%;">ID</th>
            <th style="width: 10%;">Matricule</th>
            <th style="width: 12%;">Nom</th>
            <th style="width: 20%;">Email</th>
            <th style="width: 15%;">Telephone</th>
            <th style="width: 7%;">Poste</th>
            <th style="width: 7%;">Statut</th>
            <th style="width: 10%;">naissance</th>
            <th style="width: 8%;">Adresse</th>
            <th style="width: 10%;">Equipe</th>
            <th style="width: 10%;">Action</th>
            </tr>
        </thead>
       <!-- ... Votre code précédent ... -->

<tbody>
    <?php
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
                <a href='../actions/update_user.php?id={$row['ID_Users']}' class='action-column edit'><i class='material-icons text-warning' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                <a href='../actions/delete_user.php?id' class='action-column delete' data-toggle='tooltip' title='Delete' onclick='confirmDelete({$row['ID_Users']});'>
                    <i class='material-icons text-danger'>&#xE872;</i>
                </a>
            </td>";
        echo "</tr>";
    }
    ?>
</tbody>
<!-- ... Votre code précédent ... -->

            <!-- Les données de la base de données seront affichées ici -->
        </tbody>
    </table>
</div>
<script>
function confirmDelete(userId) {
    var confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");

    if (confirmDelete) {
        // Rediriger vers la page de suppression avec l'ID de l'utilisateur
        window.location.href = 'index.php?id=' + userId;
    }
}
document.getElementById('ajouterMembreBtn').addEventListener('click', function () {
                var modal = document.getElementById('ajoutMembreModal');
                modal.style.display = 'block';
            });


</script>
</body>
</html>
