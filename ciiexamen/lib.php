<?php
// $Id: lib.php 416 2010-10-04 11:03:16Z ppollet $

/**
 * Library of functions and constants for module ciiexamen
 * This file should have two well differenced parts:
 *   - All the core Moodle functions, neeeded to allow
 *     the module to work integrated in Moodle.
 *   - All the ciiexamen specific functions, needed
 *     to implement all the module logic. Please, note
 *     that, if the module become complex and this lib
 *     grows a lot, it's HIGHLY recommended to move all
 *     these module specific functions to a new php file,
 *     called "locallib.php" (see forum, quiz...). This will
 *     help to save some memory when Moodle is performing
 *     actions across all modules.
 */

/// (replace ciiexamen with the name of your module and delete this line)

require_once (dirname(__FILE__) . '/locallib.php');
require_once (dirname(__FILE__) . '/wslib.php');

if (!$CFG->wspp_using_moodle20)
    define('CIIEXAMEN_POPUP_OPTIONS', 'scrollbars=yes,resizable=yes,width=800,height=600');
else
    define('CIIEXAMEN_POPUP_OPTIONS', 'scrollbars=yes&resizable=yes&width=800&height=600');

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $ciiexamen An object from the form in mod_form.php
 * @return int The id of the newly inserted ciiexamen record
 */
function ciiexamen_add_instance($ciiexamen) {

    $ciiexamen->timecreated = time();
    $ciiexamen->grade = 100; //fixed

    # You may have to add extra stuff in here #

    if (!$ciiexamen->id = ws_insert_record('ciiexamen', $ciiexamen))
        return false;

    // Do the processing required after an add or an update.
    ciiexamen_after_add_or_update($ciiexamen);
    return $ciiexamen->id;

}

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $ciiexamen An object from the form in mod_form.php
 * @return boolean Success/Fail
 */
function ciiexamen_update_instance($ciiexamen) {

    $ciiexamen->timemodified = time();
    $ciiexamen->id = $ciiexamen->instance;

    # You may have to add extra stuff in here #

    if (!ws_update_record('ciiexamen', $ciiexamen))
        return false;
    // Do the processing required after an add or an update.
    ciiexamen_after_add_or_update($ciiexamen);
    return true;
}

/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function ciiexamen_delete_instance($id) {

    if (!$ciiexamen = ws_get_record('ciiexamen', 'id', $id)) {
        return false;
    }

    # Delete any dependent records here #

    if (!ws_delete_records('ciiexamen', 'id', $ciiexamen->id))
        return false;

    ws_delete_records('event', 'modulename', 'ciiexamen', 'instance', $ciiexamen->id);
    ciiexamen_grade_item_delete($ciiexamen);

    return true;
}

/**
 * Return a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.  (voir rapport d'activité dans le profil d'un compte)
 * $return->time = the time they did it
 * $return->info = a short text description
 *
 * @return null
 * @todo Finish documenting this function
 * ajout rev 283 (similaire a mod/quiz/lib.php)
 */
function ciiexamen_user_outline($course, $user, $mod, $ciiexamen) {
    global $CFG;
    require_once ("$CFG->libdir/gradelib.php");
    $grades = grade_get_grades($course->id, 'mod', 'ciiexamen', $ciiexamen->id, $user->id);
    //print_r($grades);
    if (empty ($grades->items[0]->grades)) {
        return null;
    } else {
        $grade = reset($grades->items[0]->grades);
    }

    $result = new stdClass;
    $result->info = get_string('grade') . ': ' . $grade->str_long_grade;
    $result->time = $grade->dategraded;
    return $result;
}

/**
 * Print a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 *
 * @return boolean
 * @todo Finish documenting this function
 */
function ciiexamen_user_complete($course, $user, $mod, $ciiexamen) {
    return true;
}

/**
 * Returns all quiz graded users since a given time for specified ciiexamen
 * cette fonction doit retourne ce qui sera imprimé par ciiexamen_get_recent_mod_activity
 * Appelée par le rapport d'activité recent du cours
 */
