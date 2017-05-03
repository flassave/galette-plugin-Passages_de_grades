<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Configuration file for PassagesDeGrades plugin
 *
 * PHP version 5
 *
 * Copyright © 2013 The Galette Team
 *
 * This file is part of Galette (http://galette.eu).
 *
 * Galette is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Galette is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Galette. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Plugins
 * @package   PassagesDeGrades
 *
 * @author    Frédéric LASSAVE <f.lassave@free.fr>
 * @copyright 2011 The Galette Team
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or later
 * @version   SVN: $Id$
 * @link      http://galette.eu
 * @since     Available since 0.8.2.3
 */

use GaletteGrades\Notes;
use Galette\Entity\Adherent;
use Galette\Entity\Texts;
use Galette\Repository\Members;
use Galette\Repository\PdfModels;
use Galette\Filters\MembersList;
use Galette\Filters\AdvancedMembersList;
use Galette\Entity\DynamicFields;


define('GALETTE_BASE_PATH', '../../');
define('PassagesDeGrades_PREFIX', 'plugins|PassagesDeGrades');

require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Constants and classes from plugin
require_once '_config.inc.php';

//Chargement des fonctions
include("includes/fonctions.inc.php");

//Vérification isLogged
if ( !$login->isLogged() ) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

$filters = new MembersList();

//Contrôle check box ET bouton DELETE
if (isset($_POST['delete']) AND isset($_POST['member_sel'])) {
	foreach($_POST['member_sel'] as $del){
		$id = (int)$del;
		$dels = new GaletteGrades\Notes($id);
		$dels->remove();
	}
}

//Appui bouton CSV
if ( isset($_POST['csv']) ) {
        $qstring = 'NotesUVs_export.php';
        header('location: '.$qstring);
        die();
}

$deps = array(
    'picture'   => true,
    'groups'    => true,
    'dues'      => true,
    'parent'    => true,
    'children'  => true
);

$pdg = new Notes();
$alns = $pdg->getAllNotes();
$nb_members = $pdg->getNombreEleves();
$allnote = array ();
$notes = array();
$mg = 0;
$dyn_fields = new DynamicFields();

foreach ($alns as $key => $val){
	
	$m = new Adherent((int)$val[id_adh], $deps);
	
	$notes['id_adh'] = $val[id_adh];
	$notes['sname'] = $m->sname;
	$notes['age'] = '';
    if (method_exists($m, 'getAge')) {
        $notes['age'] = $m->getAge();
    } else {
        if ($m->birthdate != null) {
            $d = \DateTime::createFromFormat('Y-m-d', $m->birthdate);
            if ($d !== false) {
                $notes['age'] = str_replace(
                    '%age',
                    $d->diff(new \DateTime())->y,
                    _T(' (%age years old)')
                );
            }
        }
    }

    // declare dynamic field values
    $adherent['dyn'] = $dyn_fields->getFields('adh', $alns[$key][id_adh], true);

	$notes['grade'] = $adherent['dyn'][4][1];
	$notes['barrettes'] = $adherent['dyn'][35][1];
	
	$ceinture = getCeinture($adherent['dyn'][4][1]);
	
	$notes['ceinture'] = $ceinture;	
	$notes['uv1'] = $val['uv1'];
	$notes['uv2'] = $val['uv2'];
	$notes['uv3'] = $val['uv3'];
	$notes['uv4'] = $val['uv4'];
	$notes['uv5'] = $val['uv5'];
	$notes['uv6'] = $val['uv6'];
	$notes['moy'] = round((($val['uv1'] + $val['uv2'] + $val['uv3'] + $val['uv4'] + $val['uv5'] + $val['uv6'])/6), 2);
	
	$mg = ($mg + $notes['moy']);
	$allnote[] = $notes;
}

//Moyenne Générale
$mgle = 0;
if ($nb_members > 0) {
    $mgle = round(($mg / $nb_members), 2);
}

//Filtres affichages 
$filter = array();
if (isset($_GET['tri'])){
	$filter['tri'] = $_GET['tri'];
	$filter['order'] = $_GET['order'];
	if ($_GET['order'] == 'SORT_ASC'){
		$allnotes = array_sort($allnote, $_GET['tri'], SORT_ASC);
		$filter['to'] = 'SORT_DESC';
	} else {
		$allnotes = array_sort($allnote, $_GET['tri'], SORT_DESC);
		$filter['to'] = 'SORT_ASC';
	}
} else {
	$allnotes = array_sort($allnote, 'sname');
	$filter['tri'] = 'sname';
	$filter['order'] = 'SORT_ASC';
	$filter['to'] = 'SORT_DESC';
}

//Titre du Template
$tpl->assign('page_title', _T("Notes Passage de Grades"));

//Assignation des variables
$tpl->assign('nb_members', $nb_members);
$tpl->assign('allnotes', $allnotes);
$tpl->assign('filter', $filter);
$tpl->assign('mgle', $mgle);

//Set the path to the current plugin's templates,
//but backup main Galette's template path before
$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;

$content = $tpl->fetch('NotesUVs.tpl', PASSAGESDEGRADES_SMARTY_PREFIX);
$tpl->assign('content', $content);

//Set path to main Galette's template
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', PASSAGESDEGRADES_SMARTY_PREFIX);
