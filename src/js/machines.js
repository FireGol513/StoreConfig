function afficherMenuCreationMachine() {
    
    // Il va falloir récupérer le prochain ID
    // ex: id = getLastID_DB() + 1;

    // Création du form qui va contenir la question
    elementMenu = creationMenuFlottant("Création d'une machine", "/storeconfig/service/infrastructure/creationMachine.redirect.php");

    menuMachine = elementMenu["menu"];
    formMachine = elementMenu["form"];
    fieldSetMachine = elementMenu["fieldSet"];


    let urlSearch = new URLSearchParams(window.location.search);



    // Input caché pour le idReseau
    let inputCacheIdReseau = document.createElement("input");
    inputCacheIdReseau.setAttribute("name","idReseau")
    inputCacheIdReseau.setAttribute("id","idReseau");
    inputCacheIdReseau.setAttribute("value",urlSearch.get('modifier'));
    inputCacheIdReseau.setAttribute("type","hidden");
    fieldSetMachine.appendChild(inputCacheIdReseau);


    // Question du nom de la machine
    let labelNomMachine = document.createElement("label");
    labelNomMachine.setAttribute("for", "nomMachine");
    labelNomMachine.setAttribute("class", "questionMenuCreation")
    labelNomMachine.innerHTML = "<h3>Nom de la machine: </h3>";
    fieldSetMachine.appendChild(labelNomMachine);

    let inputNomMachine = document.createElement("input");
    inputNomMachine.setAttribute("name","nomMachine")
    inputNomMachine.setAttribute("id","nomMachine");
    inputNomMachine.setAttribute("minlength","3");
    inputNomMachine.setAttribute("maxlength","24");
    inputNomMachine.setAttribute("required","");
    labelNomMachine.appendChild(inputNomMachine);


    // Question du modèle de la machine
    let labelModeleMachine = document.createElement("label");
    labelModeleMachine.setAttribute("for", "modeleMachine");
    labelModeleMachine.setAttribute("class", "questionMenuCreation")
    labelModeleMachine.innerHTML = "<h3>Modèle de la machine: </h3>";
    fieldSetMachine.appendChild(labelModeleMachine);

    let selectModeleMachine = document.createElement("select");
    selectModeleMachine.setAttribute("id","modeleMachine");
    selectModeleMachine.setAttribute("name","modele");
    labelModeleMachine.appendChild(selectModeleMachine);
    

    recupererModeles().then(function(modeles){
        modeles.forEach(modele =>{
            var optionModele = document.createElement("option");
            optionModele.textContent = modele["NomModele"];
            optionModele.value = modele["Id"];
            selectModeleMachine.appendChild(optionModele);
    
        });
    })
    
    
    // Question optionnelles sur l'utilisation d'API pour le changement dynamique
    let labelAPIOptionnelMachine = document.createElement("label");
    labelAPIOptionnelMachine.setAttribute("for", "APIMachine");
    labelAPIOptionnelMachine.setAttribute("class", "questionMenuCreation")
    labelAPIOptionnelMachine.innerHTML = "<h3>Activer l'utilisation d'un API (Optionnel)</h3><h4>* L'utilisation d'un API permet le changement dynamique des configurations de la machine<h4>";
    fieldSetMachine.appendChild(labelAPIOptionnelMachine);

    let checkboxAPIOptionnel = document.createElement("input");
    checkboxAPIOptionnel.setAttribute("type","checkbox");
    checkboxAPIOptionnel.setAttribute("name","utiliseAPI");
    checkboxAPIOptionnel.setAttribute("id", "APIMachine");
    checkboxAPIOptionnel.setAttribute("onchange",`afficherQuestionsAPI(this, '${fieldSetMachine.id}' )`);


    //console.log(fieldSetMachine.id);
    labelAPIOptionnelMachine.appendChild(checkboxAPIOptionnel);

    
    // Bouton submit le formulaire de création de machine
    let boutonSubmitCreationMachine = document.createElement("input");
    boutonSubmitCreationMachine.setAttribute("type","submit");
    boutonSubmitCreationMachine.setAttribute("id", "btnSubmitMenuCreationMachine");
    fieldSetMachine.appendChild(boutonSubmitCreationMachine);


}

