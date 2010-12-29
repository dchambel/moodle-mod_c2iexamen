<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class personnelInputRecord {
	/** 
	* @var  string
	*/
	public $login;
	/** 
	* @var  string
	*/
	public $password;
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
	public $numetudiant;
	/** 
	* @var  string
	*/
	public $auth;
	/* full constructor */
	 public function personnelInputRecord($login='',$password='',$nom='',$prenom='',$email='',$etablissement=0,$numetudiant='',$auth=''){
		 $this->login=$login   ;
		 $this->password=$password   ;
		 $this->nom=$nom   ;
		 $this->prenom=$prenom   ;
		 $this->email=$email   ;
		 $this->etablissement=$etablissement   ;
		 $this->numetudiant=$numetudiant   ;
		 $this->auth=$auth   ;
	}
	/* get accessors */
	public function getLogin(){
		 return $this->login;
	}

	public function getPassword(){
		 return $this->password;
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

	public function getNumetudiant(){
		 return $this->numetudiant;
	}

	public function getAuth(){
		 return $this->auth;
	}

	/*set accessors */
	public function setLogin($login){
		$this->login=$login;
	}

	public function setPassword($password){
		$this->password=$password;
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

	public function setNumetudiant($numetudiant){
		$this->numetudiant=$numetudiant;
	}

	public function setAuth($auth){
		$this->auth=$auth;
	}

}

?>
