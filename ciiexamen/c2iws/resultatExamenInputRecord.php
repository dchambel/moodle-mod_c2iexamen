<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class resultatExamenInputRecord {
	/** 
	* @var  string
	*/
	public $login;
	/** 
	* @var  integer
	*/
	public $date;
	/** 
	* @var  float
	*/
	public $score;
	/* full constructor */
	 public function resultatExamenInputRecord($login='',$date=0,$score=0.0){
		 $this->login=$login   ;
		 $this->date=$date   ;
		 $this->score=$score   ;
	}
	/* get accessors */
	public function getLogin(){
		 return $this->login;
	}

	public function getDate(){
		 return $this->date;
	}

	public function getScore(){
		 return $this->score;
	}

	/*set accessors */
	public function setLogin($login){
		$this->login=$login;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function setScore($score){
		$this->score=$score;
	}

}

?>
