<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class familleRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $idf;
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
	public $famille;
	/** 
	* @var  string
	*/
	public $mots_clesf;
	/** 
	* @var  string
	*/
	public $commentaires;
	/** 
	* @var  string
	*/
	public $auteur;
	/** 
	* @var  string
	*/
	public $auteur_mail;
	/** 
	* @var  integer
	*/
	public $ts_datecreation;
	/** 
	* @var  integer
	*/
	public $ts_dateutilisation;
	/* full constructor */
	 public function familleRecord($error='',$idf=0,$referentielc2i='',$alinea=0,$famille='',$mots_clesf='',$commentaires='',$auteur='',$auteur_mail='',$ts_datecreation=0,$ts_dateutilisation=0){
		 $this->error=$error   ;
		 $this->idf=$idf   ;
		 $this->referentielc2i=$referentielc2i   ;
		 $this->alinea=$alinea   ;
		 $this->famille=$famille   ;
		 $this->mots_clesf=$mots_clesf   ;
		 $this->commentaires=$commentaires   ;
		 $this->auteur=$auteur   ;
		 $this->auteur_mail=$auteur_mail   ;
		 $this->ts_datecreation=$ts_datecreation   ;
		 $this->ts_dateutilisation=$ts_dateutilisation   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getIdf(){
		 return $this->idf;
	}

	public function getReferentielc2i(){
		 return $this->referentielc2i;
	}

	public function getAlinea(){
		 return $this->alinea;
	}

	public function getFamille(){
		 return $this->famille;
	}

	public function getMots_clesf(){
		 return $this->mots_clesf;
	}

	public function getCommentaires(){
		 return $this->commentaires;
	}

	public function getAuteur(){
		 return $this->auteur;
	}

	public function getAuteur_mail(){
		 return $this->auteur_mail;
	}

	public function getTs_datecreation(){
		 return $this->ts_datecreation;
	}

	public function getTs_dateutilisation(){
		 return $this->ts_dateutilisation;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setIdf($idf){
		$this->idf=$idf;
	}

	public function setReferentielc2i($referentielc2i){
		$this->referentielc2i=$referentielc2i;
	}

	public function setAlinea($alinea){
		$this->alinea=$alinea;
	}

	public function setFamille($famille){
		$this->famille=$famille;
	}

	public function setMots_clesf($mots_clesf){
		$this->mots_clesf=$mots_clesf;
	}

	public function setCommentaires($commentaires){
		$this->commentaires=$commentaires;
	}

	public function setAuteur($auteur){
		$this->auteur=$auteur;
	}

	public function setAuteur_mail($auteur_mail){
		$this->auteur_mail=$auteur_mail;
	}

	public function setTs_datecreation($ts_datecreation){
		$this->ts_datecreation=$ts_datecreation;
	}

	public function setTs_dateutilisation($ts_dateutilisation){
		$this->ts_dateutilisation=$ts_dateutilisation;
	}

}

?>
