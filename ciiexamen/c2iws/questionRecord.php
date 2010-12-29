<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class questionRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $qid;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $id_etab;
	/** 
	* @var  string
	*/
	public $titre;
	/** 
	* @var  string
	*/
	public $referentielc2i;
	/** 
	* @var  integer
	*/
	public $alinea;
	/** 
	* @var  integer
	*/
	public $id_famille_proposee;
	/** 
	* @var  integer
	*/
	public $id_famille_validee;
	/** 
	* @var  string
	*/
	public $positionnement;
	/** 
	* @var  string
	*/
	public $certification;
	/** 
	* @var  string
	*/
	public $etat;
	/** 
	* @var  string
	*/
	public $langue;
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
	public $ts_datemodification;
	/** 
	* @var  integer
	*/
	public $ts_dateutilisation;
	/** 
	* @var  integer
	*/
	public $ts_dateenvoi;
	/* full constructor */
	 public function questionRecord($error='',$qid='',$id=0,$id_etab=0,$titre='',$referentielc2i='',$alinea=0,$id_famille_proposee=0,$id_famille_validee=0,$positionnement='',$certification='',$etat='',$langue='',$auteur='',$auteur_mail='',$ts_datecreation=0,$ts_datemodification=0,$ts_dateutilisation=0,$ts_dateenvoi=0){
		 $this->error=$error   ;
		 $this->qid=$qid   ;
		 $this->id=$id   ;
		 $this->id_etab=$id_etab   ;
		 $this->titre=$titre   ;
		 $this->referentielc2i=$referentielc2i   ;
		 $this->alinea=$alinea   ;
		 $this->id_famille_proposee=$id_famille_proposee   ;
		 $this->id_famille_validee=$id_famille_validee   ;
		 $this->positionnement=$positionnement   ;
		 $this->certification=$certification   ;
		 $this->etat=$etat   ;
		 $this->langue=$langue   ;
		 $this->auteur=$auteur   ;
		 $this->auteur_mail=$auteur_mail   ;
		 $this->ts_datecreation=$ts_datecreation   ;
		 $this->ts_datemodification=$ts_datemodification   ;
		 $this->ts_dateutilisation=$ts_dateutilisation   ;
		 $this->ts_dateenvoi=$ts_dateenvoi   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getQid(){
		 return $this->qid;
	}

	public function getId(){
		 return $this->id;
	}

	public function getId_etab(){
		 return $this->id_etab;
	}

	public function getTitre(){
		 return $this->titre;
	}

	public function getReferentielc2i(){
		 return $this->referentielc2i;
	}

	public function getAlinea(){
		 return $this->alinea;
	}

	public function getId_famille_proposee(){
		 return $this->id_famille_proposee;
	}

	public function getId_famille_validee(){
		 return $this->id_famille_validee;
	}

	public function getPositionnement(){
		 return $this->positionnement;
	}

	public function getCertification(){
		 return $this->certification;
	}

	public function getEtat(){
		 return $this->etat;
	}

	public function getLangue(){
		 return $this->langue;
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

	public function getTs_datemodification(){
		 return $this->ts_datemodification;
	}

	public function getTs_dateutilisation(){
		 return $this->ts_dateutilisation;
	}

	public function getTs_dateenvoi(){
		 return $this->ts_dateenvoi;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setQid($qid){
		$this->qid=$qid;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setId_etab($id_etab){
		$this->id_etab=$id_etab;
	}

	public function setTitre($titre){
		$this->titre=$titre;
	}

	public function setReferentielc2i($referentielc2i){
		$this->referentielc2i=$referentielc2i;
	}

	public function setAlinea($alinea){
		$this->alinea=$alinea;
	}

	public function setId_famille_proposee($id_famille_proposee){
		$this->id_famille_proposee=$id_famille_proposee;
	}

	public function setId_famille_validee($id_famille_validee){
		$this->id_famille_validee=$id_famille_validee;
	}

	public function setPositionnement($positionnement){
		$this->positionnement=$positionnement;
	}

	public function setCertification($certification){
		$this->certification=$certification;
	}

	public function setEtat($etat){
		$this->etat=$etat;
	}

	public function setLangue($langue){
		$this->langue=$langue;
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

	public function setTs_datemodification($ts_datemodification){
		$this->ts_datemodification=$ts_datemodification;
	}

	public function setTs_dateutilisation($ts_dateutilisation){
		$this->ts_dateutilisation=$ts_dateutilisation;
	}

	public function setTs_dateenvoi($ts_dateenvoi){
		$this->ts_dateenvoi=$ts_dateenvoi;
	}

}

?>
