function VerificationSupression(reseau) {
    if (confirm("Voulez-vous vraiment supprimer ce réseau?") == true){
        reseau.remove();
        
        // Il va falloir que j'appelle la base de données pour désactiver le réseau
    }
    
}