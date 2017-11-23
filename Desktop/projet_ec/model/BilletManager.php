<?php
class BilletManager
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
    public function add(Billet $billet)
     {
         $requete = $this->getDb()->prepare('INSERT INTO billet SET titre = :titre, contenu = :contenu, dateajout = NOW()');
         $requete->bindValue(':titre', $billet->getTitre());
         $requete->bindValue(':contenu', $billet->getContenu());
         $requete->execute();
     }
    public function getList($debut = -1, $limite = -1)
    {
        $listeNews = array();
        $sql = 'SELECT id, titre, contenu, DATE_FORMAT
        (dateajout, \'le %d/%m/%Y &agrave; %Hh%i\') AS dateAjout FROM billet ORDER BY
        id DESC';
        return $this->getDb()->query($sql);
    }
    public function find($info)
    {
        $q = $this->getDb()->query('SELECT id, titre, contenu, DATE_FORMAT (dateAjout, \'le %d/%m/%Y &agrave; %Hh%i\') AS dateAjout FROM billet WHERE id = '.$info->getId());
        return $q;
        
    }
    public function validermodification(Billet $billetamodifier){
        $q = $this->getDb()->prepare('UPDATE billet SET titre =:titre, contenu = :contenu WHERE id =:id');
        $q->bindValue(':titre', $billetamodifier->getTitre());
        $q->bindValue(':contenu', $billetamodifier->getContenu());
        $q->bindValue(':id', $billetamodifier->getId(), PDO::PARAM_INT);
        $q->execute();
    }
    public function delete(Billet $billet)
    { 
        $this->_db->exec('DELETE FROM billet WHERE id = '.$billet->getId());
    }

    public function getBillets($pageget){
        $page = $pageget;
               $limite = 2;
                $debut = ($page-1) * $limite;
               // Partie "Requête"

               $query = 'SELECT id, titre, contenu, DATE_FORMAT (dateajout, \'le %d/%m/%Y &agrave; %Hh%i\') AS dateajout FROM billet  LIMIT :limite OFFSET :debut';
               $requete = $this->getDb()->prepare($query);
                $requete->bindValue('debut', $debut, PDO::PARAM_INT);
                 $requete->bindValue('limite', $limite, PDO::PARAM_INT);
               $requete->execute();
                
                   $resultFoundRows = $this->getDb()->query('SELECT COUNT(*) as nb FROM billet');
                   $nombredElementsTotal = $resultFoundRows->fetchColumn();
                  //echo $nombredElementsTotal;
                   $databillets['nbtotal'] =  $nombredElementsTotal;
                    $databillets['resultat'] =  $requete;
                 return  $databillets;

    }

}
?>