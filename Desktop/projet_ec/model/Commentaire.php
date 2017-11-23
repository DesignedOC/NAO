<?php
class Commentaire
{
	private $_id;
	private $_idbillet;
	private $_iduser;
	private $_contenu;
	private $_dateajout;
	private $_report;
	
	public function __construct($donnees) // Constructeur demandant 4 paramètres
	{
	 	if(isset($donnees['id']))$this->_id = $donnees['id']; 
		if(isset($donnees['idbillet']))$this->_idbillet = $donnees['idbillet']; 
		if(isset($donnees['contenu']))$this->_contenu = $donnees['contenu']; 
		if(isset($donnees['dateAjout']))$this->_dateajout = $donnees['dateAjout']; 
		if(isset($donnees['report']))$this->_report = $donnees['report']; 
		if(isset($donnees['iduser']))$this->_iduser = $donnees['iduser']; 
		
		
	}
	public function setId($id)
	{
		$this->_id = $id;
	} 
	public function getId()
	{
		return $this->_id;
	} 
	public function setIdbillet($idbillet)
	{
		$this->_idbillet = $idbillet;
	} 
	public function getIdbillet()
	{
		return $this->_idbillet;
	} 
	public function setIduser($iduser)
	{
		$this->_iduser = $iduser;
	} 
	public function getIduser()
	{
		return $this->_iduser;
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
	public function setReport($report)
	{
		$this->_report = $report;
	} 
	public function getReport()
	{
		return $this->_report;
	} 
}
?>