<?php
/**
 * C2IWS class file
 *
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */

define('DEBUG',true);
if (DEBUG) ini_set('soap.wsdl_cache_enabled', '0');  // no caching by php in debug mode

/**
 * etablissementRecord class
 */
require_once 'etablissementRecord.php';
/**
 * inscritRecord class
 */
require_once 'inscritRecord.php';
/**
 * inscritInputRecord class
 */
require_once 'inscritInputRecord.php';
/**
 * personnelRecord class
 */
require_once 'personnelRecord.php';
/**
 * personnelInputRecord class
 */
require_once 'personnelInputRecord.php';
/**
 * examenRecord class
 */
require_once 'examenRecord.php';
/**
 * examenInputRecord class
 */
require_once 'examenInputRecord.php';
/**
 * referentielRecord class
 */
require_once 'referentielRecord.php';
/**
 * alineaRecord class
 */
require_once 'alineaRecord.php';
/**
 * familleRecord class
 */
require_once 'familleRecord.php';
/**
 * notionRecord class
 */
require_once 'notionRecord.php';
/**
 * lienRecord class
 */
require_once 'lienRecord.php';
/**
 * questionRecord class
 */
require_once 'questionRecord.php';
/**
 * questionInputRecord class
 */
require_once 'questionInputRecord.php';
/**
 * reponseRecord class
 */
require_once 'reponseRecord.php';
/**
 * reponseInputRecord class
 */
require_once 'reponseInputRecord.php';
/**
 * noteRecord class
 */
require_once 'noteRecord.php';
/**
 * scoreRecord class
 */
require_once 'scoreRecord.php';
/**
 * bilanDetailleRecord class
 */
require_once 'bilanDetailleRecord.php';
/**
 * documentRecord class
 */
require_once 'documentRecord.php';
/**
 * documentInputRecord class
 */
require_once 'documentInputRecord.php';
/**
 * qcmItemRecord class
 */
require_once 'qcmItemRecord.php';
/**
 * qcmRecord class
 */
require_once 'qcmRecord.php';
/**
 * qcmItemInputRecord class
 */
require_once 'qcmItemInputRecord.php';
/**
 * stringRecord class
 */
require_once 'stringRecord.php';
/**
 * resultatExamenInputRecord class
 */
require_once 'resultatExamenInputRecord.php';
/**
 * resultatDetailleInputRecord class
 */
require_once 'resultatDetailleInputRecord.php';
/**
 * loginReturn class
 */
require_once 'loginReturn.php';

/**
 * C2IWS class
 *
 *
 *
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */
class C2IWS {

  public $client;

  private $uri = 'http://localhost/c2i/V1.5/ws/wsdl';

  public function C2IWS($wsdl = "http://localhost/c2i/V1.5/ws/wsdl.php", $uri=null, $options = array('encoding'=>'UTF8')) {
    if($uri != null) {
      $this->uri = $uri;
    }


    $this->client = new SoapClient($wsdl, $options);
  }

  function castTo($className,$res){
     if (class_exists($className)) {
        $aux= new $className();
        foreach ($res as $key=>$value)
             $aux->$key=$value;
        return $aux;
     } else
        return $res;
  }

