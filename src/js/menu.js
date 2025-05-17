function creationMenuFlottant(titre, dst){
    // Création du menu devant le body
    let menu = document.createElement('article');

    // Création d'un bouton pour quitter le menu
    let boutonQuitter = document.createElement("button");
    boutonQuitter.setAttribute("id","buttonQuitterMenu");
    boutonQuitter.setAttribute("onclick","desactiverMenu('menuCreation')");
    boutonQuitter.textContent = "X";

    // Règle CSS pour menu
    menu.setAttribute("id", "menuCreation");

    // Création d'un header qui contient Titre + Bouton quitter
    let menuHeader = document.createElement("header");

    // Contenu du menu
    menuHeader.innerHTML = "<h2 class='questionMenuCreation titreMenu'><b>" + titre + "<b></h2>";

    // Afficher le menu
    document.body.appendChild(menu);
    menu.appendChild(menuHeader);
    menuHeader.appendChild(boutonQuitter);

    // Désactiver le comportement en arrière du menu
    document.body.setAttribute("id", "horsMenuCreation")

    // Créer le form du menu
    let form = document.createElement("form");
    form.setAttribute("action", dst);
    form.setAttribute("name", "formMenu");
    form.setAttribute("method", "post");
    menu.appendChild(form)

    let fieldSet = document.createElement("fieldset");
    fieldSet.setAttribute("id","fieldSet")
    form.appendChild(fieldSet)

    return {menu, form, fieldSet};
}

function desactiverMenu(idMenu) {
    
    
    // Récupérer le menuCréation avec son ID
    let menu = document.getElementById(idMenu);

    // Désactiver le menuCréation
    menu.remove();

    // Réactiver le comportement en arrière du menu
    document.body.removeAttribute("id");

}

 
