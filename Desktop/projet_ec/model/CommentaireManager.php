<?php
class CommentaireManager
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
    public function add(Commentaire $Commentaire)
     {
         $requete = $this->getDb()->prepare('INSERT INTO commentaire SET idbillet = :idbillet, contenu = :contenu, dateajout = NOW() , report=0 ,  iduser = :iduser');
         $requete->bindValue(':idbillet', $Commentaire->getIdbillet());
         $requete->bindValue(':contenu', $Commentaire->getContenu());
        $requete->bindValue(':iduser', $Commentaire->getIduser());
         $requete->execute();
     }
    public function getList($debut = -1, $limite = -1)
    {
        if(isset($_SESSION['isadmin'])){
            if($_SESSION['isadmin']){
                $order = 'ORDER BY report DESC';
            }
            else $order = 'ORDER BY id DESC';
        }
        else $order = 'ORDER BY id DESC';
        $listeNews = array();
        $sql = 'SELECT id, idbillet, contenu, DATE_FORMAT
        (dateAjout, \'le %d/%m/%Y &agrave; %Hh%i\') AS dateAjout , report , iduser FROM commentaire '.$order;
        return $this->getDb()->query($sql);
    }
    public function find($id)
    {
        $q = $this->getDb()->query('SELECT id, idbillet, contenu, DATE_FORMAT (dateajout, \'le %d/%m/%Y &agrave; %Hh%i\') AS dateAjout ,report FROM commentaire WHERE id = '.$id);
        return $q;
        
    }
    public function validermodification(Commentaire $Commentaireamodifier){
        $q = $this->getDb()->prepare('UPDATE commentaire SET idbillet =:idbillet, contenu = :contenu  WHERE id =:id');
        $q->bindValue(':idbillet', $Commentaireamodifier->getIdbillet());
        $q->bindValue(':contenu', $Commentaireamodifier->getContenu());
        $q->bindValue(':id', $Commentaireamodifier->getId(), PDO::PARAM_INT);
        $q->execute();
    }
    public function delete(Commentaire $Commentaire)
    {
        $this->_db->exec('DELETE FROM commentaire WHERE id = '.$Commentaire->getId());
    }
   
     public function update(Commentaire $Commentaire)
    {
        $q = $this->getDb()->prepare('UPDATE commentaire SET contenu = :contenu WHERE id =:id');
        $q->bindValue(':contenu', $Commentaire->getContenu());
        $q->bindValue(':id', $Commentaire->getId(), PDO::PARAM_INT);
        $q->execute();
    }
    public function signaler(Commentaire $Commentaireamodifier){
        $q = $this->getDb()->prepare('UPDATE commentaire SET report =:report  WHERE id =:id');
       $q->bindValue(':report', $Commentaireamodifier->getReport()+1);
        $q->bindValue(':id', $Commentaireamodifier->getId(), PDO::PARAM_INT);
        $q->execute();
    }
     public function getListByBillet($idbillet)
    {
        if(isset($_SESSION['isadmin'])){
            if($_SESSION['isadmin']){
            $order = 'ORDER BY report DESC';
        }
        else {
         $order = 'ORDER BY id DESC';
        }
        }
        else $order = 'ORDER BY id DESC';
        $listeNews = array();
        $sql = 'SELECT id, idbillet, contenu, DATE_FORMAT
        (dateajout, \'le %d/%m/%Y &agrave; %Hh%i\') AS dateAjout , report , iduser FROM commentaire  where idbillet ='.$idbillet.' '.$order;
        return $this->getDb()->query($sql);
    }
}
?>