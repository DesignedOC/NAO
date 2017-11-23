<html>
<head>
<meta charset="utf8">
	<title>Billet simple pour l'Alaska</title>
<link href="<?php echo $liencss; ?>view/css/style.css" rel='stylesheet' type='text/css'/>
</head> 
<body>
    
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cedarville+Cursive" />
<div class="container-fluid">



  <section class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <header id="banner">
          <div class="firstl" > </br>  Billet simple pour l'Alaska</div> </br> </br>
          <div class="secl">un roman de </div></br>
          <div class="thirdl">Jean Forteroche</div></br> </br>
      </header>
    </div>
  </section>



</br>
<!--boutons-->

<center>
  <hr/>
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

<hr/>
</center>

<!--billet-->
<?php while ($v = $tab_v->fetch(PDO::FETCH_ASSOC)) 
          {
            $b = new Billet($v); ?>


<!--titre-->
<div class="post_message_tc"> 
	 <center>
    <h2 style="font-family:Courier New; color:black; font-weight: bold; "> 
    <?php echo $b->getTitre(); ?>

    
     </h2> 
   </center> 


<!--contenu-->
<?php echo $b->getContenu(); ?>
<!-- Date + Liens 'Modifier' + 'Supprimer'-->
<p style="font-size: 11px; color :black; text-align:right"> Publié 
    <?php echo $b->getDateAjout();

?></br><?php
    if(isset($_SESSION['idutilisateur']))
      { 
        if($_SESSION['isadmin'])
          { ?> 
            <a href="?actionediter=editer&id=<?php echo $v['id'];?>   ">Modifier l'article</a>   | 
            <a href="?actionediter=supprimer&id=<?php echo $v['id'];?>">Supprimer l'article</a><?php }} ?>
</p>

<!--Commentaires-->
	 <pre data-codetype="Commentaires" style="display:block; border-color:white; background-color:white;">


<form method="POST" action="?actionajoutercommentaire=ajoutercommentaire"><input type="text" name="contenu"/> <input type="hidden" name="idbillet" value=" <?php echo $b->getId(); ?>"/><input type="submit" value="Envoyer le commentaire" style="background-color:#87CEEB;"/></form><?php if(isset($comms)) echo '<label style="color:red">'.$comms.'</label>';?>
<?php 
$varcomm = new CommentaireManager($conn);
$tab_comm =  $varcomm->getListByBillet($b->getId());
if(isset( $tab_comm))
  {
    while ($vi = $tab_comm->fetch(PDO::FETCH_ASSOC)) 
      {
        $vii = new Commentaire($vi);
        $varuser = new UserManager($conn) ;
        $tab_user =  $varuser->find($vii->getIduser());
        if(isset( $tab_user))
          {
            while ($vuser = $tab_user->fetch(PDO::FETCH_ASSOC)) 
              { 	
                $infouser = new User($vuser);
                //Message + boutons Signaler / Modifier / Supprimer
                echo ucfirst ($infouser->getLog()).'  <p class=\'com_date\'>' . $vii->getDateAjout().' </p> | ' .$vii->getContenu(); ?>  <a href="?actionediter=signaler&id=<?php echo $vi['id'];?> ">Signaler</a></br></br><?php if(isset($_SESSION['idutilisateur'])){ if($_SESSION['isadmin']){ echo '('.$vii->getReport().') </br></br>';}if($vii->getIduser() == $_SESSION['idutilisateur']){ ?> <a href="?actioneditercommentaire=edit&id=<?php echo $vi['id'];?>">Modifier</a>  <a href="?actioneditercommentaire=supprimer&id=<?php echo $vi['id'];?>">Supprimer</a></br></br>
<?php } else echo "<br>"; }else echo "<br>";}}  }} ?> 
</pre>
</div>
<hr/>


<?php } 
?>
<!-- Pagination -->
<p style="text-align:center; font-size: 20px; color :black;">
<?php  require_once '../controller/ControllerBillet.php';
echo $baspage ;?></p> </br></br>
    <div class="baspage"> © 2017 Jean Forteroche | Réalisation par Juliette LO FARO</br></div>

</div>
</div>
</body>
</html>