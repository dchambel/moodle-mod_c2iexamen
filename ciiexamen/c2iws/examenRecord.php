<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class examenRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $eid;
	/** 
	* @var  integer
	*/
	public $id_etab;
	/** 
	* @var  integer
	*/
	public $id_examen;
	/** 
	* @var  string
	*/
	public $nom_examen;
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
	public $ts_datedebut;
	/** 
	* @var  integer
	*/
	public $ts_datefin;
	/** 
	* @var  string
	*/
	public $langue;
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
	public $type_tirage;
	/** 
	* @var  string
	*/
	public $ordre_q;
	/** 
	* @var  string
	*/
	public $ordre_r;
	/** 
	* @var  string
	*/
	public $correction;
	/** 
	* @var  string
	*/
	public $resultat_mini;
	/** 
	* @var  string
	*/
	public $mot_de_passe;
	/** 
	* @var  integer
	*/
	public $envoi_resultat;
	/* full constructor */
	 public function examenRecord($error='',$eid='',$id_etab=0,$id_examen=0,$nom_examen='',$auteur='',$auteur_mail='',$ts_datecreation=0,$ts_datemodification=0,$ts_datedebut=0,$ts_datefin=0,$langue='',$positionnement='',$certification='',$type_tirage='',$ordre_q='',$ordre_r='',$correction='',$resultat_mini='',$mot_de_passe='',$envoi_resultat=0){
		 $this->error=$error   ;
		 $this->eid=$eid   ;
		 $this->id_etab=$id_etab   ;
		 $this->id_examen=$id_examen   ;
		 $this->nom_examen=$nom_examen   ;
		 $this->auteur=$auteur   ;
		 $this->auteur_mail=$auteur_mail   ;
		 $this->ts_datecreation=$ts_datecreation   ;
		 $this->ts_datemodification=$ts_datemodification   ;
		 $this->ts_datedebut=$ts_datedebut   ;
		 $this->ts_datefin=$ts_datefin   ;
		 $this->langue=$langue   ;
		 $this->positionnement=$positionnement   ;
		 $this->certification=$certification   ;
		 $this->type_tirage=$type_tirage   ;
		 $this->ordre_q=$ordre_q   ;
		 $this->ordre_r=$ordre_r   ;
		 $this->correction=$correction   ;
		 $this->resultat_mini=$resultat_mini   ;
		 $this->mot_de_passe=$mot_de_passe   ;
		 $this->envoi_resultat=$envoi_resultat   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getEid(){
		 return $this->eid;
	}

	public function getId_etab(){
		 return $this->id_etab;
	}

	public function getId_examen(){
		 return $this->id_examen;
	}

	public function getNom_examen(){
		 return $this->nom_examen;
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

	public function getTs_datedebut(){
		 return $this->ts_datedebut;
	}

	public function getTs_datefin(){
		 return $this->ts_datefin;
	}

	public function getLangue(){
		 return $this->langue;
	}

	public function getPositionnement(){
		 return $this->positionnement;
	}

	public function getCertification(){
		 return $this->certification;
	}

	public function getType_tirage(){
		 return $this->type_tirage;
	}

	public function getOrdre_q(){
		 return $this->ordre_q;
	}

	public function getOrdre_r(){
		 return $this->ordre_r;
	}

	public function getCorrection(){
		 return $this->correction;
	}

	public function getResultat_mini(){
		 return $this->resultat_mini;
	}

	public function getMot_de_passe(){
		 return $this->mot_de_passe;
	}

	public function getEnvoi_resultat(){
		 return $this->envoi_resultat;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setEid($eid){
		$this->eid=$eid;
	}

	public function setId_etab($id_etab){
		$this->id_etab=$id_etab;
	}

	public function setId_examen($id_examen){
		$this->id_examen=$id_examen;
	}

	public function setNom_examen($nom_examen){
		$this->nom_examen=$nom_examen;
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

	public function setTs_datedebut($ts_datedebut){
		$this->ts_datedebut=$ts_datedebut;
	}

	public function setTs_datefin($ts_datefin){
		$this->ts_datefin=$ts_datefin;
	}

	public function setLangue($langue){
		$this->langue=$langue;
	}

	public function setPositionnement($positionnement){
		$this->positionnement=$positionnement;
	}

	public function setCertification($certification){
		$this->certification=$certification;
	}

	public function setType_tirage($type_tirage){
		$this->type_tirage=$type_tirage;
	}

	public function setOrdre_q($ordre_q){
		$this->ordre_q=$ordre_q;
	}

	public function setOrdre_r($ordre_r){
		$this->ordre_r=$ordre_r;
	}

	public function setCorrection($correction){
		$this->correction=$correction;
	}

	public function setResultat_mini($resultat_mini){
		$this->resultat_mini=$resultat_mini;
	}

	public function setMot_de_passe($mot_de_passe){
		$this->mot_de_passe=$mot_de_passe;
	}

	public function setEnvoi_resultat($envoi_resultat){
		$this->envoi_resultat=$envoi_resultat;
	}

}

?>
