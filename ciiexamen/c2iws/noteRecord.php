<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class noteRecord {
	/** 
	* @var  string
	*/
	public $login;
	/** 
	* @var  string
	*/
	public $numetudiant;
	/** 
	* @var  float
	*/
	public $score;
	/** 
	* @var  integer
	*/
	public $date;
	/** 
	* @var  string
	*/
	public $ip;
	/** 
	* @var  string
	*/
	public $origine;
	/* full constructor */
	 public function noteRecord($login='',$numetudiant='',$score=0.0,$date=0,$ip='',$origine=''){
		 $this->login=$login   ;
		 $this->numetudiant=$numetudiant   ;
		 $this->score=$score   ;
		 $this->date=$date   ;
		 $this->ip=$ip   ;
		 $this->origine=$origine   ;
	}
	/* get accessors */
	public function getLogin(){
		 return $this->login;
	}

	public function getNumetudiant(){
		 return $this->numetudiant;
	}

	public function getScore(){
		 return $this->score;
	}

	public function getDate(){
		 return $this->date;
	}

	public function getIp(){
		 return $this->ip;
	}

	public function getOrigine(){
		 return $this->origine;
	}

	/*set accessors */
	public function setLogin($login){
		$this->login=$login;
	}

	public function setNumetudiant($numetudiant){
		$this->numetudiant=$numetudiant;
	}

	public function setScore($score){
		$this->score=$score;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function setIp($ip){
		$this->ip=$ip;
	}

	public function setOrigine($origine){
		$this->origine=$origine;
	}

}

?>
