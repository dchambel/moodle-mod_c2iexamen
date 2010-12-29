<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class qcmItemRecord {
	/** 
	* @var  questionRecord
	*/
	public $question;
	/** 
	* @var  (reponseRecords) array of reponseRecord
	*/
	public $reponses;
	/** 
	* @var  (documentRecords) array of documentRecord
	*/
	public $documents;
	/* full constructor */
	 public function qcmItemRecord($question=NULL,$reponses=array(),$documents=array()){
		 $this->question=$question   ;
		 $this->reponses=$reponses   ;
		 $this->documents=$documents   ;
	}
	/* get accessors */
	public function getQuestion(){
		 return $this->question;
	}

	public function getReponses(){
		 return $this->reponses;
	}

	public function getDocuments(){
		 return $this->documents;
	}

	/*set accessors */
	public function setQuestion($question){
		$this->question=$question;
	}

	public function setReponses($reponses){
		$this->reponses=$reponses;
	}

	public function setDocuments($documents){
		$this->documents=$documents;
	}

}

?>
