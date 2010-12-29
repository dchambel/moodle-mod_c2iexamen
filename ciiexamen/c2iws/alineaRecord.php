<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class alineaRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $alinea;
	/** 
	* @var  string
	*/
	public $referentielc2i;
	/** 
	* @var  string
	*/
	public $aptitude;
	/* full constructor */
	 public function alineaRecord($error='',$id='',$alinea=0,$referentielc2i='',$aptitude=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->alinea=$alinea   ;
		 $this->referentielc2i=$referentielc2i   ;
		 $this->aptitude=$aptitude   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getAlinea(){
		 return $this->alinea;
	}

	public function getReferentielc2i(){
		 return $this->referentielc2i;
	}

	public function getAptitude(){
		 return $this->aptitude;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setAlinea($alinea){
		$this->alinea=$alinea;
	}

	public function setReferentielc2i($referentielc2i){
		$this->referentielc2i=$referentielc2i;
	}

	public function setAptitude($aptitude){
		$this->aptitude=$aptitude;
	}

}

?>
