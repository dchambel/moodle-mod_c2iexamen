<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class etablissementRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id_etab;
	/** 
	* @var  string
	*/
	public $nom_etab;
	/** 
	* @var  integer
	*/
	public $pere;
	/** 
	* @var  integer
	*/
	public $positionnement;
	/** 
	* @var  integer
	*/
	public $certification;
	/** 
	* @var  integer
	*/
	public $locale;
	/** 
	* @var  integer
	*/
	public $nationale;
	/* full constructor */
	 public function etablissementRecord($error='',$id_etab=0,$nom_etab='',$pere=0,$positionnement=0,$certification=0,$locale=0,$nationale=0){
		 $this->error=$error   ;
		 $this->id_etab=$id_etab   ;
		 $this->nom_etab=$nom_etab   ;
		 $this->pere=$pere   ;
		 $this->positionnement=$positionnement   ;
		 $this->certification=$certification   ;
		 $this->locale=$locale   ;
		 $this->nationale=$nationale   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId_etab(){
		 return $this->id_etab;
	}

	public function getNom_etab(){
		 return $this->nom_etab;
	}

	public function getPere(){
		 return $this->pere;
	}

	public function getPositionnement(){
		 return $this->positionnement;
	}

	public function getCertification(){
		 return $this->certification;
	}

	public function getLocale(){
		 return $this->locale;
	}

	public function getNationale(){
		 return $this->nationale;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId_etab($id_etab){
		$this->id_etab=$id_etab;
	}

	public function setNom_etab($nom_etab){
		$this->nom_etab=$nom_etab;
	}

	public function setPere($pere){
		$this->pere=$pere;
	}

	public function setPositionnement($positionnement){
		$this->positionnement=$positionnement;
	}

	public function setCertification($certification){
		$this->certification=$certification;
	}

	public function setLocale($locale){
		$this->locale=$locale;
	}

	public function setNationale($nationale){
		$this->nationale=$nationale;
	}

}

?>
