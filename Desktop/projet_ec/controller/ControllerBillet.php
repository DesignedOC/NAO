
<?php
session_start();
require_once('../model/Billet.php'); // chargement du modèle
require_once('../model/User.php'); // chargement du modèle
require_once('../model/Commentaire.php'); // chargement du modèle
require_once('../model/BilletManager.php'); // chargement du modèle
require_once('../model/CommentaireManager.php'); // chargement du modèle
require_once('../model/UserManager.php'); // chargement du modèle
class ControllerBillet {
    public static function connect()
    {
        return new PDO('mysql:host=localhost;dbname=billet', 'root', '');
    } 

    //home va creer un billetManager sert a creer les billets. on lui passe la connexion $conn qui est définie l.5 dans le routeur et qui contient la co à la bdd.
    public static function home($conn) {
       
         $var = new BilletManager($conn);
       
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $tab =  $var->getBillets($page);  
        $lien = "../";$liencss = "../";
        $tab_v =  $tab['resultat'];
        $nombreDePages = ceil( $tab['nbtotal'] /   2);
        $baspage = "";
       if ($page > 1):
           $baspage = $baspage.'<a href="?page='.($page-1).'">Page précédente</a>—';
       endif;
       for ($i = 1; $i <= $nombreDePages; $i++):
         $baspage = $baspage.'<a href="?page='.$i.'">'.$i.'</a> —';
       endfor;
       if ($page < $nombreDePages):
           $baspage = $baspage.'<a href="?page='.($page+1).'">Page suivante</a>—';
       endif;
        require ('../view/Home.php');  //"redirige" vers la vue
    }
     public static function chargerliste($conn) {
         $var = new BilletManager($conn);
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $tab =  $var->getBillets($page);  
        $tab_v =  $tab['resultat'];
        $nombreDePages = ceil( $tab['nbtotal'] /   2);
       $baspage = "";
       if ($page > 1):
           $baspage = $baspage.'<a href="?page='.($page-1).'">Page précédente</a>—';
       endif;
       for ($i = 1; $i <= $nombreDePages; $i++):
         $baspage = $baspage.'<a href="?page='.$i.'">'.$i.'</a> —';
       endfor;
       if ($page < $nombreDePages):
           $baspage = $baspage.'<a href="?page='.($page+1).'">Page suivante</a>—';
       endif;
        $lien = "../";$liencss = "../";
    }
         public static function homemsg($conn,$msg) {
         $var = new BilletManager($conn);
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $tab =  $var->getBillets($page);  
        $tab_v =  $tab['resultat'];
        $nombreDePages = ceil( $tab['nbtotal'] /   2);
       $baspage = "";
       if ($page > 1):
           $baspage = $baspage.'<a href="?page='.($page-1).'">Page précédente</a>—';
       endif;
       for ($i = 1; $i <= $nombreDePages; $i++):
         $baspage = $baspage.'<a href="?page='.$i.'">'.$i.'</a> —';
       endfor;
       if ($page < $nombreDePages):
           $baspage = $baspage.'<a href="?page='.($page+1).'">Page suivante</a>—';
       endif;
        $lien = "../";$liencss = "../";
         $comms = $msg;
        require ('../view/Home.php');  //"redirige" vers la vue
    }
    public static function liste($conn) {
        $var = new BilletManager($conn);
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $tab =  $var->getBillets($page);  
        $tab_v =  $tab['resultat'];
        $nombreDePages = ceil( $tab['nbtotal'] /   2);
       $baspage = "";
       if ($page > 1):
           $baspage = $baspage.'<a href="?page='.($page-1).'">Page précédente</a>—';
       endif;
       for ($i = 1; $i <= $nombreDePages; $i++):
         $baspage = $baspage.'<a href="?page='.$i.'">'.$i.'</a> —';
       endfor;
       if ($page < $nombreDePages):
           $baspage = $baspage.'<a href="?page='.($page+1).'">Page suivante</a>—';
       endif;
        $lien = "../";$liencss = "../";
        require ('../view/Home.php');  //"redirige" vers la vue
    }
     public static function redirect($conn) {
         header('location:../index.php');
 }


// EDITER UN COMMEENTAIRE 

