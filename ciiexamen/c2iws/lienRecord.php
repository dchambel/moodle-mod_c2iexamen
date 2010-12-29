<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class lienRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $id_notion;
	/** 
	* @var  string
	*/
	public $origine;
	/** 
	* @var  string
	*/
	public $URL;
	/* full constructor */
	 public function lienRecord($error='',$id=0,$id_notion=0,$origine='',$URL=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->id_notion=$id_notion   ;
		 $this->origine=$origine   ;
		 $this->URL=$URL   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getId_notion(){
		 return $this->id_notion;
	}

	public function getOrigine(){
		 return $this->origine;
	}

	public function getURL(){
		 return $this->URL;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setId_notion($id_notion){
		$this->id_notion=$id_notion;
	}

	public function setOrigine($origine){
		$this->origine=$origine;
	}

	public function setURL($URL){
		$this->URL=$URL;
	}

}

?>
