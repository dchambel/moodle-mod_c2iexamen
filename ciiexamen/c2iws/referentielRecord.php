<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class referentielRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $referentielc2i;
	/** 
	* @var  string
	*/
	public $domaine;
	/* full constructor */
	 public function referentielRecord($error='',$referentielc2i='',$domaine=''){
		 $this->error=$error   ;
		 $this->referentielc2i=$referentielc2i   ;
		 $this->domaine=$domaine   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getReferentielc2i(){
		 return $this->referentielc2i;
	}

	public function getDomaine(){
		 return $this->domaine;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setReferentielc2i($referentielc2i){
		$this->referentielc2i=$referentielc2i;
	}

	public function setDomaine($domaine){
		$this->domaine=$domaine;
	}

}

?>