function ciiexamen_get_recent_mod_activity(& $activities, & $index, $timestart, $courseid, $cmid, $userid = 0, $groupid = 0) {
    global $CFG, $COURSE, $USER;

    if ($COURSE->id == $courseid) {
        $course = $COURSE;
    } else {
        $course = ws_get_record('course', 'id', $courseid);
    }

    $modinfo = & get_fast_modinfo($course);

    $cm = $modinfo->cms[$cmid];

    //retrouver le code national de l'examen via son id d'instance recu de Moodle
    if (!$ciiexamen = ws_get_record('ciiexamen', 'id', $cm->instance))
        return;

    $attempts = null;
    //TODO interroger la PF pour le passage recent de cet examen ...

    $attempts = c2i_get_passages_recents($ciiexamen->id_examen, $timestart);

    /**
     * renvoie un tableau de passages (noteRecord)
     * stdClass Object ( [login] => sabadie [numetudiant] => 2921418 [score] => 0 [date] => 1257444411 [ip] => 127.0.0.1 [origine] => simulation )
     */
    //print_r($attempts);
    //return;

    if (!$attempts)
        return;

    $cm_context = get_context_instance(CONTEXT_MODULE, $cm->id);
    $grader = has_capability('moodle/grade:viewall', $cm_context);
    $accessallgroups = has_capability('moodle/site:accessallgroups', $cm_context);
    $viewfullnames = has_capability('moodle/site:viewfullnames', $cm_context);
    $grader = has_capability('mod/quiz:grade', $cm_context);
    $groupmode = groups_get_activity_groupmode($cm, $course);

    if (is_null($modinfo->groups)) {
        $modinfo->groups = groups_get_user_groups($course->id); // load all my groups and cache it in modinfo
    }

    $aname = format_string($cm->name, true);
    foreach ($attempts as $attempt) {
        //connu de Moodle ?
        if (!$user = ws_get_record('user', 'username', $attempt->login))
            continue;

        //moodle demande pour un utilisateur
        if ($userid && $user->id != $userid)
            continue;

        // moodle demande pour un groupe
        if ($groupid && !groups_is_member($groupid, $user->id))
            continue;

        $attempt->userid = $user->id;

        if ($attempt->userid != $USER->id) {
            if (!$grader) {
                // grade permission required
                continue;
            }

            if ($groupmode == SEPARATEGROUPS and !$accessallgroups) {
                $usersgroups = groups_get_all_groups($course->id, $attempt->userid, $cm->groupingid);
                if (!is_array($usersgroups)) {
                    continue;
                }
                $usersgroups = array_keys($usersgroups);
                $interset = array_intersect($usersgroups, $modinfo->groups[$cm->id]);
                if (empty ($intersect)) {
                    continue;
                }
            }
        }

        $tmpactivity = new object();

        $tmpactivity->type = 'ciiexamen';
        $tmpactivity->cmid = $cm->id;
        $tmpactivity->name = $aname;
        $tmpactivity->sectionnum = $cm->sectionnum;
        $tmpactivity->timestamp = $attempt->date;

        $tmpactivity->content = $attempt;

        $tmpactivity->user->userid = $attempt->userid;
        $tmpactivity->user->fullname = fullname($user, $viewfullnames);
        $tmpactivity->user->picture = $user->picture;

        $activities[$index++] = $tmpactivity;
    }

    return;
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in ciiexamen activities and print it out.
 * Return true if there was output, or false is there was none.
 *
 * @return boolean
 * affiche comme il faut ce qui a ete retourné par ciiexamen_get_recent_mod_activity
 */
function ciiexamen_print_recent_mod_activity($activity, $courseid, $detail, $modnames) {

    //return false;  //  True if anything was printed, otherwise false
    global $CFG;

    $strpreview = get_string('voir_details', 'ciiexamen');

    echo '<table border="0" cellpadding="3" cellspacing="0" class="forum-recent">';

    echo "<tr><td class=\"userpicture\" valign=\"top\">";
    print_user_picture($activity->user->userid, $courseid, $activity->user->picture);
    echo "</td><td>";

    if ($detail) {
        $modname = $modnames[$activity->type];
        echo '<div class="title">';
        echo "<img src=\"$CFG->modpixpath/{$activity->type}/icon.gif\" " .
        "class=\"icon\" alt=\"$modname\" />";
        echo "<a href=\"$CFG->wwwroot/mod/ciiexamen/view.php?id={$activity->cmid}\">{$activity->name}</a>";
        echo '</div>';
    }

    echo '<div class="grade">';
    echo get_string("passage", "ciiexamen") . " {$activity->content->ip }:{$activity->content->origine } ";
    echo get_string('score_global', 'ciiexamen') . " : ";
    link_to_popup_window("/mod/ciiexamen/rapport.php?id={$activity->cmid}&amp;userid={$activity->user->userid}", 'voir_resultats', "<img src=\"$CFG->pixpath/t/preview.gif\" class=\"iconsmall\" alt=\"$strpreview\" />" .
    " <b>" . $activity->content->score . "</b>", 0, 0, $strpreview, POPUP_OPTIONS, false);

    echo '</div>';

    echo '<div class="user">';
    echo "<a href=\"$CFG->wwwroot/user/view.php?id={$activity->user->userid}&amp;course=$courseid\">" .
    "{$activity->user->fullname}</a> - " . userdate($activity->timestamp);
    echo '</div>';

    echo "</td></tr></table>";

    return;

}

/**
 * introduite rev 283 voir mod/quiz/lib.php
 * UTILISÉE PAR LES RAPPORTS D'ACTIVITES PAR MODULE
 * */
function ciiexamen_get_view_actions() {
    return array (
        'view',
        'view all',
        'report'
    );
}

/**
 * introduite rev 283 voir mod/quiz/lib.php
 */

function ciiexamen_get_post_actions() {
    return array (
        'attempt',
        'editquestions',
        'review',
        'submit'
    );
}

/**
 * Function to be run periodically according to the moodle cron
 * This function searches for things that need to be done, such
 * as sending out mail, toggling flags etc ...
 *
 * @return boolean
 * @todo Finish documenting this function
 **/
function ciiexamen_cron() {
    global $CFG;

    /*pour toutes les instances
     *   recuperer les inscrits
     *      pour tous les inscrits
     *           creer un compte si nécessaire
     *           inscrire examen si nécessaire
     */
    //champs a envoyer à la PF
    if ($CFG->wspp_using_moodle20)
        $fields = 'u.id, u.username,u.idnumber,u.firstname, u.lastname, u.email,u.auth, u.password';
    else
        $fields = 'u.id, u.username,u.idnumber,u.firstname, u.lastname, u.email,u.auth, u.password,ra.hidden';

    $roleid = 5; //students  TODO get it from database
    mtrace("traitement des ciiexamens");
    $instances = ws_get_records('ciiexamen');
    foreach ($instances as $instance) {
        mtrace("traitement de examen " . $instance->id_examen);

        if ($instance->auto_creation) {

            if (!$inscrits = c2i_getinscrits($instance->id_examen)) {
                mtrace("erreur en lisant les inscrits à " . $instance->id_examen);
                //continue;
                $inscrits = array (); // aucun inscrit connu
            }
            $inscritslogins = array ();
            foreach ($inscrits as $inscrit) {
                $inscritslogins[$inscrit->login] = 1;
            }
            unset ($inscrits); //save memory

            if (!$cm = get_coursemodule_from_instance("ciiexamen", $instance->id, $instance->course)) {
                mtrace("Could not find course module for ciiexamen id $instance->id");
                continue;
            }
            // print_r($cm);

            /*
             * stdClass Object
             (
             [id] => 4160
             [course] => 109
             [module] => 27
             [instance] => 1
             [section] => 1454
             [idnumber] =>
             [added] => 1255293229
             [score] => 0
             [indent] => 0
             [visible] => 1
             [visibleold] => 1
             [groupmode] => 2
             [groupingid] => 4
             [groupmembersonly] => 1
             [name] => test positionnement
             [modname] => ciiexamen
             )

             */

            if ($context = get_context_instance(CONTEXT_COURSE, $instance->course)) {
                //print_r($instance);
                /// Get all existing participants in this context.
                // Why is this not done with get_users???
                if ($cm->groupingid == 0 || !$cm->groupmembersonly)
                    $contextusers = get_role_users($roleid, $context, false, $fields);
                else
                    $contextusers = groups_get_grouping_members($cm->groupingid);
                if (!$contextusers)
                    continue;

                mtrace(count($contextusers) . " concernés par cette instance de ciiexamen");
                //mtrace(print_r($contextusers,true));

                mtrace(count($inscritslogins) . " inscrits à cet examen");
                //mtrace(print_r($inscritslogins,true));

                //hidden roles do not exists anymore in Moodle 2.0
                if (!$CFG->wspp_using_moodle20) {
                    foreach ($contextusers as $id => $user) {
                        if (@ $user->hidden || !empty ($inscritslogins[$user->username]))
                            unset ($contextusers[$id]);
                    }
                } else {
                    foreach ($contextusers as $id => $user) {
                        if (!empty ($inscritslogins[$user->username]))
                            unset ($contextusers[$id]);
                    }
                }

                mtrace(count($contextusers) . " a inscrire sur la PF");

                $nb = 1;
                $sends = array ();
                $ainscrires = array ();
                foreach ($contextusers as $user) {
                    // rev 415 Oct. 2010
                    // get_roleusers ne renvoit pas deleted mais groups_get_grouping_members oui
                    // ce test permet de gérer le cas d'utilisateurs mal supprimés dans la table
                    // mdl_user
                    if (!empty ($user->deleted))
                        continue;
                    $send = new InscritInputRecord();
                    $send->setLogin($user->username);
                    $send->setNom($user->lastname);
                    $send->setPrenom($user->firstname);
                    $send->setEmail($user->email);
                    //important la plate-forme exige une N° d'étudiant
                    if (empty ($user->idnumber))
                        $user->idnumber = $user->username;
                    $send->setNumetudiant($user->idnumber);
                    $send->setPasswordmd5($user->password); // rev 948 PF C2I

                    if ($user->auth == 'cas' || $user->auth == 'ldap')
                        $send->setAuth('ldap');
                    else
                        $send->setAuth('manuel');
                    $sends[] = $send;
                    $ainscrires[] = $user->username;
                    $nb++;
                    //if ($nb >10) break;
                }
                print_r($ainscrires);
                print_r($sends);
                if (!empty ($sends)) {

                    if (!$tmp = c2i_creecandidats($sends)) {
                        mtrace("erreur en création des comptes");
                        continue;
                    } else {
                        foreach ($tmp as $r)
                            if ($r->error)
                                mtrace("erreur en création " .
                                $r->error);
                    }

                    unset ($tmp);
                    //print_r($ainscrires);
                    $tmp = c2i_inscritcandidats($ainscrires, $instance->id_examen);
                    unset ($ainscrires);
                    if (!$tmp) {
                        mtrace("erreur en inscrivant les candidats");
                        continue;
                    }
                    //print_r($tmp);
                    unset ($tmp);

                }
                unset ($inscritslogins);
                unset ($contextusers);
            } else
                mtrace("pas de synchro des inscriptions pour " . $instance->id_examen);
        }
        //etape II synchro du carnet de notes
        if ($instance->synchro_grades) {
            mtrace("synchro des notes de " . $instance->id_examen);
            ciiexamen_update_grades($instance);
        } else
            mtrace("pas de synchro des notes pour " . $instance->id_examen);

    }

    return true;
}

/**
 * Must return an array of user records (all data) who are participants
 * for a given instance of ciiexamen. Must include every user involved
 * in the instance, independient of his role (student, teacher, admin...)
 * See other modules as example.
 *
 * @param int $ciiexamenid ID of an instance of this module
 * @return mixed boolean/array of students
 * ajouté rev 283
 * fonction utilisée par les backups apparemment
 */
function ciiexamen_get_participants($ciiexamenid) {

    // rev 297 (avaait oublié de rechercher l'id national !)
    if (!$ciiexamen = ws_get_record('ciiexamen', 'id', intval($ciiexamenid)))
        return false;

    //liste inscrits sur la PF a cet examen
    if (!$inscrits = c2i_getinscrits($ciiexamen->id_examen))
        return false;
    $ret = array ();
    foreach ($inscrits as $inscrit) {
        //pour chacun, si connu de Moodle ajouter
        if ($user = ws_get_record('user', 'username', $inscrit->login))
            $ret[$user->id] = $user;
    }
    return $ret;
}

/**
 * This function returns if a scale is being used by one ciiexamen
 * if it has support for grading and scales. Commented code should be
 * modified if necessary. See forum, glossary or journal modules
 * as reference.
 *
 * @param int $ciiexamenid ID of an instance of this module
 * @return mixed
 * @todo Finish documenting this function
 * utilisé aussi par backups
 */
function ciiexamen_scale_used($ciiexamenid, $scaleid) {
    return false;
}

/**
 * Checks if scale is being used by any instance of ciiexamen.
 * This function was added in 1.9
 *
 * This is used to find out if scale used anywhere
 * @param $scaleid int
 * @return boolean True if the scale is used by any ciiexamen
 */
function ciiexamen_scale_used_anywhere($scaleid) {
    return false;
}

/**
 * Execute post-install custom actions for the module
 * This function was added in 1.9
 *
 * @return boolean true if success, false on error
 */
function ciiexamen_install() {
    return true;
}

/**
 * Execute post-uninstall custom actions for the module
 * This function was added in 1.9
 *
 * @return boolean true if success, false on error
 */
function ciiexamen_uninstall() {
    return true;
}

/// la seule fonction requise par le gradebook moodle 1.8

/**
 * Must return an array of grades for a given instance of this module,
 * indexed by userid.  It also returns a maximum allowed grade.
 *
 * Example:
 *    $return->grades = array of grades;
 *    $return->maxgrade = maximum allowed grade;
 *
 *    return $return;
 *
 * @param int $gameid ID of an instance of this module
 * @return mixed Null or object with an array of grades and with the maximum grade
 *
 *
 * SEMBLE ETRE APPELEE par la restauration ...
 **/

function ciiexamen_grades($ciiexamenid) {
    /// Must return an array of grades, indexed by user, and a max grade.

    $ciiexamen = get_record('ciiexamen', 'id', intval($ciiexamenid));
    if (empty ($ciiexamen) || empty ($ciiexamen->grade)) {
        return NULL;
    }
    $return = new stdClass;
    $res = c2i_getresultats($ciiexamen->id_examen);
    // print_r($res);
    if (!$res)
        return false; //pas de notes
    $rets = array ();

    foreach ($res as $r) {
        //existe bien dans Moodle
        if ($user = ws_get_record('user', 'username', $r->login, 'deleted', 0)) {
            $ret = new StdClass();
            $ret->userid = $user->id;
            $ret->rawgrade = $r->score;
            $ret->dategraded = $ret->datesubmitted = $r->date;
            //pour l'instant on ignore les details par domaine ...'
            $rets[$user->id] = $ret;
        }
    }
    $return->grades = $rets;
    $return->maxgrade = $ciiexamen->grade;
    //print_object($return,"grades");
    return $return;
}

/// grades fonctions requises par le gradebook moodle 1.9

/**
 * Return grade for given user or all users.
 * la vraie fonction !!!!
 *
 * @param int $quizid id of quiz
 * @param int $userid optional user id, 0 means all users
 * @return array array of grades, false if none
 */
function ciiexamen_get_user_grades($ciiexamen, $userid = 0) {
    global $CFG;
    //print "appel ".__FUNCTION__;
    /*
        $user = $userid ? "AND u.id = $userid" : "";

        $sql = "SELECT u.id, u.id AS userid, g.grade AS rawgrade, g.timemodified AS dategraded, MAX(a.timefinish) AS datesubmitted
                FROM {$CFG->prefix}user u, {$CFG->prefix}quiz_grades g, {$CFG->prefix}quiz_attempts a
                WHERE u.id = g.userid AND g.quiz = {$quiz->id} AND a.quiz = g.quiz AND u.id = a.userid
                      $user
                GROUP BY u.id, g.grade, g.timemodified";

        return get_records_sql($sql);
     */

    if (!$userid) {
        $res = c2i_getresultats($ciiexamen->id_examen);
        // print_r($res);
        if (!$res)
            return false; //pas de notes
        $rets = array ();

        if (!$cm = get_coursemodule_from_instance("ciiexamen", $ciiexamen->id, $ciiexamen->course)) {
            return false;
        }

        foreach ($res as $r) {
            //existe bien dans Moodle
            if ($user = ws_get_record('user', 'username', $r->login, 'deleted', 0)) {
                //filtrer le groupement ....
                //if ($cm->groupmembersonly)
                //	if (! groups_has_membership($cm,$user->id))
                if (!groups_course_module_visible($cm, $user->id))
                    continue;

                $ret = new StdClass();
                $ret->userid = $user->id;
                $ret->rawgrade = $r->score;
                $ret->dategraded = $ret->datesubmitted = $r->date;
                //pour l'instant on ignore les details par domaine ...'
                $rets[$user->id] = $ret;
            }
        }
        if (defined('FULLME') && FULLME == 'cron') {
            mtrace(count($rets) . " notes à synchroniser");
        }
        return $rets; //tableau indicé par les ids Moodle

    } else {
        if (!$user = get_record('user', 'id', $userid))
            return false;
        $res = c2i_getscores($user->username, $ciiexamen->id_examen);
        if (!$res || $res->error)
            return false; //pas de notes
        // conversion retour PF en element attendu par Moodle
        $ret = new StdClass();
        $ret->userid = $user->id;
        $ret->rawgrade = $res->score;
        $ret->dategraded = $ret->datesubmitted = $res->date;
        //pour l'instant on ignore les details par domaine ...'
        return array (
            $user->id => $ret
        );
    }
}

/**
 * Update grades in central gradebook
 * code apparemment toujours le meme (voir mod/quiz et mod/game)
 *
 * @param object $ciiexamen null means all ciiexamens
 * @param int $userid specific user only, 0 mean all
 */
function ciiexamen_update_grades($ciiexamen = null, $userid = 0, $nullifnone = true) {
    global $CFG;
    // print "appel ".__FUNCTION__;
    if (!function_exists('grade_update')) { //workaround for buggy PHP versions
        if (file_exists($CFG->libdir . '/gradelib.php')) {
            require_once ($CFG->libdir . '/gradelib.php');
        } else {
            return;
        }
    }

    if ($ciiexamen != null) {
        if ($grades = ciiexamen_get_user_grades($ciiexamen, $userid)) {
            ciiexamen_grade_item_update($ciiexamen, $grades);

        } else
            if ($userid and $nullifnone) {
                $grade = new object();
                $grade->userid = $userid;
                $grade->rawgrade = NULL;
                ciiexamen_grade_item_update($ciiexamen, $grade);

            } else {
                ciiexamen_grade_item_update($ciiexamen);
            }

    } else {
        $sql = "SELECT a.*, cm.idnumber as cmidnumber, a.course as courseid
                          FROM {$CFG->prefix}ciiexamen a, {$CFG->prefix}course_modules cm, {$CFG->prefix}modules m
                         WHERE m.name='ciiexamen' AND m.id=cm.module AND cm.instance=a.id";
        if ($rs = get_recordset_sql($sql)) {
            while ($ciiexamen = rs_fetch_next_record($rs)) {
                if ($ciiexamen->grade != 0) {
                    ciiexamen_update_grades($ciiexamen, 0, false);
                } else {
                    ciiexamen_grade_item_update($ciiexamen);
                }
            }
            rs_close($rs);
        }
    }
}

/**
 * Create grade item for given ciiexamen
 * code apparemment standard voir mod/quiz et mod/game
 *
 * @param object $ciiexamen object with extra cmidnumber
 * @param mixed optional array/object of grade(s); 'reset' means reset grades in gradebook
 * @return int 0 if ok, error code otherwise
 */
function ciiexamen_grade_item_update($ciiexamen, $grades = NULL) {
    //print "appel ".__FUNCTION__;
    global $CFG;
    if (!function_exists('grade_update')) { //workaround for buggy PHP versions
        if (file_exists($CFG->libdir . '/gradelib.php')) {
            require_once ($CFG->libdir . '/gradelib.php');
        } else {
            return;
        }
    }

    //  print_r($ciiexamen);

    if (array_key_exists('cmidnumber', $ciiexamen)) { //it may not be always present
        $params = array (
            'itemname' => $ciiexamen->name,
            'idnumber' => $ciiexamen->cmidnumber
        );
    } else {
        $params = array (
            'itemname' => $ciiexamen->name
        );
    }
    //tres important d'avoir un attribut grade dans la table mdl_ciiexamen (meme si fixe=100 !)
    //sinon pas noté '
    if ($ciiexamen->grade > 0) {
        $params['gradetype'] = GRADE_TYPE_VALUE;
        $params['grademax'] = $ciiexamen->grade;
        $params['grademin'] = 0;

    } else {
        $params['gradetype'] = GRADE_TYPE_NONE;
    }

    /* description by TJ:
    1/ If the ciiexamen is set to not show scores while the ciiexamen is still open, and is set to show scores after
       the ciiexamen is closed, then create the grade_item with a show-after date that is the ciiexamen close date.
    2/ If the ciiexamen is set to not show scores at either of those times, create the grade_item as hidden.
    3/ If the ciiexamen is set to show scores, create the grade_item visible.
    */
    /*
        if (!($ciiexamen->review & ciiexamen_REVIEW_SCORES & ciiexamen_REVIEW_CLOSED)
        and !($ciiexamen->review & ciiexamen_REVIEW_SCORES & ciiexamen_REVIEW_OPEN)) {
            $params['hidden'] = 1;

        } else if ( ($ciiexamen->review & ciiexamen_REVIEW_SCORES & ciiexamen_REVIEW_CLOSED)
               and !($ciiexamen->review & ciiexamen_REVIEW_SCORES & ciiexamen_REVIEW_OPEN)) {
            if ($ciiexamen->timeclose) {
                $params['hidden'] = $ciiexamen->timeclose;
            } else {
                $params['hidden'] = 1;
            }

        } else {
            // a) both open and closed enabled
            // b) open enabled, closed disabled - we can not "hide after", grades are kept visible even after closing
            $params['hidden'] = 0;
        }
    */
    if ($grades === 'reset') {
        $params['reset'] = true;
        $grades = NULL;
    }
    /*
        $gradebook_grades = grade_get_grades($ciiexamen->course, 'mod', 'ciiexamenid', $ciiexamen->id);
        $grade_item = $gradebook_grades->items[0];
        if ($grade_item->locked) {
            $confirm_regrade = optional_param('confirm_regrade', 0, PARAM_INT);
            if (!$confirm_regrade) {
                $message = get_string('gradeitemislocked', 'grades');
                $back_link = $CFG->wwwroot . '/mod/ciiexamen/report.php?q=' . $ciiexamen->id . '&amp;mode=overview';
                $regrade_link = qualified_me() . '&amp;confirm_regrade=1';
                print_box_start('generalbox', 'notice');
                echo '<p>'. $message .'</p>';
                echo '<div class="buttons">';
                print_single_button($regrade_link, null, get_string('regradeanyway', 'grades'), 'post', $CFG->framename);
                print_single_button($back_link,  null,  get_string('cancel'),  'post',  $CFG->framename);
                echo '</div>';
                print_box_end();

                return GRADE_UPDATE_ITEM_LOCKED;
            }
        }
    */
    return grade_update('mod/ciiexamen', $ciiexamen->course, 'mod', 'ciiexamen', $ciiexamen->id, 0, $grades, $params);
}

/**
 * Delete grade item for given ciiexamen
 *
 * @param object $ciiexamen object
 * @return object ciiexamen
 */
function ciiexamen_grade_item_delete($ciiexamen) {
    global $CFG;

    if (file_exists($CFG->libdir . '/gradelib.php')) {
        require_once ($CFG->libdir . '/gradelib.php');
    } else {
        return;
    }

    return grade_update('mod/ciiexamen', $ciiexamen->course, 'mod', 'ciiexamen', $ciiexamen->id, 0, NULL, array (
        'deleted' => 1
    ));
}

/**
 * Removes all grades from gradebook
 * called by ????
 * @param int $courseid
 * @param string optional type
 */
function ciiexamen_reset_gradebook($courseid, $type = '') {
    global $CFG;

    $sql = "SELECT l.*, cm.idnumber as cmidnumber, l.course as courseid
                  FROM {$CFG->prefix}ciiexamen l, {$CFG->prefix}course_modules cm, {$CFG->prefix}modules m
                 WHERE m.name='ciiexamen' AND m.id=cm.module AND cm.instance=l.id AND l.course=$courseid";

    if ($ciiexamens = get_records_sql($sql)) {
        foreach ($ciiexamens as $ciiexamen) {
            ciiexamen_grade_item_update($ciiexamen, 'reset');
        }
    }
}

/**
 * ajoutée revision  sept 2010
 */
function ciiexamen_reset_userdata($data) {
    global $CFG;
    $componentstr = get_string('modulenameplural', 'ciiexamen');
    $status = array ();

    // remove all grades from gradebook
    if (empty ($data->reset_gradebook_grades)) {
        $status[] = array (
            'component' => $componentstr,
            'item' => get_string('gradesdeleted', 'quiz'),
            'error' => false
        );
        ciiexamen_reset_gradebook($data->courseid);
    }

    return $status;
}

//////////////////////////////////////////////////////////////////////////////////////
/// Any other ciiexamen functions go here.  Each of them must have a name that
/// starts with ciiexamen_
/// Remember (see note in first lines) that, if this section grows, it's HIGHLY
/// recommended to move all funcions below to a new "localib.php" file.

/**
 * This function is called at the end of ciiexamen_add_instance
 * and ciiexamen_update_instance, to do the common processing.
 *
 * @param object $ciiexamen the ciiexamen object.
 */
function ciiexamen_after_add_or_update($ciiexamen) {
    global $CFG;

    //calendrier
    if ($ciiexamen->timeopen) {
        $event = new object();

        if ($event->id = ws_get_field('event', 'id', 'modulename', 'ciiexamen', 'instance', $ciiexamen->id)) {

            $event->name = $ciiexamen->name;
            $event->description = $ciiexamen->intro;
            $event->timestart = $ciiexamen->timeopen;
            if ($ciiexamen->timeclose)
                $event->timeduration = $ciiexamen->timeclose - $ciiexamen->timeopen;
            else
                $event->timeduration = 0;

            update_event($event);
        } else {
            $event = new object();
            $event->name = $ciiexamen->name;
            $event->description = $ciiexamen->intro;
            $event->courseid = $ciiexamen->course;
            $event->groupid = 0;
            $event->userid = 0;
            $event->modulename = 'ciiexamen';
            $event->instance = $ciiexamen->id;
            $event->eventtype = 'open';
            $event->timestart = $ciiexamen->timeopen;
            if ($ciiexamen->timeclose)
                $event->timeduration = $ciiexamen->timeclose - $ciiexamen->timeopen;

            add_event($event);
        }
    } else {
        ws_delete_records('event', 'modulename', 'ciiexamen', 'instance', $ciiexamen->id);
    }

    //update related grade item
    if ($CFG->wspp_using_moodle20)
        ciiexamen_grade_item_update($ciiexamen);

    else
        ciiexamen_grade_item_update(stripslashes_recursive($ciiexamen));

}

function cii_examen_print_item_description($num, $label, $valeur) {

    $item =<<<EOI

	<div class="fitem clearfix">
	<div class="fitemtitle">
	  <label for "id_$num">$label :  </label>
	</div>
	<div class="felement ftext">
	  <span id="id_$num">$valeur</span>
	</div>
	</div>
EOI;

    print $item;
}

function ciiexamen_print_oui_non($num, $valeur) {
    if (empty ($valeur) || $valeur == "NON") {
        $checked_oui = "";
        $checked_non = "checked=\"checked\"";
    } else {
        $checked_non = "";
        $checked_oui = "checked=\"checked\"";
    }

    $oui = get_string('yes');
    $non = get_string('no');

    $cb =<<<EOF
    <input name="$num" type="radio" value="0" $checked_oui disabled="disabled"> $oui
     &nbsp;&nbsp;
    <input name="$num" type="radio" value="1" $checked_non disabled="disabled"> $non
EOF;
    return $cb;

}

function cii_examen_print_description($description) {
    //print_r($description);
    $description->auteur = "<a href='mailto:" . $description->auteur_mail . "'>$description->auteur</a>";

    $num = 1;
    print "<form class='mform'>";
    print "<fieldset>";
    print "<div class='fcontainer clearfix'>";

    cii_examen_print_item_description($num++, get_string('id_examen', 'ciiexamen'), $description->eid);
    cii_examen_print_item_description($num++, get_string('nom_examen', 'ciiexamen'), $description->nom_examen);
    cii_examen_print_item_description($num++, get_string('pos_examen', 'ciiexamen'), ciiexamen_print_oui_non($num, $description->positionnement));
    cii_examen_print_item_description($num++, get_string('cert_examen', 'ciiexamen'), ciiexamen_print_oui_non($num, $description->certification));

    cii_examen_print_item_description($num++, get_string('etab_examen', 'ciiexamen'), $description->id_etab);
    cii_examen_print_item_description($num++, get_string('auteur_examen', 'ciiexamen'), $description->auteur);
    cii_examen_print_item_description($num++, get_string('datecreation_examen', 'ciiexamen'), userdate($description->ts_datecreation));
    cii_examen_print_item_description($num++, get_string('datemodif_examen', 'ciiexamen'), userdate($description->ts_datemodification));

    cii_examen_print_item_description($num++, get_string('datedebut_examen', 'ciiexamen'), userdate($description->ts_datedebut));
    cii_examen_print_item_description($num++, get_string('datefin_examen', 'ciiexamen'), userdate($description->ts_datefin));

    cii_examen_print_item_description($num++, get_string('tirage_examen', 'ciiexamen'), $description->type_tirage);

    cii_examen_print_item_description($num++, get_string('ordreq_examen', 'ciiexamen'), $description->ordre_q);
    cii_examen_print_item_description($num++, get_string('ordrer_examen', 'ciiexamen'), $description->ordre_r);

    cii_examen_print_item_description($num++, get_string('mdp_examen', 'ciiexamen'), ciiexamen_print_oui_non($num, $description->mot_de_passe));
    cii_examen_print_item_description($num++, get_string('cor_examen', 'ciiexamen'), ciiexamen_print_oui_non($num, $description->correction));
    cii_examen_print_item_description($num++, get_string('mail_examen', 'ciiexamen'), ciiexamen_print_oui_non($num, $description->envoi_resultat));
    cii_examen_print_item_description($num++, get_string('chrono_examen', 'ciiexamen'), ciiexamen_print_oui_non($num, $description->correction));
    print "</div>";
    print "</fieldset>";
    print "</form>";

}

/**
 * Moodle 2.0 required !!!
 * @param string $feature FEATURE_xx constant for requested feature
 * @return bool True if quiz supports feature
 */
function ciiexamen_supports($feature) {
    switch ($feature) {
        case FEATURE_GROUPS :
            return true;
        case FEATURE_GROUPINGS :
            return true;
        case FEATURE_GROUPMEMBERSONLY :
            return true;
        case FEATURE_MOD_INTRO :
            return true;
            // case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        case FEATURE_GRADE_HAS_GRADE :
            return true;
        case FEATURE_GRADE_OUTCOMES :
            return true;
            // case FEATURE_BACKUP_MOODLE2:          return true;

        default :
            return null;
    }
}

if (0) {
    $ciiexamen = get_record('ciiexamen', 'id', 1);
    print_r(ciiexamen_get_user_grades($ciiexamen));
}
?>
