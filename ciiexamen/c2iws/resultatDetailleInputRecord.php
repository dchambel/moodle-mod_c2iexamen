<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class resultatDetailleInputRecord {
	/** 
	* @var  string
	*/
	public $login;
	/** 
	* @var  string
	*/
	public $question;
	/** 
	* @var  integer
	*/
	public $date;
	/** 
	* @var  float
	*/
	public $score;
	/* full constructor */
	 public function resultatDetailleInputRecord($login='',$question='',$date=0,$score=0.0){
		 $this->login=$login   ;
		 $this->question=$question   ;
		 $this->date=$date   ;
		 $this->score=$score   ;
	}
	/* get accessors */
	public function getLogin(){
		 return $this->login;
	}

	public function getQuestion(){
		 return $this->question;
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

	public function setQuestion($question){
		$this->question=$question;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function setScore($score){
		$this->score=$score;
	}

}

?>
