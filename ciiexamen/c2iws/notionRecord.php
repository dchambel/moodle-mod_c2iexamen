<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class notionRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $nid;
	/** 
	* @var  integer
	*/
	public $id_notion;
	/** 
	* @var  integer
	*/
	public $id_etab;
	/** 
	* @var  string
	*/
	public $referentielc2i;
	/** 
	* @var  integer
	*/
	public $alinea;
	/** 
	* @var  string
	*/
	public $libelle;
	/** 
	* @var  integer
	*/
	public $ts_datecreation;
	/** 
	* @var  integer
	*/
	public $ts_datemodification;
	/* full constructor */
	 public function notionRecord($error='',$nid='',$id_notion=0,$id_etab=0,$referentielc2i='',$alinea=0,$libelle='',$ts_datecreation=0,$ts_datemodification=0){
		 $this->error=$error   ;
		 $this->nid=$nid   ;
		 $this->id_notion=$id_notion   ;
		 $this->id_etab=$id_etab   ;
		 $this->referentielc2i=$referentielc2i   ;
		 $this->alinea=$alinea   ;
		 $this->libelle=$libelle   ;
		 $this->ts_datecreation=$ts_datecreation   ;
		 $this->ts_datemodification=$ts_datemodification   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getNid(){
		 return $this->nid;
	}

	public function getId_notion(){
		 return $this->id_notion;
	}

	public function getId_etab(){
		 return $this->id_etab;
	}

	public function getReferentielc2i(){
		 return $this->referentielc2i;
	}

	public function getAlinea(){
		 return $this->alinea;
	}

	public function getLibelle(){
		 return $this->libelle;
	}

	public function getTs_datecreation(){
		 return $this->ts_datecreation;
	}

	public function getTs_datemodification(){
		 return $this->ts_datemodification;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setNid($nid){
		$this->nid=$nid;
	}

	public function setId_notion($id_notion){
		$this->id_notion=$id_notion;
	}

	public function setId_etab($id_etab){
		$this->id_etab=$id_etab;
	}

	public function setReferentielc2i($referentielc2i){
		$this->referentielc2i=$referentielc2i;
	}

	public function setAlinea($alinea){
		$this->alinea=$alinea;
	}

	public function setLibelle($libelle){
		$this->libelle=$libelle;
	}

	public function setTs_datecreation($ts_datecreation){
		$this->ts_datecreation=$ts_datecreation;
	}

	public function setTs_datemodification($ts_datemodification){
		$this->ts_datemodification=$ts_datemodification;
	}

}

?>
