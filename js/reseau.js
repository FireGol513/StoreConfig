class Machine {
    
    id; // Id de la machine dans la base de données
    nom; 
    modele; // Mikrotik, Proxmox PVE, Proxmox CT, Proxmox VM, Others
    config; // Configuration complète de la machine
    
    constructor(parameters) {
        
    }
}

function AfficherCheckboxSupprimer(params) {
    
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