demande = {"demande" : "all"};
async function recupererModeles(){
    return await fetch("/storeconfig/service/getModeles.php", {
        method: "POST",
            headers: {
                "Accept" : "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(demande)
    }).then(response => response.json())
};





function afficherQuestionsAPI(checkbox, fieldSetMachineId){

    if (checkbox.checked){

        // Récupérer le fieldSetMachine
        let fieldSetMachine = document.getElementById(fieldSetMachineId);
        let btnSubmitMenuCreationMachine = document.getElementById("btnSubmitMenuCreationMachine");
        btnSubmitMenuCreationMachine.setAttribute("class","buttonCreationMachineAPI");


        // Créer un DIV différent pour les questions du API
        let divAPI = document.createElement("div");
        divAPI.setAttribute("id","divAPI");
        divAPI.setAttribute("class","questionAPI");
        fieldSetMachine.insertBefore(divAPI, btnSubmitMenuCreationMachine);

        // Lorsque on coche le checkbox API, on doit écrire l'adresse pour accéder à l'API
        let labelAPIAdresse = document.createElement("label");
        labelAPIAdresse.setAttribute("for", "APIAdresse");
        labelAPIAdresse.setAttribute("class", "questionMenuCreation ")
        labelAPIAdresse.innerHTML = "<h3>Adresse du serveur API (<b>IP ou URL</b>)</h3>";
        divAPI.appendChild(labelAPIAdresse);

        let textAPIAdresse = document.createElement("input");
        textAPIAdresse.setAttribute("name","adresseAPI");
        textAPIAdresse.setAttribute("required","");
        labelAPIAdresse.appendChild(textAPIAdresse);

        
        // Récupérer les identifiants pour avoir la permission d'accès à l'API
        let labelAPIIdentifiant = document.createElement("label");
        labelAPIIdentifiant.setAttribute("class", "questionMenuCreation")
        labelAPIIdentifiant.innerHTML = "<h3>Veuillez inscrire vos identifiants pour accédé à l'API</h3><h4>Par soucis de sécurité, veuillez créer un nouvel utilisateur dans votre service d'API pour l'utilisation de ce service</h4>";
        divAPI.appendChild(labelAPIIdentifiant);

        // Nom utilisateur
        let labelAPINomUtilisateur = document.createElement("label");
        labelAPINomUtilisateur.innerHTML = "<h4>Nom Utilisateur: </h4>";
        labelAPIIdentifiant.appendChild(labelAPINomUtilisateur);

        let textAPINomUtilisateur = document.createElement("input");
        textAPINomUtilisateur.setAttribute("name","nomUtilisateurAPI");
        textAPINomUtilisateur.setAttribute("required","");
        labelAPINomUtilisateur.appendChild(textAPINomUtilisateur);

        // Mot de passe
        let labelAPIMDP = document.createElement("label");
        labelAPIMDP.innerHTML = "<h4>Mot de passe: </h4>";
        labelAPIIdentifiant.appendChild(labelAPIMDP);

        let passwordAPIMDP = document.createElement("input");
        passwordAPIMDP.setAttribute("type","password");
        passwordAPIMDP.setAttribute("name","mdpAPI");
        passwordAPIMDP.setAttribute("required","");
        labelAPIMDP.appendChild(passwordAPIMDP);
        

    }
    else{
        
        // Enlever les questions au sujet de l'API si le checkbox n'est pas coché
        divAPI = document.getElementById("divAPI");
        divAPI.remove();
        btnSubmitMenuCreationMachine.removeAttribute("class");
    }
    

}




function afficherCheckboxSupprimer(boutonSupprimer) {
    
    // Changer le comportement du bouton supprimer qui vient d'être appuyer pour qu'il s'annule
    boutonSupprimer.setAttribute("onclick", "desactiverCheckboxSupprimer");


    // Création d'un bouton submit pour supprimer tous les machines sélectionnées
    let boutonSupprimerSelection = document.createElement("input");
    boutonSupprimerSelection.setAttribute("type","submit")
    boutonSupprimerSelection.setAttribute("value","SupprimerTousSelectionnee")

    // Mettre le nouveau bouton à coté du bouton créer et supprimer
    let conteneurBouton = document.querySelector(".conteneurBouton");
    conteneurBouton.appendChild(boutonSupprimerSelection);

    let machineList = document.querySelectorAll("article");
    machineList.forEach(machine =>{
        var checkbox = document.createElement("input")
        checkbox.setAttribute("type", "checkbox");
        machine.appendChild(checkbox);
    });
}

function desactiverCheckboxSupprimer(boutonSupprimer){
    
    // Aller voir subnav
    // https://www.w3schools.com/howto/howto_css_subnav.asp


}