  /**
   * C2IWS Client Login
   *
   * @param string $username
   * @param string $password
   * @return loginReturn
   */
  public function login($username, $password) {
    $res= $this->client->__call('login', array(
            new SoapParam($username, 'username'),
            new SoapParam($password, 'password')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('loginReturn',$res);
  }

  /**
   * C2IWS: Client Logout
   *
   * @param integer $client
   * @param string $sesskey
   * @return boolean
   */
  public function logout($client, $sesskey) {
    $res= $this->client->__call('logout', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les infos la version de la PF
   *
   * @param integer $client
   * @param string $sesskey
   * @return string
   */
  public function get_version($client, $sesskey) {
    $res= $this->client->__call('get_version', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie l url complet du theme courant
   * de la PF
   *
   * @param integer $client
   * @param string $sesskey
   * @return string
   */
  public function get_themeurl($client, $sesskey) {
    $res= $this->client->__call('get_themeurl', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les infos sur un examen
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return examenRecord
   */
  public function get_examen($client, $sesskey, $value) {
    $res= $this->client->__call('get_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('examenRecord',$res);
  }

  /**
   * C2IWS: renvoie tous examens d un type de PF (positionnement
   * ou certification)
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return examenRecords
   */
  public function get_examens($client, $sesskey, $value) {
    $res= $this->client->__call('get_examens', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie un qcm complet (examen +
				questions+
   * reponses
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return qcmRecord
   */
  public function get_qcm($client, $sesskey, $value) {
    $res= $this->client->__call('get_qcm', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('qcmRecord',$res);
  }

  /**
   * C2IWS: renvoie les infos sur une question
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return questionRecord
   */
  public function get_question($client, $sesskey, $value) {
    $res= $this->client->__call('get_question', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('questionRecord',$res);
  }

  /**
   * C2IWS: renvoie les questions d un examen specifie
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return questionRecords
   */
  public function get_questions($client, $sesskey, $value) {
    $res= $this->client->__call('get_questions', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie toutes les questions d un type
   * de
				plateforme
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return questionRecords
   */
  public function get_toutes_questions($client, $sesskey, $value) {
    $res= $this->client->__call('get_toutes_questions', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie toutes les questions et réponses
				d
   * un type de PF
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return qcmItemRecords
   */
  public function get_toutes_questions_et_reponses($client, $sesskey, $value) {
    $res= $this->client->__call('get_toutes_questions_et_reponses', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les questions refusees d un type
				de
   * plateforme
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return questionRecords
   */
  public function get_questions_obsoletes($client, $sesskey, $value) {
    $res= $this->client->__call('get_questions_obsoletes', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les info sur un inscrit
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @param string $id
   * @return inscritRecord
   */
  public function get_inscrit($client, $sesskey, $value, $id) {
    $res= $this->client->__call('get_inscrit', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value'),
            new SoapParam($id, 'id')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('inscritRecord',$res);
  }

  /**
   * C2IWS: renvoie les inscrits a un examen specifie
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return inscritRecords
   */
  public function get_inscrits($client, $sesskey, $value) {
    $res= $this->client->__call('get_inscrits', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les info sur un personnel specifie
   * par son login
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @param string $id
   * @return personnelRecord
   */
  public function get_personnel($client, $sesskey, $value, $id) {
    $res= $this->client->__call('get_personnel', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value'),
            new SoapParam($id, 'id')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('personnelRecord',$res);
  }

  /**
   * C2IWS: renvoie les info sur un etablissement specifie
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return etablissementRecord
   */
  public function get_etablissement($client, $sesskey, $value) {
    $res= $this->client->__call('get_etablissement', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('etablissementRecord',$res);
  }

  /**
   * C2IWS: renvoie les composantes d un
				etablissement
   * specifie par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return etablissementRecords
   */
  public function get_etablissements($client, $sesskey, $value) {
    $res= $this->client->__call('get_etablissements', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les reponses a une question specifiee
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return reponseRecords
   */
  public function get_reponses($client, $sesskey, $value) {
    $res= $this->client->__call('get_reponses', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les documents a une question specifiee
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return documentRecords
   */
  public function get_documents($client, $sesskey, $value) {
    $res= $this->client->__call('get_documents', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les notes d un examen specifie
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return noteRecords
   */
  public function get_notes_examen($client, $sesskey, $value) {
    $res= $this->client->__call('get_notes_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie le bilan d un examen par
				referentiel
   *
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return bilanDetailleRecords
   */
  public function get_bilans_examen($client, $sesskey, $value) {
    $res= $this->client->__call('get_bilans_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie le bilan d un examen specifie par
   * son ID national par
				referentiel ET/ou par
   * alinea ou les 2
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value1
   * @param string $value2
   * @return bilanDetailleRecords
   */
  public function get_bilans_detailles_examen($client, $sesskey, $value1, $value2) {
    $res= $this->client->__call('get_bilans_detailles_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value1, 'value1'),
            new SoapParam($value2, 'value2')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie le/les scores d'un candidat specifie
   * par son login ou numero ou email,
			pour un
   * tyep de plateforme et eventuellement consolides
   *
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $typep
   * @param integer $consolid
   * @return bilanDetailleRecords
   */
  public function get_scores_candidat($client, $sesskey, $id, $idfield, $typep, $consolid) {
    $res= $this->client->__call('get_scores_candidat', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($typep, 'typep'),
            new SoapParam($consolid, 'consolid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie le  score d'un candidat a un examen
   *
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $idexamen
   * @return bilanDetailleRecords
   */
  public function get_score_candidat($client, $sesskey, $id, $idfield, $idexamen) {
    $res= $this->client->__call('get_score_candidat', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idexamen, 'idexamen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les referentiels de la PF
   *
   * @param integer $client
   * @param string $sesskey
   * @return referentielRecords
   */
  public function get_referentiels($client, $sesskey) {
    $res= $this->client->__call('get_referentiels', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les alineas d un referentiel de
				la
   * PF
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return alineaRecords
   */
  public function get_alineas($client, $sesskey, $value) {
    $res= $this->client->__call('get_alineas', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les familles de la PF
   *
   * @param integer $client
   * @param string $sesskey
   * @return familleRecords
   */
  public function get_familles($client, $sesskey) {
    $res= $this->client->__call('get_familles', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les notions de la PF
   *
   * @param integer $client
   * @param string $sesskey
   * @return notionRecords
   */
  public function get_notions($client, $sesskey) {
    $res= $this->client->__call('get_notions', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les liens d une notion specifiee
   * par son ID national
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return lienRecords
   */
  public function get_liens($client, $sesskey, $value) {
    $res= $this->client->__call('get_liens', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS:soumission de questions locale
				vers
   * nationale.
				entrée : un tableau de questions
   * avec leurs reponses
				sortie : un tableau de
   * questions (sans reponses) avec le champ error
				renseigne
   *
   *
   * @param integer $client
   * @param string $sesskey
   * @param (qcmItemInputRecords) array of qcmItemInputRecord $questions
   * @return questionRecords
   */
  public function envoi_questions($client, $sesskey, $questions) {
    $res= $this->client->__call('envoi_questions', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($questions, 'questions')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS:soumission de stats examen
				locale vers
   * nationale.
				entrée : un tableau de copies
   * avec leurs scores globaux
				: un tableau de
   * questions avec leurs scores dans cet examen
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $examen
   * @param string $typep
   * @param (resultatExamenInputRecords) array of resultatExamenInputRecord $copies
   * @param (resultatDetailleInputRecords) array of resultatDetailleInputRecord $details
   * @return boolean
   */
  public function envoi_examen($client, $sesskey, $examen, $typep, $copies, $details) {
    $res= $this->client->__call('envoi_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($examen, 'examen'),
            new SoapParam($typep, 'typep'),
            new SoapParam($copies, 'copies'),
            new SoapParam($details, 'details')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS:inscription de candidats a un
				examen
   * existant.
				entrée : id examen, tableau de
   * candidats (login, ou numero ou email),nom du champ
				sortie
   * : un tableau des identifiants des candidats avec
   * le champ error
				renseigne
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param (stringInputRecords) array of string $candidats
   * @param string $idfield
   * @return stringRecords
   */
  public function inscrit_examen($client, $sesskey, $id, $candidats, $idfield) {
    $res= $this->client->__call('inscrit_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($candidats, 'candidats'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS:creation d un examen.
				entrée : examen
   * partiellement rempli
				sortie : examen complete
   * ou erreur
   *
   * @param integer $client
   * @param string $sesskey
   * @param examenInputRecord $examen
   * @return examenRecord
   */
  public function cree_examen($client, $sesskey, examenInputRecord $examen) {
    $res= $this->client->__call('cree_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($examen, 'examen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('examenRecord',$res);
  }

  /**
   * C2IWS:modification d un examen.
				entrée :
   * cid examen +examen partiellement rempli
				sortie
   * : examen complete ou erreur
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $idexamen
   * @param examenInputRecord $examen
   * @return examenRecord
   */
  public function modifie_examen($client, $sesskey, $idexamen, examenInputRecord $examen) {
    $res= $this->client->__call('modifie_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($idexamen, 'idexamen'),
            new SoapParam($examen, 'examen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('examenRecord',$res);
  }

  /**
   * C2IWS:creation d un compte de candidat.
				entrée
   * : candidat partiellement rempli
				sortie : candidat
   * complete ou erreur
   *
   * @param integer $client
   * @param string $sesskey
   * @param inscritInputRecord $candidat
   * @return inscritRecord
   */
  public function cree_candidat($client, $sesskey, inscritInputRecord $candidat) {
    $res= $this->client->__call('cree_candidat', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($candidat, 'candidat')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('inscritRecord',$res);
  }

  /**
   * C2IWS:creation ds plusieurs comptes de
				candidat.
				entrée
   * : tableau candidats partiellement rempli
				sortie
   * : tableau candidats completes ou erreur
   *
   * @param integer $client
   * @param string $sesskey
   * @param (inscritInputRecords) array of inscritInputRecord $candidats
   * @return inscritRecords
   */
  public function cree_candidats($client, $sesskey, $candidats) {
    $res= $this->client->__call('cree_candidats', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($candidats, 'candidats')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS:creation d un compte de personnel.
				entrée
   * : candidat partiellement rempli
				sortie : candidat
   * complete ou erreur
   *
   * @param integer $client
   * @param string $sesskey
   * @param personnelInputRecord $personnel
   * @return personnelRecord
   */
  public function cree_personnel($client, $sesskey, personnelInputRecord $personnel) {
    $res= $this->client->__call('cree_personnel', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($personnel, 'personnel')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('personnelRecord',$res);
  }

  /**
   * C2IWS: renvoie le  corrigé en HTML d'un candidat
   * a un examen
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $idexamen
   * @return string
   */
  public function get_corrige_examen_html($client, $sesskey, $id, $idfield, $idexamen) {
    $res= $this->client->__call('get_corrige_examen_html', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idexamen, 'idexamen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie les resultats en HTML d'un candidat
   * a un examen
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $idexamen
   * @return string
   */
  public function get_resultats_examen_html($client, $sesskey, $id, $idfield, $idexamen) {
    $res= $this->client->__call('get_resultats_examen_html', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idexamen, 'idexamen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoie le parcours en HTML  d'un candidat
   * a un examen
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $idexamen
   * @return string
   */
  public function get_parcours_examen_html($client, $sesskey, $id, $idfield, $idexamen) {
    $res= $this->client->__call('get_parcours_examen_html', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idexamen, 'idexamen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoi vrai si candidat inscrit a un examen
   *
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $idexamen
   * @return boolean
   */
  public function est_inscrit_examen($client, $sesskey, $id, $idfield, $idexamen) {
    $res= $this->client->__call('est_inscrit_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idexamen, 'idexamen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS: renvoi vrai si candidat a passé un examen
   *
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @param string $idexamen
   * @return boolean
   */
  public function a_passe_examen($client, $sesskey, $id, $idfield, $idexamen) {
    $res= $this->client->__call('a_passe_examen', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($id, 'id'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idexamen, 'idexamen')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * C2IWS:liste des passages à un examen après une
   * date .
				entrée : id_examen
				sortie : time
   * stamp début
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value1
   * @param string $value2
   * @return noteRecords
   */
  public function get_passages_recents($client, $sesskey, $value1, $value2) {
    $res= $this->client->__call('get_passages_recents', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value1, 'value1'),
            new SoapParam($value2, 'value2')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

}

?>
