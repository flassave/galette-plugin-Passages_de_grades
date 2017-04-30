<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Export and download an export file
 *
 * PHP version 5
 *
 * Copyright © 2013-2014 The Galette Team
 *
 * This file is part of Galette (http://galette.tuxfamily.org).
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

use Analog\Analog;
use Galette\IO\Csv;
use Galette\IO\CsvOut;
use Galette\Filters\MembersList;
use Galette\Entity\Adherent;
use Galette\Entity\Status;
use Galette\Entity\DynamicFields;
use Galette\Repository\Titles;
use Galette\Repository\Members;


define('GALETTE_BASE_PATH', '../../');
define('PassagesDeGrades_PREFIX', 'plugins|PassagesDeGrades');

require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Constants and classes from plugin
require_once '_config.inc.php';

//Chargement des fonctions
include("includes/fonctions.inc.php");

//Exports main contain user confidential data, they're accessible only for
//admins or staff members
if ( $login->isAdmin() || $login->isStaff() ) {
    $csv = new CsvOut();

    if ( isset($session['filters']['members'])
        && !isset($_POST['mailing'])
        && !isset($_POST['mailing_new'])
    ) {
        //CAUTION: this one may be simple or advanced, display must change
        $filters = unserialize($session['filters']['members']);
    } else {
        $filters = new MembersList();
    }

    $export_fields = null;
    if ( file_exists(GALETTE_CONFIG_PATH  . 'local_export_fields.inc.php') ) {
        include_once GALETTE_CONFIG_PATH  . 'local_export_fields.inc.php';
        $export_fields = $fields;
    }

$dyn_fields = new DynamicFields();

$deps = array(
    'picture'   => false,
    'groups'    => false,
    'dues'      => false,
    'parent'    => false,
    'children'  => false
);

$pdg = new GaletteGrades\Notes();
$alns = $pdg->getAllNotes();
$allnote = array ();
$notes = array();
$labels = array(
	'Nom complet',
	'Nom',
	'Prénom',
	'Age',
	'Date de naissance',
	'id_grade',
	'Grade',
	'id_barrettes',
	'Barrettes',
	'Note UV1',
	'Note UV2',
	'Note UV3',
	'Note UV4',
	'Note UV5',
	'Note UV6',
	'Moy.',
	'Licence',
);

foreach ($alns as $key => $val){
	
	$m = new Adherent((int)$val[id_adh], $deps);
	// declare dynamic field values
	$adherent['dyn'] = $dyn_fields->getFields('adh', $alns[$key][id_adh], true);

	$notes['sname'] = $m->sname;
	$notes['name'] = $m->name;
	$notes['surname'] = $m->surname;
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
	$notes['ddn'] = $m->birthdate;
	//id_grade
		$id_m = $m->id;
		$select1 = $zdb->select(DynamicFields::TABLE);
		$select1->where(array(field_id => 4, item_id => $id_m));
		$result1 = $zdb->execute($select1);
		$dfi = $result1->current();
		$df_val = $dfi->field_val;
		$notes['id_grade'] = $df_val;
		
	$notes['grade'] = $adherent['dyn'][4][1];
	
	//Barrettes
		$select2 = $zdb->select(DynamicFields::TABLE);
		$select2->where(array(field_id => 35, item_id => $id_m));
		$result2 = $zdb->execute($select2);
		$dfb = $result2->current();
		$dfb_val = $dfb->field_val;
		$notes['id_barrettes'] = $dfb_val;
	
	if ($adherent['dyn'][35][1] != "-" AND $adherent['dyn'][35][1] != ""){
		$notes['barrettes'] = $adherent['dyn'][35][1];
	} else {
		$notes['barrettes'] = "";
	}
		
	$ceinture = getCeinture($adherent['dyn'][4][1]);
	
//	$notes['ceinture'] = $ceinture;	
	$notes['uv1'] = $val['uv1'];
	$notes['uv2'] = $val['uv2'];
	$notes['uv3'] = $val['uv3'];
	$notes['uv4'] = $val['uv4'];
	$notes['uv5'] = $val['uv5'];
	$notes['uv6'] = $val['uv6'];
	$notes['moy'] = round((($val['uv1'] + $val['uv2'] + $val['uv3'] + $val['uv4'] + $val['uv5'] + $val['uv6'])/6), 2);
	$notes['licence'] = $adherent['dyn'][33][1];
	
	$allnote[] = $notes;
}

    $filename = 'NotesUVs_memberslist.csv';
    $filepath = CsvOut::DEFAULT_DIRECTORY . $filename;
    $fp = fopen($filepath, 'w');
    if ( $fp ) {
        $res = $csv->export(
            $allnote,
            Csv::DEFAULT_SEPARATOR,
            Csv::DEFAULT_QUOTE,
            $labels,
            $fp
        );
        fclose($fp);
        $written[] = array(
            'name' => $filename,
            'file' => $filepath
        );
    }

    if (file_exists(CsvOut::DEFAULT_DIRECTORY . $filename) ) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
		header('Pragma: no-cache');
		readfile(CsvOut::DEFAULT_DIRECTORY . $filename);
    } else {
        Analog::log(
            'A request has been made to get an exported file named `' .
            $filename .'` that does not exists.',
            Analog::WARNING
        );
        header('HTTP/1.0 404 Not Found');
    }
} else {
    Analog::log(
        'A non authorized person asked to retrieve exported file named `' .
        $filename . '`. Access has not been granted.',
        Analog::WARNING
    );
    header('HTTP/1.0 403 Forbidden');
}
