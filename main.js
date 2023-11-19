function confirmDelete(userName, userId, event) {
   // Check if the click originated from the delete icon
   if (event.target.classList.contains('delete')) {
       var confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer l'utilisateur " + userName + " ?");

       if (confirmDelete) {
           // Rediriger vers la page de suppression avec l'ID de l'utilisateur
           window.location.href = '../actions/delete_user.php?id=' + userId;
       }
   }
}

       document.getElementById('ajouterMembreBtn').addEventListener('click', function () {
           var modal = document.getElementById('ajoutMembreModal');
           modal.style.display = 'block';
       });
