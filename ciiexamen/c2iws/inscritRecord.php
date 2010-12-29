<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class inscritRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $nom;
	/** 
	* @var  string
	*/
	public $prenom;
	/** 
	* @var  string
	*/
	public $login;
	/** 
	* @var  string
	*/
	public $genre;
	/** 
	* @var  integer
	*/
	public $etablissement;
	/** 
	* @var  string
	*/
	public $numetudiant;
	/** 
	* @var  string
	*/
	public $examens;
	/** 
	* @var  string
	*/
	public $email;
	/** 
	* @var  string
	*/
	public $auth;
	/** 
	* @var  integer
	*/
	public $ts_datecreation;
	/** 
	* @var  integer
	*/
	public $ts_datemodification;
	/** 
	* @var  integer
	*/
	public $ts_derniere_connexion;
	/* full constructor */
	 public function inscritRecord($error='',$id=0,$nom='',$prenom='',$login='',$genre='',$etablissement=0,$numetudiant='',$examens='',$email='',$auth='',$ts_datecreation=0,$ts_datemodification=0,$ts_derniere_connexion=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->nom=$nom   ;
		 $this->prenom=$prenom   ;
		 $this->login=$login   ;
		 $this->genre=$genre   ;
		 $this->etablissement=$etablissement   ;
		 $this->numetudiant=$numetudiant   ;
		 $this->examens=$examens   ;
		 $this->email=$email   ;
		 $this->auth=$auth   ;
		 $this->ts_datecreation=$ts_datecreation   ;
		 $this->ts_datemodification=$ts_datemodification   ;
		 $this->ts_derniere_connexion=$ts_derniere_connexion   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getNom(){
		 return $this->nom;
	}

	public function getPrenom(){
		 return $this->prenom;
	}

	public function getLogin(){
		 return $this->login;
	}

	public function getGenre(){
		 return $this->genre;
	}

	public function getEtablissement(){
		 return $this->etablissement;
	}

	public function getNumetudiant(){
		 return $this->numetudiant;
	}

	public function getExamens(){
		 return $this->examens;
	}

	public function getEmail(){
		 return $this->email;
	}

	public function getAuth(){
		 return $this->auth;
	}

	public function getTs_datecreation(){
		 return $this->ts_datecreation;
	}

	public function getTs_datemodification(){
		 return $this->ts_datemodification;
	}

	public function getTs_derniere_connexion(){
		 return $this->ts_derniere_connexion;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setNom($nom){
		$this->nom=$nom;
	}

	public function setPrenom($prenom){
		$this->prenom=$prenom;
	}

	public function setLogin($login){
		$this->login=$login;
	}

	public function setGenre($genre){
		$this->genre=$genre;
	}

	public function setEtablissement($etablissement){
		$this->etablissement=$etablissement;
	}

	public function setNumetudiant($numetudiant){
		$this->numetudiant=$numetudiant;
	}

	public function setExamens($examens){
		$this->examens=$examens;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setAuth($auth){
		$this->auth=$auth;
	}

	public function setTs_datecreation($ts_datecreation){
		$this->ts_datecreation=$ts_datecreation;
	}

	public function setTs_datemodification($ts_datemodification){
		$this->ts_datemodification=$ts_datemodification;
	}

	public function setTs_derniere_connexion($ts_derniere_connexion){
		$this->ts_derniere_connexion=$ts_derniere_connexion;
	}

}

?>
