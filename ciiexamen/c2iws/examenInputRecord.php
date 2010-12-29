<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class examenInputRecord {
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
	public $ts_datedebut;
	/** 
	* @var  integer
	*/
	public $ts_datefin;
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
	 public function examenInputRecord($nom_examen='',$auteur='',$auteur_mail='',$ts_datedebut=0,$ts_datefin=0,$positionnement='',$certification='',$type_tirage='',$ordre_q='',$ordre_r='',$correction='',$resultat_mini='',$mot_de_passe='',$envoi_resultat=0){
		 $this->nom_examen=$nom_examen   ;
		 $this->auteur=$auteur   ;
		 $this->auteur_mail=$auteur_mail   ;
		 $this->ts_datedebut=$ts_datedebut   ;
		 $this->ts_datefin=$ts_datefin   ;
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
	public function getNom_examen(){
		 return $this->nom_examen;
	}

	public function getAuteur(){
		 return $this->auteur;
	}

	public function getAuteur_mail(){
		 return $this->auteur_mail;
	}

	public function getTs_datedebut(){
		 return $this->ts_datedebut;
	}

	public function getTs_datefin(){
		 return $this->ts_datefin;
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
	public function setNom_examen($nom_examen){
		$this->nom_examen=$nom_examen;
	}

	public function setAuteur($auteur){
		$this->auteur=$auteur;
	}

	public function setAuteur_mail($auteur_mail){
		$this->auteur_mail=$auteur_mail;
	}

	public function setTs_datedebut($ts_datedebut){
		$this->ts_datedebut=$ts_datedebut;
	}

	public function setTs_datefin($ts_datefin){
		$this->ts_datefin=$ts_datefin;
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
