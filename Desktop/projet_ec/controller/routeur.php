<?php
	if(isset($lien))require_once $lien.'ControllerBillet.php';
	else require_once 'ControllerBillet.php';
	//l.5 le routeur demande la connexion à la bdd au controller et la place dans la var $conn
	$conn = ControllerBillet::connect();

	if(isset($_GET['action']))
	{
		require_once 'ControllerBillet.php';
		$action = $_GET['action'];    // recupère l'action mdpée dans l'URL 
		ControllerBillet::$action($conn);
	}
	else if(isset($_GET['actionediter'])){
		require_once 'ControllerBillet.php';
		$action = $_GET['actionediter'];  
		ControllerBillet::$action($_GET['id'],$conn);
	}
	else if(isset($_GET['actionajouter'])){
			require_once 'ControllerBillet.php';
			$action = $_GET['actionajouter']; 
			$data = array();
			if(isset($_POST['id'])) $data['id'] = $_POST['id'];
			if(isset($_POST['titre']))	$data['titre'] = $_POST['titre'];
			if(isset($_POST['contenu'])) {	
			 $data['contenu'] = $_POST['contenu'];}
				ControllerBillet::$action($data,$conn);
	}



	
	else if(isset($_GET['actionajoutercommentaire'])){
		require_once 'ControllerComment.php';
		$action = $_GET['actionajoutercommentaire']; 
		$data = array();
		if(isset($_POST['id'])) $data['id'] = $_POST['id'];
			$data['idbillet'] = $_POST['idbillet'];
			$data['contenu'] = $_POST['contenu'];
			ControllerComment::$action($data,$conn);
	}
	else if(isset($_GET['actioneditercommentaire'])){
		require_once 'ControllerComment.php';
		$action = $_GET['actioneditercommentaire'];  
		ControllerComment::$action($_GET['id'],$conn);
	}
	else if(isset($_GET['actioneditercomm'])){
		require_once 'ControllerComment.php';
		$action = $_GET['actioneditercomm'];  
		ControllerComment::$action($_POST['id'],$_POST['contenu'],$conn);
	}






	else if(isset($_GET['actionseconnecter'])){
		require_once 'ControllerUser.php';
		$action = $_GET['actionseconnecter'];  
		ControllerUser::$action($_POST['log'],$_POST['mdp'],$conn);
	}
	else if(isset($_GET['actionmodifier'])){
		require_once 'ControllerUser.php';
		$action = $_GET['actionmodifier'];  
		ControllerUser::$action($_POST['log'],$_POST['mdp'],$_POST['mdpconfirm'],$conn);
	}
	else if(isset($_GET['actionuser'])){
		require_once 'ControllerUser.php';
		$action = $_GET['actionuser'];  
		ControllerUser::$action($conn);
	}	
	else {
		require_once 'ControllerBillet.php';
		$conn = ControllerBillet::connect();
		ControllerBillet::liste($conn);
	}
?>