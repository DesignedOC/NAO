<html>
<head>
<meta charset="utf8">
	<title>Billet simple pour l'Alaska</title>
</head>
<link href="<?php echo $liencss; ?>view/css/style.css" rel='stylesheet' type='text/css'/>
<body>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cedarville+Cursive" />
  <div class="container-fluid">
  <section class="raw">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <header id="little_banner">
        Billet simple pour l'Alaska</br> un roman de </br> Jean Forteroche</br>
      </header>
    </div>
  </section>

<div class="main-outer">
<div class="content">

<!--boutons-->
<hr/>
</br>
<center>
  <a class="btn_tc accueil_tc " href="?action=redirect"">Accueil</a>
<?php 
if(isset($_SESSION['idutilisateur'])) 
  {
    if($_SESSION['isadmin'])
      { ?>
        <a class="btn_tc rediger_tc " href="?action=rediger">Nouveau chapitre</a><?php }} ?>
        <a class="btn_tc compte_tc " href="?actionuser=compte" >Mes informations</a><?php 
        if(isset($_SESSION['idutilisateur']))
          { ?>
            <a class="btn_tc deco_tc" href="?actionuser=deconnexion">Se d&eacute;connecter</a><?php } ?> 

</br></br></center>




<?php 
require_once '../controller/ControllerBillet.php';
while ($v = $tab_v->fetch(PDO::FETCH_ASSOC)) 
  {
      $b = new Billet($v); 
?>


<div class="post_message_tc announcement"> 
  
  <center>
    <h2 style="font-family:Courier New; color:black;font-weight: bold;  ">
       <?php 
       echo $b->getTitre();
         ?>
 </h2> 

   
  </center> 
<!--l'article-->
<?php 
  echo $b->getContenu(); 
?>
<!--form ajouter un com-->
<pre data-codetype="Commentaires" style="display:block;border-color:rgba(12, 12, 12, 0.13);background-color:rgba(12, 12, 12, 0.13);">

<form method="POST" action="?actionajoutercommentaire=ajoutercommentaire">
    <input type="text" name="contenu"/>
    <input type="hidden" name="idbillet" value=" <?php echo $b->getId(); ?>"/>
    <input type="submit" value="Ajouter un commentaire"/>
</form>

<!--modifier le com-->
<?php
   $varcomm = new CommentaireManager($conn);
   $tab_comm =  $varcomm->getListByBillet($b->getId());
   if(isset( $tab_comm))
    {
      //boucle pour afficher tous les commentaires
      while ($vi = $tab_comm->fetch(PDO::FETCH_ASSOC)) 
        {
          $vii = new Commentaire($vi); 
          $varuser = new UserManager($conn);
          $tab_user =  $varuser->find($vii->getIduser());
          if(isset( $tab_user))
            {
              while ($vuser = $tab_user->fetch(PDO::FETCH_ASSOC)) 
                { 	
                    $infouser = new User($vuser);
                    if(isset($_GET['id']))
                      {
                        if($_GET['id']==$vii->getId())
                          {
                            //input modifier
                           echo '<form action="?actioneditercomm=validermodification" method="POST"><input type="hidden" name="id" value="'.$vi['id'].'"/><input type="text" name="contenu" value="'.$vii->getContenu().'" /><input type="submit" value="Modifier" /> </form> ';
                          } 
                          else
                            { 
                              //message
                              echo ucfirst ($infouser->getLog()).' a commenté : '.$vii->getContenu().' ('.$vii->getDateAjout().')';?> <!--bouton signaler--><a href="?actionediter=signaler&id=<?php echo $vi['id'];?> ">Signaler</a>
<?php
//sauter une ligne pour chaque commentaire
 if(isset($_SESSION['idutilisateur'])) echo "<br>";}}  
}}}} 
?> 
</pre>
</div><hr/>
<!-- Pagination -->
<p style="text-align:center; font-size: 20px; color :black;">
<?php   }  echo $baspage ;?>
</p>
</div></div>
</body>
</html>