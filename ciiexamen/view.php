<?php

// $Id: view.php 325 2010-01-26 09:13:12Z ppollet $

/**
 * This page prints a particular instance of ciiexamen
 *
 * @author  Your Name <pp@patrickpollet.net>
 * @version $Id: view.php 325 2010-01-26 09:13:12Z ppollet $
 * @package mod/ciiexamen
 */

/// (Replace ciiexamen with the name of your module and remove this line)

require_once (dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once (dirname(__FILE__) . '/lib.php');

$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$a = optional_param('a', 0, PARAM_INT); // ciiexamen instance ID
$currenttab = optional_param("ct", "info", PARAM_TEXT);

if ($id) {
    if (!$cm = get_coursemodule_from_id('ciiexamen', $id)) {
        error('Course Module ID was incorrect');
    }

    if (!$course = ws_get_record('course', 'id', $cm->course)) {
        error('Course is misconfigured');
    }

    if (!$ciiexamen = ws_get_record('ciiexamen', 'id', $cm->instance)) {
        error('Course module is incorrect');
    }

} else
    if ($a) {
        if (!$ciiexamen = ws_get_record('ciiexamen', 'id', $a)) {
            error('Course module is incorrect');
        }
        if (!$course = ws_get_record('course', 'id', $ciiexamen->course)) {
            error('Course is misconfigured');
        }
        if (!$cm = get_coursemodule_from_instance('ciiexamen', $ciiexamen->id, $course->id)) {
            error('Course Module ID was incorrect');
        }

    } else {
        error('You must specify a course_module ID or an instance ID');
    }

require_login($course, true, $cm);

$context = get_context_instance(CONTEXT_MODULE, $cm->id);
require_capability('mod/quiz:view', $context);

add_to_log($course->id, "ciiexamen", "view", "view.php?id={$cm->id}", $ciiexamen->id, $cm->id);

//accès web service pour récuperer les détails de l'examen '
if (!$ciidetails = c2i_getexamen($ciiexamen->id_examen))
    //error(get_string('err_examunknown','ciiexamen'));
    print_error('err_examunknown', 'ciiexamen', $CFG->wwwroot . '/course/view.php?id=' . $course->id, $ciiexamen->id_examen . "@" . $CFG->adresse_plateforme);
$ciiresultats = c2i_getscores($USER->username /*'wsdemo1'*/
, $ciiexamen->id_examen);

//Moodle 1.9
if (!$CFG->wspp_using_moodle20) {

    require_js($CFG->wwwroot . "/mod/ciiexamen/javascript.js");

    /// Print the page header
    $strciiexamens = get_string('modulenameplural', 'ciiexamen');
    $strciiexamen = get_string('modulename', 'ciiexamen');

    $navlinks = array ();
    $navlinks[] = array (
        'name' => $strciiexamens,
        'link' => "index.php?id=$course->id",
        'type' => 'activity'
    );
    $navlinks[] = array (
        'name' => format_string($ciiexamen->name),
        'link' => '',
        'type' => 'activityinstance'
    );
    $navigation = build_navigation($navlinks);
    print_header_simple(format_string($ciiexamen->name), '', $navigation, '', '', true, update_module_button($cm->id, $course->id, $strciiexamen), navmenu($course, $cm));
    /// Print the main part of the page
    print_heading(format_string($ciiexamen->name));
    print_container_start();
    include ('tabs.php');

    switch ($currenttab) {
        case 'info' :

            if (c2i_est_inscrit_examen($USER->username, $ciiexamen->id_examen)) {
                if ($ciiresultats->error) {
                    if ($ciidetails->ts_datedebut <= time() && $ciidetails->ts_datefin >= time()) {
                        // direct link to the target exam. Requires C2I PF rev >=978
                        $params='?id_examen='.$ciidetails->id_examen.'&amp;id_etab='.$ciidetails->id_etab;
                        $pf = $ciidetails->positionnement=='OUI'?'positionnement':'certification';
                        $pf =$pf.'.php'.$params;
                        //$link ="javascript:openPopup2(\"".$CFG->adresse_plateforme."/positionnement.php\",\"passage\",800,600);";
                        $link ="javascript:openPopup2(\"".$CFG->adresse_plateforme."/$pf\",\"passage\",800,600);";
                        print_heading(get_string('err_examen_paspasse', 'ciiexamen', $link));
                    } else {
                        print_heading(get_string('err_examen_pasdispo', 'ciiexamen'));
                    }
                } else
                    if ($ciidetails->ts_datedebut >= time() || $ciidetails->ts_datefin <= time())
                        print_heading(get_string('err_examen_pasdispo', 'ciiexamen'));

            } else
                print_heading(get_string('err_examen_pasinscrit', 'ciiexamen'));

            cii_examen_print_description($ciidetails);

            break;

        case 'score' :
            if (!$ciiresultats->error)
                print (c2i_getresultats_examen_html($USER->username, $ciiexamen->id_examen));
            break;
        case 'corrige' :
            if ($ciidetails->correction)
                if (!$ciiresultats->error)
                    print (c2i_getcorrige_examen_html($USER->username, $ciiexamen->id_examen));
                else
                    if (has_capability('mod/quiz:viewreports', $context))
                        print (c2i_getcorrige_examen_html('', $ciiexamen->id_examen));

            break;
        case 'parcours' :
            print (c2i_getparcours_examen_html($USER->username, $ciiexamen->id_examen));
            break;
    }

    /// Finish the page
    print_container_end();
    print_footer($course);

    //Moodle 2.0

} else {

    /// Initialize $PAGE, compute blocks
    $PAGE->set_url('/mod/ciiexamen/view.php', array (
        'id' => $cm->id
    ));
    $title = get_string('modulename', 'ciiexamen') . ' : ' . format_string($ciiexamen->name);
    $PAGE->set_context($context);
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
  // require_js($CFG->wwwroot . "/mod/ciiexamen/javascript.js");
  // no deprecated warning plz !!!!
  $lib=$CFG->wwwroot . "/mod/ciiexamen/javascript.js";
  //if ($PAGE->requires->is_head_done()) {
  //          echo html_writer::script('', $lib);
   //     } else {
            $PAGE->requires->js(new moodle_url($lib));
    //    }
    echo $OUTPUT->header();

    include ('tabs.php');

   // print_r($USER);

    switch ($currenttab) {
        case 'info' :
            if (c2i_est_inscrit_examen($USER->username, $ciiexamen->id_examen)) {
                if ($ciiresultats->error) {
                    if ($ciidetails->ts_datedebut <= time() && $ciidetails->ts_datefin >= time()) {
                        //TODO un vrai popup
                        // direct link to the target exam. Requires C2I PF rev >=978
                        $params='?id_examen='.$ciidetails->id_examen.'&amp;id_etab='.$ciidetails->id_etab;
                        $pf = $ciidetails->positionnement=='OUI'?'positionnement':'certification';
                        $pf =$pf.'.php'.$params;
                        //$link ="javascript:openPopup2(\"".$CFG->adresse_plateforme."/positionnement.php\",\"passage\",800,600);";

                        /*
                         * methode officielle a voir http://moodle.org/mod/forum/discuss.php?d=163522#p720907
                         */

                        $link ="javascript:openPopup2(\"".$CFG->adresse_plateforme."/$pf\",\"passage\",800,600);";
                        echo ($OUTPUT->heading(get_string('err_examen_paspasse', 'ciiexamen', $link)));
                    } else {
                        echo ($OUTPUT->heading(get_string('err_examen_pasdispo', 'ciiexamen')));

                    }
                } else
                    if ($ciidetails->ts_datedebut >= time() || $ciidetails->ts_datefin <= time())
                        echo ($OUTPUT->heading(get_string('err_examen_pasdispo', 'ciiexamen')));

            } else
                echo ($OUTPUT->heading(get_string('err_examen_pasinscrit', 'ciiexamen')));

            cii_examen_print_description($ciidetails);

            break;

        case 'score' :
            if (!$ciiresultats->error)
                print (c2i_getresultats_examen_html($USER->username, $ciiexamen->id_examen));
            break;
        case 'corrige' :
            if ($ciidetails->correction)
                if (!$ciiresultats->error)
                    print (c2i_getcorrige_examen_html($USER->username, $ciiexamen->id_examen));
                else
                    if (has_capability('mod/quiz:viewreports', $context))
                        print (c2i_getcorrige_examen_html('', $ciiexamen->id_examen));

            break;
        case 'parcours' :
            print (c2i_getparcours_examen_html($USER->username, $ciiexamen->id_examen));
            break;
    }

    echo $OUTPUT->footer();

}
?>
