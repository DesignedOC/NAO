<?php
class User
{
	private $_id;
	private $_log;
	private $_mdp;
	private $_isadmin;
	
	public function __construct($donnees)
	{
		if(isset($donnees['id']))$this->_id = $donnees['id']; 
		if(isset($donnees['log']))$this->_log = $donnees['log']; 
		if(isset($donnees['mdp']))$this->_mdp = $donnees['mdp']; 
		if(isset($donnees['isadmin']))$this->_isadmin = $donnees['isadmin']; 
	}
	
	public function setId($id)
	{
		$this->_id = $id;
	} 
	public function getId()
	{
		return $this->_id;
	} 
	public function setLog($log)
	{
		$this->_log = $log;
	} 
	public function getLog()
	{
		return $this->_log;
	} 
	public function setMdp($mdp)
	{
		$this->_mdp = $mdp;
	} 
	public function getMdp()
	{
		return $this->_mdp;
	} 
	public function setIsadmin($isadmin)
	{
		$this->_isadmin = $isadmin;
	} 
	public function getIsadmin()
	{
		return $this->_isadmin;
	} 
	
}
?>