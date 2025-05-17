function creerNouveauReseau(){
    
    // Création du form qui va contenir la question
    elementMenu = creationMenuFlottant("Création d'un réseau", "/storeconfig/service/infrastructure/creationReseau.redirect.php");

    menuReseau = elementMenu["menu"];
    formReseau = elementMenu["form"];
    fieldSetReseau = elementMenu["fieldSet"];

    // Question du nom du réseau
    let labelNomReseau = document.createElement("label");
    labelNomReseau.setAttribute("for", "nomReseau");
    labelNomReseau.setAttribute("class", "questionMenuCreation")
    labelNomReseau.innerHTML = "<h3>Nom du réseau: </h3>";
    fieldSetReseau.appendChild(labelNomReseau);
    
    let inputNomReseau = document.createElement("input");
    inputNomReseau.setAttribute("name","nomReseau")
    inputNomReseau.setAttribute("id","nomReseau");
    inputNomReseau.setAttribute("minlength","3");
    inputNomReseau.setAttribute("maxlength","24");
    inputNomReseau.setAttribute("required","");
    labelNomReseau.appendChild(inputNomReseau);
    
    // Bouton submit le formulaire de création de machine
    let boutonSubmit = document.createElement("input");
    boutonSubmit.setAttribute("type","submit");
    boutonSubmit.setAttribute("id", "btnSubmitCreationReseau");
    boutonSubmit.setAttribute("value", "Créer");
    fieldSetReseau.appendChild(boutonSubmit);

    // Aligner les questions 
    formReseau.setAttribute("style", "justify-content: center;")

    // Réduire la taille du menu
    menuReseau.setAttribute("style", "width: 25%; height: 30%; position: absolute; left: 36%; top: 20%;")
}

function verificationSupression(divReseau, idReseau) {
    if (confirm("Voulez-vous vraiment supprimer ce réseau?") == true){
        div_reseau.remove();
        
        // Il va falloir que j'appelle la base de données pour désactiver le réseau (requete async sur php)
        
    }
    
}