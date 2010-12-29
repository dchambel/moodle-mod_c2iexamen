<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class personnelRecord {
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
	public $login;
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
	public $email;
	/** 
	* @var  integer
	*/
	public $etablissement;
	/** 
	* @var  string
	*/
	public $profils;
	/** 
	* @var  string
	*/
	public $numetudiant;
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
	 public function personnelRecord($error='',$id=0,$login='',$nom='',$prenom='',$email='',$etablissement=0,$profils='',$numetudiant='',$auth='',$ts_datecreation=0,$ts_datemodification=0,$ts_derniere_connexion=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->login=$login   ;
		 $this->nom=$nom   ;
		 $this->prenom=$prenom   ;
		 $this->email=$email   ;
		 $this->etablissement=$etablissement   ;
		 $this->profils=$profils   ;
		 $this->numetudiant=$numetudiant   ;
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

	public function getLogin(){
		 return $this->login;
	}

	public function getNom(){
		 return $this->nom;
	}

	public function getPrenom(){
		 return $this->prenom;
	}

	public function getEmail(){
		 return $this->email;
	}

	public function getEtablissement(){
		 return $this->etablissement;
	}

	public function getProfils(){
		 return $this->profils;
	}

	public function getNumetudiant(){
		 return $this->numetudiant;
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

	public function setLogin($login){
		$this->login=$login;
	}

	public function setNom($nom){
		$this->nom=$nom;
	}

	public function setPrenom($prenom){
		$this->prenom=$prenom;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setEtablissement($etablissement){
		$this->etablissement=$etablissement;
	}

	public function setProfils($profils){
		$this->profils=$profils;
	}

	public function setNumetudiant($numetudiant){
		$this->numetudiant=$numetudiant;
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
