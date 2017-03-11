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

use Galette\Entity\Adherent;
use Galette\Entity\FieldsConfig;
use Galette\Entity\Texts;
use Galette\Repository\Members;
use Galette\Repository\PdfModels;
use Galette\Entity\DynamicFields;


define('GALETTE_BASE_PATH', '../../');
define('PassagesDeGrades_PREFIX', 'plugins|PassagesDeGrades');

require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Constants and classes from plugin
require_once '_config.inc.php';

//Chargement des fonctions
include("includes/fonctions.inc.php");

$id_adh = get_numeric_form_value('id_adh', '');
$dyn_fields = new DynamicFields();

$deps = array(
    'picture'   => true,
    'groups'    => true,
    'dues'      => true,
    'parent'    => true,
    'children'  => true
);
$member = new Adherent((int)$id_adh, $deps);

// flagging fields visibility
$fc = new FieldsConfig(Adherent::TABLE, $members_fields, $members_fields_cats);
$visibles = $fc->getVisibilities();
// declare dynamic field values
$adherent['dyn'] = $dyn_fields->getFields('adh', $id_adh, true);

// - declare dynamic fields for display
$disabled['dyn'] = array();
$dynamic_fields = $dyn_fields->prepareForDisplay(
    'adh',
    $adherent['dyn'],
    $disabled['dyn'],
    0
);

$id_m = $member->id;
$uv = new NotesPassagesDeGrades ((int)$id_adh);


//Age
$ageadh = $member->getage();

//Grade
$grade = $adherent['dyn'][4][1];
$barrettes = $adherent['dyn'][35][1];
$ceinture = getCeinture($adherent['dyn'][4][1]);
	
//Récupération des données du formulaire PassagesDeGrades.tpl
//Note UV1
if (isset($_POST['val_uv1']) OR isset($_POST['val_uv2']) OR isset($_POANDST['val_uv3']) OR isset($_POST['val_uv4']) OR isset($_POST['val_uv5']) OR isset($_POST['val_uv6'])){
	
	//On teste si la valeur est comprise entre 0 et 20
	if (isset($_POST['val_uv1'])){
		if ($_POST['val_uv1'] >= 0 AND $_POST['val_uv1'] <= 20)  {
			$uv->storeuv1((int) $_POST['val_uv1']);
		}
		else $test1 = ERR;
	}
	
	if (isset($_POST['val_uv2'])){
		if ($_POST['val_uv2'] >= 0 AND $_POST['val_uv2'] <= 20) {
			$uv->storeuv2((int) $_POST['val_uv2']);
		}
		else $test2 = ERR;
	}
	
	if (isset($_POST['val_uv3'])){
		if ($_POST['val_uv3'] >= 0 AND $_POST['val_uv3'] <= 20) {
			$uv->storeuv3((int) $_POST['val_uv3']);
		}
		else $test3 = ERR;
	}
	
	if (isset($_POST['val_uv4'])){
		if ($_POST['val_uv4'] >= 0 AND $_POST['val_uv4'] <= 20) {
			$uv->storeuv4((int) $_POST['val_uv4']);
		}
		else $test4 = ERR;
	}

	if (isset($_POST['val_uv5'])){
		if ($_POST['val_uv5'] >= 0 AND $_POST['val_uv5'] <= 20) {
			$uv->storeuv5((int) $_POST['val_uv5']);
		}
		else $test5 = ERR;
	}
	
	if (isset($_POST['val_uv6'])){
		if ($_POST['val_uv6'] >= 0 AND $_POST['val_uv6'] <= 20) {
			$uv->storeuv6((int) $_POST['val_uv6']);
		}
		else $test6 = ERR;
	}  
			
	$uv->majnotes();
}
	
//Notes
	$uv1 = $uv->getuv1();
	$uv2 = $uv->getuv2();
	$uv3 = $uv->getuv3();
	$uv4 = $uv->getuv4();
	$uv5 = $uv->getuv5();
	$uv6 = $uv->getuv6();
	
//Titre du Template
$tpl->assign('page_title', _T("Notes Passage de Grades"));

//Assignation des variables
$tpl->assign('id', $id_adh);
$tpl->assign('age', $ageadh);
$tpl->assign('member', $member);
$tpl->assign('grade', $grade);
$tpl->assign('barrettes', $barrettes);
$tpl->assign('ceinture', $ceinture);
$tpl->assign('uv1', $uv1);
$tpl->assign('uv2', $uv2);
$tpl->assign('uv3', $uv3);
$tpl->assign('uv4', $uv4);
$tpl->assign('uv5', $uv5);
$tpl->assign('uv6', $uv6);

//Set the path to the current plugin's templates,
//but backup main Galette's template path before
$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;

$content = $tpl->fetch('PassagesDeGrades.tpl', PASSAGESDEGRADES_SMARTY_PREFIX);
$tpl->assign('content', $content);

//Set path to main Galette's template
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', PASSAGESDEGRADES_SMARTY_PREFIX);

?>