<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class reponseRecord {
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
	* @var  integer
	*/
	public $num;
	/** 
	* @var  string
	*/
	public $reponse;
	/** 
	* @var  boolean
	*/
	public $bonne;
	/* full constructor */
	 public function reponseRecord($error='',$qid='',$id=0,$id_etab=0,$num=0,$reponse='',$bonne=false){
		 $this->error=$error   ;
		 $this->qid=$qid   ;
		 $this->id=$id   ;
		 $this->id_etab=$id_etab   ;
		 $this->num=$num   ;
		 $this->reponse=$reponse   ;
		 $this->bonne=$bonne   ;
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

	public function getNum(){
		 return $this->num;
	}

	public function getReponse(){
		 return $this->reponse;
	}

	public function getBonne(){
		 return $this->bonne;
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

	public function setNum($num){
		$this->num=$num;
	}

	public function setReponse($reponse){
		$this->reponse=$reponse;
	}

	public function setBonne($bonne){
		$this->bonne=$bonne;
	}

}

?>
