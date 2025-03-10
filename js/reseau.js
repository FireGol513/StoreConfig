class Machine {
    
    id; // Id de la machine dans la base de données
    nom; 
    modele; // Mikrotik, Proxmox PVE, Proxmox CT, Proxmox VM, Others
    config; // Configuration complète de la machine
    
    constructor(parameters) {
        
    }
}


function afficherMenuCreationMachine() {
    
    // Il va falloir récupérer le prochain ID
    // ex: id = getLastID_DB() + 1;

    // Création du menu devant toutes les machines
    let menu = document.createElement('article');

    // Création d'un bouton pour quitter le menu
    let boutonQuitter = document.createElement("button");
    boutonQuitter.setAttribute("id","buttonQuitterMenu");
    boutonQuitter.setAttribute("onclick","desactiverMenuCreationMachine('menuCreation')");
    boutonQuitter.textContent = "X";

    // Règle CSS pour menu
    menu.setAttribute("id", "menuCreation");

    // Création d'un header qui contient Titre + Bouton quitter
    let menuHeader = document.createElement("header");

    // Contenu du menu
    menuHeader.innerHTML = "<h2>Création d'une machine</h2>";

    // Afficher le menu
    document.body.appendChild(menu);
    menu.appendChild(menuHeader);
    menuHeader.appendChild(boutonQuitter);

    // Désactiver le comportement en arrière du menu
    document.body.setAttribute("id", "horsMenuCreation")

}

function desactiverMenuCreationMachine(idMenu) {
    
    
    // Récupérer le menuCréation avec son ID
    let menu = document.getElementById(idMenu);

    // Désactiver le menuCréation
    menu.remove();

    // Réactiver le comportement en arrière du menu
    document.body.removeAttribute("id");

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
