<?php
namespace App;
use PDO;

class Caraca {

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getQuestions()
    {
        return $this->pdo->query('SELECT * FROM question ORDER BY RAND()')->fetchAll(PDO::FETCH_OBJ);
    }

    public function getClassement()
    {
        return $this->pdo->query('SELECT nom_equipe FROM score ORDER BY (nbre_rep * 100) / nbre_qst DESC')->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertGroup(string $name): int {

		$req = $this->pdo->prepare('INSERT INTO score (nom_equipe) VALUES  (:nom_equipe)');
  		$req->execute(array(':nom_equipe'=>$name));
		$id = $this->pdo->lastInsertId();
		return $id;	  
    }
    
    public function updateGroup (int $id, int $qst, int $rep, string $temps, int $etat = 0)
    {
		$req = $this->pdo->prepare('UPDATE score SET nbre_qst = :nbre_qst, nbre_rep = :nbre_rep, temps = :temps, etat = :etat WHERE id_equipe = :id_equipe');
		$req->execute(array(
			'nbre_qst' => $qst,
			'nbre_rep' => $rep,
			'temps' => $temps,
			'etat' => $etat,
			'id_equipe' => $id
        ));
    }

    public function question(int $id)
    {
        $queryQst = $this->pdo->prepare('SELECT * FROM question WHERE id_question=? ');
        $queryQst->execute([$id]);
        return $queryQst->fetch(PDO::FETCH_OBJ);
         
    }

    public function reponse(int $id)
    {
        $queryRep = $this->pdo->prepare('SELECT * FROM reponse WHERE id_question=? ');
        $queryRep->execute([$id]);
        return $queryRep->fetchAll(PDO::FETCH_OBJ);
         
    }
    
}