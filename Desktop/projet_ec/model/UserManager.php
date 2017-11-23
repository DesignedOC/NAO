<?php
class UserManager
{
    private $_db; // Instance de PDO
    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
    public function getDb()
    {
        return $this->_db;
    } 
    public function add(User $User)
     {
         $requete = $this->getDb()->prepare('INSERT INTO user SET log = :log, mdp = :mdp , isadmin= :isadmin ');
         $requete->bindValue(':log', $User->getLog());
         $requete->bindValue(':mdp', $User->getMdp());
          $requete->bindValue(':isadmin', $User->getIsadmin());
         $requete->execute();
     }
    public function getList($debut = -1, $limite = -1)
    {
        $listeNews = array();
        $sql = 'SELECT id, log, mdp, isadmin FROM user ORDER BY
        id DESC';
        return $this->getDb()->query($sql);
    }
    public function find($id)
    {
         $q = $this->getDb()->query('SELECT id, log, mdp, isadmin FROM user WHERE id = '.$id);
        return $q;
        
    }
  
    public function delete(User $User)
    {
        $this->_db->exec('DELETE FROM user WHERE id = '.$User->getId());
    }
  
    public function findByLog($log,$mdp)
    {
        $q = $this->getDb()->prepare('SELECT id, log, mdp , isadmin FROM user WHERE log = :log and mdp = :mdp ');
        $q->bindValue(':log', $log);
         $q->bindValue(':mdp', $mdp);
         $q->execute();
         return $q;
    }
        public function update(User $user){
        $q = $this->getDb()->prepare('UPDATE user SET log =:log, mdp = :mdp WHERE id =:id');
        $q->bindValue(':log', $user->getLog());
        $q->bindValue(':mdp', $user->getMdp());
        $q->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $q->execute();
    }
   
}
?>