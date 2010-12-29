<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class documentRecord {
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
	public $id_doc;
	/** 
	* @var  string
	*/
	public $extension;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  string
	*/
	public $base64;
	/* full constructor */
	 public function documentRecord($error='',$qid='',$id=0,$id_etab=0,$id_doc='',$extension='',$description='',$base64=''){
		 $this->error=$error   ;
		 $this->qid=$qid   ;
		 $this->id=$id   ;
		 $this->id_etab=$id_etab   ;
		 $this->id_doc=$id_doc   ;
		 $this->extension=$extension   ;
		 $this->description=$description   ;
		 $this->base64=$base64   ;
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

	public function getId_doc(){
		 return $this->id_doc;
	}

	public function getExtension(){
		 return $this->extension;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getBase64(){
		 return $this->base64;
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

	public function setId_doc($id_doc){
		$this->id_doc=$id_doc;
	}

	public function setExtension($extension){
		$this->extension=$extension;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setBase64($base64){
		$this->base64=$base64;
	}

}

?>
