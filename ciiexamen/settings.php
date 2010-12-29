<?php
/**
 * @author Patrick Pollet
 * @version $Id: settings.php 282 2009-11-12 07:44:41Z ppollet $
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package c2ipf
 */

require_once($CFG->dirroot.'/mod/ciiexamen/lib.php');



$settings->add(new admin_setting_configtext('adresse_plateforme', get_string('adresse_plateforme', 'ciiexamen'),
                   get_string('configadresse_plateforme', 'ciiexamen'), 'http://localhost/c2i/V1.5/'));

$settings->add(new admin_setting_configtext('login_plateforme', get_string('login_plateforme', 'ciiexamen'),
                   get_string('configlogin_plateforme', 'ciiexamen'), '' ));

$settings->add( new admin_setting_configpasswordunmask('passe_plateforme', get_string('passe_plateforme', 'ciiexamen'),
                   get_string('configpasse_plateforme', 'ciiexamen'), '' ));

$settings->add(new admin_setting_configcheckbox('inclure_certification',
                   get_string('inclure_certification','ciiexamen'),
                   get_string('config_inclure_certification','ciiexamen'), 0));
?>
