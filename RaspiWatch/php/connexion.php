<?php

//permet de faire la connecion a la Bd
class connexion {
    
    private $bdd = null;
    
    public function __construct() {
		try{
			$this->bdd = new PDO('mysql:host=localhost;dbname=motion', 'root','raspberry');      
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
	}
    
    public function getConnexion(){
        return  $this->bdd;
    }
}
?>