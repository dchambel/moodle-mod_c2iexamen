<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class bilanDetailleRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $login;
	/** 
	* @var  string
	*/
	public $numetudiant;
	/** 
	* @var  string
	*/
	public $examen;
	/** 
	* @var  integer
	*/
	public $date;
	/** 
	* @var  float
	*/
	public $score;
	/** 
	* @var  string
	*/
	public $ip;
	/** 
	* @var  string
	*/
	public $origine;
	/** 
	* @var  (scoreRecords) array of scoreRecord
	*/
	public $details;
	/* full constructor */
	 public function bilanDetailleRecord($error='',$login='',$numetudiant='',$examen='',$date=0,$score=0.0,$ip='',$origine='',$details=array()){
		 $this->error=$error   ;
		 $this->login=$login   ;
		 $this->numetudiant=$numetudiant   ;
		 $this->examen=$examen   ;
		 $this->date=$date   ;
		 $this->score=$score   ;
		 $this->ip=$ip   ;
		 $this->origine=$origine   ;
		 $this->details=$details   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getLogin(){
		 return $this->login;
	}

	public function getNumetudiant(){
		 return $this->numetudiant;
	}

	public function getExamen(){
		 return $this->examen;
	}

	public function getDate(){
		 return $this->date;
	}

	public function getScore(){
		 return $this->score;
	}

	public function getIp(){
		 return $this->ip;
	}

	public function getOrigine(){
		 return $this->origine;
	}

	public function getDetails(){
		 return $this->details;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setLogin($login){
		$this->login=$login;
	}

	public function setNumetudiant($numetudiant){
		$this->numetudiant=$numetudiant;
	}

	public function setExamen($examen){
		$this->examen=$examen;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function setScore($score){
		$this->score=$score;
	}

	public function setIp($ip){
		$this->ip=$ip;
	}

	public function setOrigine($origine){
		$this->origine=$origine;
	}

	public function setDetails($details){
		$this->details=$details;
	}

}

?>
