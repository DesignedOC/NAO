<?php
class Billet
{
	private $_id;
	private $_titre;
	private $_contenu;
	private $_dateajout;
	
	public function __construct($donnees){
		if(isset($donnees['id']))$this->_id = $donnees['id']; 
		if(isset($donnees['titre']))$this->_titre = $donnees['titre']; 
		if(isset($donnees['contenu']))$this->_contenu = $donnees['contenu']; 
		if(isset($donnees['dateajout']))$this->_dateajout = $donnees['dateajout']; 

	}
	
	public function setId($id)
	{
		$this->_id = $id;
	} 
	public function getId()
	{
		return $this->_id;
	} 
	public function setTitre($titre)
	{
		$this->_titre = $titre;
	} 
	public function getTitre()
	{
		return $this->_titre;
	} 
	public function setContenu($contenu)
	{
		$this->_contenu = $contenu;
	} 
	public function getContenu()
	{
		return $this->_contenu;
	} 
	public function setDateajout($dateajout)
	{
		$this->_dateajout = $dateajout;
	} 
	public function getDateajout()
	{
		return $this->_dateajout;
	} 
}
?>