 public static function edit($id,$conn) {
         $var = new BilletManager($conn);
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $tab =  $var->getBillets($page);  
        $tab_v =  $tab['resultat'];
        $nombreDePages = ceil( $tab['nbtotal'] /   2);
       $baspage = "";
       if ($page > 1):
           $baspage = $baspage.'<a href="?page='.($page-1).'">Page précédente</a>—';
       endif;
       for ($i = 1; $i <= $nombreDePages; $i++):
         $baspage = $baspage.'<a href="?page='.$i.'">'.$i.'</a> —';
       endfor;
       if ($page < $nombreDePages):
           $baspage = $baspage.'<a href="?page='.($page+1).'">Page suivante</a>—';
       endif;
        $lien = "../";$liencss = "../";
        require ('../view/Comment.php');  //"redirige" vers la vue
    }
                   

    public static function rediger($conn ) {
        $lien = "../";$liencss = "../";

        if(!isset($_SESSION['idutilisateur'])) {

            require ('../view/Log.php'); 
        }
        else {
            if( $_SESSION['isadmin'] )  {
 require ('../view/Redaction.php');
            } 
          else {require ('../view/Home.php');
          affiche(); }
        }
    }


    public static function ajouter($donnees,$conn ) {
                 $lien = "../";$liencss = "../";
            if(!empty($_POST)){  
                      if(!isset($_SESSION['idutilisateur']))  require ('../view/Log.php'); 
                        else{
                            if( $_SESSION['isadmin'] )  {
                                $co = new BilletManager($conn);
                                $co->add(new Billet($donnees));
                                header('location:../index.php');
                            }
                            /* else require ('../view/Home.php');
          affiche(); */
                        }  
            }
    }



// EDITER UN ARTCILE

    public static function editer($id,$conn ) {
        $lien = "../";$liencss = "../";
        if(!isset($_SESSION['idutilisateur'])) require ('../view/Log.php'); 
        else{
            if( $_SESSION['isadmin'] )  {
            	$con = new BilletManager($conn);
            	$dat = array();
            	$dat['id'] = (int)$id;
            	$un = new Billet($dat);
        		$unbillet = $con->find($un);
        		$lien="../";$liencss = "../";
            	require ('../view/Modif.php'); 
            }
        }
    }


     public static function modifier($lebillet,$conn ) {
       $lien = "../";$liencss = "../"; if(!isset($_SESSION['idutilisateur'])){
             $lien = "../";$liencss = "../";
            require ('../view/Log.php'); 
        }
        else{
            if( $_SESSION['isadmin'] )  {
             	$c = new BilletManager($conn);
             	$billetamodifier = new Billet($lebillet);
               $c->validermodification($billetamodifier);
               header('location:../index.php');
            }
             else require ('../view/Home.php');
          affiche();
        }
    }


    public static function supprimer($id,$conn) {
        $lien = "../";$liencss = "../"; if(!isset($_SESSION['idutilisateur'])) require ('../view/Log.php'); 
        else{
            if( $_SESSION['isadmin']) 
             {
            	$connect = new BilletManager($conn);
        		$dat = array();
            	$dat['id'] = $id;
        		$connect->delete(new Billet($dat));
                header('location:../index.php');
            }
             else require ('../view/Home.php');
          affiche();
        }  
    }

    public static function signaler($id,$conn) {
        $c = new CommentaireManager($conn);
        $uncomm = $c->find($id);
        while ($datacom = $uncomm->fetch(PDO::FETCH_ASSOC)) {
            $coms = new Commentaire($datacom); 
            $c->signaler($coms);
        }
        $billetmanag = new BilletManager($conn);
          header('location:../index.php');
    }
}
?>