<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class inscritInputRecord {
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
	public $password;
	/** 
	* @var  string
	*/
	public $passwordmd5;
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
	public $email;
	/** 
	* @var  string
	*/
	public $auth;
	/* full constructor */
	 public function inscritInputRecord($nom='',$prenom='',$login='',$password='',$passwordmd5='',$etablissement=0,$numetudiant='',$email='',$auth=''){
		 $this->nom=$nom   ;
		 $this->prenom=$prenom   ;
		 $this->login=$login   ;
		 $this->password=$password   ;
		 $this->passwordmd5=$passwordmd5   ;
		 $this->etablissement=$etablissement   ;
		 $this->numetudiant=$numetudiant   ;
		 $this->email=$email   ;
		 $this->auth=$auth   ;
	}
	/* get accessors */
	public function getNom(){
		 return $this->nom;
	}

	public function getPrenom(){
		 return $this->prenom;
	}

	public function getLogin(){
		 return $this->login;
	}

	public function getPassword(){
		 return $this->password;
	}

	public function getPasswordmd5(){
		 return $this->passwordmd5;
	}

	public function getEtablissement(){
		 return $this->etablissement;
	}

	public function getNumetudiant(){
		 return $this->numetudiant;
	}

	public function getEmail(){
		 return $this->email;
	}

	public function getAuth(){
		 return $this->auth;
	}

	/*set accessors */
	public function setNom($nom){
		$this->nom=$nom;
	}

	public function setPrenom($prenom){
		$this->prenom=$prenom;
	}

	public function setLogin($login){
		$this->login=$login;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function setPasswordmd5($passwordmd5){
		$this->passwordmd5=$passwordmd5;
	}

	public function setEtablissement($etablissement){
		$this->etablissement=$etablissement;
	}

	public function setNumetudiant($numetudiant){
		$this->numetudiant=$numetudiant;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setAuth($auth){
		$this->auth=$auth;
	}

}

?>
