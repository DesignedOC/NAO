<?php
require_once('../model/Billet.php'); 
require_once('../model/Commentaire.php'); 
require_once('../model/BilletManager.php'); 
require_once('../model/UserManager.php'); 
class ControllerUser
{
	    public static function ajouterutilisateur($donnees,$conn ) 
        {
	        $co = new UserManager($conn);
	        $co->add(new User($donnees));
	       header('location:../index.php');
	    }


	    public static function supprimer($id,$conn) 
        {
	    	$connect = new UserManager($conn);
			$dat = array();
	    	$dat['id'] = $id;
			$connect->delete(new User($dat));
	    	 header('location:../index.php');

             //création d'un objet sur UserManager puis création d'un objet sur User, afin de pouvoir supprimer un User 
	    }
        public static function seconnecter($log,$mdp,$conn ) 
        {
            if(!isset($_SESSION['idutilisateur']))
            {
            $connect = new UserManager($conn);
            $data = $connect->findByLog($log,$mdp);
            if(isset($data)){ $vi = $data->fetch(PDO::FETCH_ASSOC);
                $_SESSION['idutilisateur'] = $vi['id'];
                $_SESSION['nomutilisateur'] = $vi['log'];
                $_SESSION['isadmin'] = $vi['isadmin'];
                header('location:../index.php');
            }
            else { $liencss = "../";$lien = "../";require ('../view/Log.php'); }
                }// else ControllerBillet::home($conn);
        }

	    public static function sinscrire($log,$mdp,$conn ) 
        {
            if(!isset($_SESSION['idutilisateur']))
            {
        	   $connect = new UserManager($conn);
			   $donnees['log'] = $log;
			   $donnees['mdp'] = $mdp;
			   $donnees['isadmin'] = 0;
        	   $info = new User($donnees);
        	   $data = $connect->add($info);
        	   $lien = "../";$liencss = "../";
        	   $data = $connect->findByLog($log,$mdp);
        	   $vi = $data->fetch(PDO::FETCH_ASSOC);
               $_SESSION['idutilisateur'] = $vi['id'];
        	   $_SESSION['nomutilisateur'] = $vi['log'];
        	   $_SESSION['isadmin'] = $vi['isadmin'];
        	   header('location:../index.php');       	
            }
            else header('location:../index.php');
	    }
         

        public static function deconnexion($conn) 
        {
	    	session_destroy();
	    	session_start();
	    	header('location:../index.php');
	    }

//message Log.php
	    public static function compte($conn) 
        {
	      	if(isset($_SESSION['idutilisateur'])) 
            {
	      		 $lien = "";$liencss = "../";require ('../view/Compte.php'); 
            }
	      	else 
            {
	      	  $message = 'DÉMARRER UNE SESSION </br> Vous n\'avez pas encore de compte ? </br> <b>Inscrivez-vous maintenant.</b>';
              $lien = "../";$liencss = "../"; 
	      	  require ('../view/Log.php');
            }
	    }



	    public static function modifier($log,$mdp,$mdp2,$conn) 
        {
            if(isset($_SESSION['idutilisateur']))
            {
        	   $connect = new UserManager($conn);
			   $donnees['log'] = $log;
			   $donnees['mdp'] = $mdp;
			   $donnees['isadmin'] = 0;
			   $donnees['id'] = $_SESSION['idutilisateur'];
        	   $info = new User($donnees);
        	   if($donnees['mdp'] == $mdp2)$data = $connect->update($info);
        	   header('location:../index.php');
            } 
            else header('location:../index.php');
	    }


        public static function seconnecteradmin($log,$mdp,$conn) 
        {
            if(!isset($_SESSION['idutilisateur']))
            {
        	    $connect = new UserManager($conn);
        	    $data = $connect->findByLog($log,$mdp);
        	    if(isset($data))
                { 
                    $vi = $data->fetch(PDO::FETCH_ASSOC);
                    if($vi['isadmin'])
                    {
                        $_SESSION['idutilisateur'] = $vi['id'];
        	           	$_SESSION['nomutilisateur'] = $vi['log'];
        		        $_SESSION['isadmin'] = $vi['isadmin'];
        		        header('location:../index.php');
                    }
                }
            }
        } 
}
    
    
?>