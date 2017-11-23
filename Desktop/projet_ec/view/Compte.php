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

</br>
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

</br></center>
<!--forms-->
 		   <pre data-codetype="MODIFIER MON MOT DE PASSE" style="width:95%; display:inline-block;border-color:#008080; border-style:dotted;  background-color:#008080;">
 		   	<form action="routeur.php?actionmodifier=modifier" method="POST" >
            <input class="" type="text" name="log" value="<?php echo $_SESSION['nomutilisateur']; ?>" autofocus required /> <br/>
            <input  class="" type="password" name="mdp" placeholder="Nouveau mot de passe" required /> <br/>
            <input  class="" type="password" name="mdpconfirm" placeholder="Confirmer mot de passe" required /> <br/>
            <input id="" type="submit" name="valid" value="Valider" /> <br/>
			</form>
			</pre>
		
</div></div>
</body>
</html>