<?php //$Id: mod_form.php 282 2009-11-12 07:44:41Z ppollet $

/**
 * This file defines the main ciiexamen configuration form
 * It uses the standard core Moodle (>1.8) formslib. For
 * more info about them, please visit:
 *
 * http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * The form must provide support for, at least these fields:
 *   - name: text element of 64cc max
 *
 * Also, it's usual to use these fields:
 *   - intro: one htmlarea element to describe the activity
 *            (will be showed in the list of activities of
 *             ciiexamen type (index.php) and in the header
 *             of the ciiexamen main page (view.php).
 *   - introformat: The format used to write the contents
 *             of the intro field. It automatically defaults
 *             to HTML when the htmleditor is used and can be
 *             manually selected if the htmleditor is not used
 *             (standard formats are: MOODLE, HTML, PLAIN, MARKDOWN)
 *             See lib/weblib.php Constants and the format_text()
 *             function for more info
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once('locallib.php');

class mod_ciiexamen_mod_form extends moodleform_mod {

    function definition() {

        global $COURSE,$CFG;
        $mform =& $this->_form;

//-------------------------------------------------------------------------------
    /// Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general', 'form'));

    /// Adding the standard "name" field
        $mform->addElement('text', 'name', get_string('ciiexamenname', 'ciiexamen'), array('size'=>'64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

      /// Introduction.
        $this->add_intro_editor(false, get_string('ciiexamenname', 'ciiexamen'));

//-------------------------------------------------------------------------------
    /// Adding the rest of ciiexamen settings, spreeading all them into this fieldset
    /// or adding more fieldsets ('header' elements) if needed for better logic
      //  $mform->addElement('static', 'label1', 'ciiexamensetting1', 'Your ciiexamen fields go here. Replace me!');

        $mform->addElement('header', 'ciiexamenfieldset', get_string('id_examen_pf', 'ciiexamen'));
        //$mform->addElement('static', 'label2', 'ciiexamensetting2', 'Your ciiexamen fields go here. Replace me!');

        //$mform->addElement('text', 'id_examen', get_string('id_examen','ciiexamen'), array('size'=>'24'));
        $displaylist=c2i_getexamens();
        if ($displaylist) {

	        $mform->addElement('select', 'id_examen', get_string('id_examen','ciiexamen'), $displaylist);

	        $mform->setType('id_examen', PARAM_TEXT);

	        $mform->addRule('id_examen', null, 'required', null, 'client');
            $mform->addHelpButton('id_examen', 'id_examen','ciiexamen');
        }
        else print_error ('err_connection_pf','ciiexamen',$CFG->wwwroot.'/course/view.php?id='.$COURSE->id,$CFG->adresse_plateforme);


        $typesexamen = array( 1 => get_string('positionnement','ciiexamen'), 2 => get_string('certification','ciiexamen'));

      //  $mform->addElement('select', 'type_examen', get_string('type_examen', 'ciiexamen'), $typesexamen);
      //  $mform->setDefault('type_examen', 1);

        $mform->addElement('selectyesno', 'auto_creation', get_string('cree_comptes_auto', 'ciiexamen'));
        $mform->setDefault('auto_creation', 1);

        $mform->addHelpButton('auto_creation','cree_comptes_auto', 'ciiexamen');

        $mform->addElement('selectyesno', 'synchro_grades', get_string('synchro_grades', 'ciiexamen'));
        $mform->setDefault('synchro_grades', 1);
        $mform->addHelpButton('synchro_grades','synchro_grades', 'ciiexamen');

  /// Open and close dates.


        $mform->addElement('date_time_selector', 'timeopen', get_string('quizopen', 'ciiexamen'), array('optional'=>true));
       // $mform->addHelpButton('timeopen', 'quizopen', 'quiz');
		$mform->setDefault('timeopen', time());

        $mform->addElement('date_time_selector', 'timeclose', get_string('quizclose', 'ciiexamen'), array('optional'=>true));
       // $mform->addHelpButton('timeclose','quizclose', 'quiz');
        $mform->setDefault('timeclose', time()+1*24*3600);

          //capital sinon pas traité dans le carnet de notes
          // on le cache car la norme C2I est sur 100
    $mform->addElement('hidden', 'grade');
     $mform->setDefault('grade',100);
    $mform->setType('grade', PARAM_INT);

//-------------------------------------------------------------------------------
        // add standard elements, common to all modules
      //   $this->standard_grading_coursemodule_elements();

        $this->standard_coursemodule_elements();

//-------------------------------------------------------------------------------


//-------------------------------------------------------------------------------
        // add standard buttons, common to all modules
        $this->add_action_buttons();

    }
}

?>
