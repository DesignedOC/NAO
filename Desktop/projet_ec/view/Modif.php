<html>
<head>
   <meta charset="utf8">
	<title>Billet simple pour l'Alaska</title>
  <!--intégration tinymce pour zone de texte-->
	 <script type="text/javascript" src="../view/tinymce/tinymce.min.js"></script>
	    <script type="text/javascript">
	        tinyMCE.init({
	            mode : "textareas"
	        });
	    </script>


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
<?php
$bill = $unbillet->fetch(PDO::FETCH_ASSOC);
		 $bii = new Billet($bill);?>



<form method="post" action="?actionajouter=modifier">
	<input type="hidden" name="id"  value="<?php  echo $bii->getId(); ?>" />
	<p style="font-size: 17px; color:black;" > 
		 Titre de l'article : <input type="text" name="titre"  value="<?php echo $bii->getTitre(); ?>"  />
	</p>  
	<pre data-codetype=" " style="width:95%; display:inline-block;border-color:#008080; border-style:dotted;  background-color:#008080;">
		<textarea name="contenu" cols="50" rows="15"><?php echo $bii->getContenu(); ?></textarea> <p align="right"><input type="submit" value="Enregistrer" /></p>
	</pre>

</form>

</div></div>
</body>
</html>