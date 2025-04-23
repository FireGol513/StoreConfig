<?php
/**
 * Chiffrement et déchiffrement d'information.
 * 
 * 
 */
class Encryption {

    /**
     * Production de l'information à partir de la donnée chiffrée fournie.
     * 
     * @param string $informationChiffrer Information chiffrée à déchiffrer.
     * 
     * @return $texteDecode Information en texte clair.
     */
	public function dechiffrer($informationChiffrer){
		//L'inclusion est placée à l'extérieur de la zone public du serveur web (au-dessus de www ou public_html)
        require_once __DIR__."/../../../../.cle/.".base64_encode("storeconfig").'.php';
    
        $chiffrement = CHIFFREMENT;
        $clef = CLEF;
        $option = OPENSSL_RAW_DATA; //Fonctionnel avec decrypt.
        $ivLongueur = IVLENGTH;
    
        //Récupération de l'information chiffrée. Ce peut aussi être une lecture sur la base de données
        $toutLeContenu = base64_decode($informationChiffrer);
        
        //Extraction de chacune des parties de la chaine de caractères
        $vecteurInitialisation = substr($toutLeContenu, 16, $ivLongueur);
        $tag = substr($toutLeContenu, $ivLongueur + 16 ,16);
        $texteSecret = substr($toutLeContenu, $ivLongueur+52);
    
        //Passer les paramètres extraits ci-dessus dans le déchiffrement
        $texteDecode = openssl_decrypt($texteSecret, $chiffrement, $clef, $option, $vecteurInitialisation, $tag);
    
        return $texteDecode;
	}


    /**
     * Production d'une donnée chiffrée à partir de l'information fournie en texte claire.
     * 
     * @param string $texteAChiffre Information en texte clair à chiffrer.
     * 
     * @return $texteChiffre Donnée chiffrée.
     */
    public function chiffrer($texteAChiffrer){
        require_once __DIR__."/../../../../.cle/.".base64_encode("storeconfig").'.php';

        $chiffrement = CHIFFREMENT;
        $clef = CLEF;
        $ivLongueur = IVLENGTH;
        $vecteurInitialisation = openssl_random_pseudo_bytes($ivLongueur);
        $option = 1; //OPENSSL_RAW_DATA -> expects parameter 1 to be int, string given;

        $chaineChiffre = openssl_encrypt($texteAChiffrer, $chiffrement, $clef, $option, $vecteurInitialisation,$tag);
        
        $texteChiffre = base64_encode(REMBOURRAGE1.$vecteurInitialisation.$tag.REMBOURRAGE2.$chaineChiffre);
        //Écrire dans un fichier texte plutôt que dans une base de données
        return $texteChiffre;
    }
	

}
