<?php
require_once('../model/Billet.php'); // chargement du modèle
require_once('../model/Commentaire.php'); // chargement du modèle
require_once('../model/BilletManager.php'); // chargement du modèle
require_once('../model/CommentaireManager.php'); // chargement du modèle
class ControllerComment{
	    public static function ajoutercommentaire($donnees,$conn ) {
	        $co = new CommentaireManager($conn);
	        if(isset($_SESSION['idutilisateur'])){
	        	$donnees['iduser'] = $_SESSION['idutilisateur'];
	        	$co->add(new Commentaire($donnees));
	        	 $lien = "../";$liencss = "../";
	        	 header('location:../index.php');
	        }
	        else ControllerBillet::homemsg($conn,"Vous devez vous connecter pour commenter sous un article.");
	    }
	    public static function supprimer($id,$conn) {
	    	$connect = new CommentaireManager($conn);
			$dat = array();
	    	$dat['id'] = $id;
			$connect->delete(new Commentaire($dat));
			 $lien = "../";$liencss = "../";
	    	header('location:../index.php');
	    }
	     public static function edit($id,$conn) {
	    	$connect = new CommentaireManager($conn);
                $lien = "../";$liencss = "../";
		ControllerBillet::edit($id,$conn);
	    }
	    public static function validermodification($id,$contenu,$conn) {
	    	$connect = new CommentaireManager($conn);
		$dat = array();
	    	$com['id'] = $id;
	    	$com['contenu'] = $contenu;
		$connect->update(new Commentaire($com));
		$lien = "../";$liencss = "../";
	    	header('location:../index.php');
	    }
	    
    }
?>