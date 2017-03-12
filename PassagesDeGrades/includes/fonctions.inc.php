<?php

/*
** Function    : getCeinture
** Input      : $adherent['dyn'][4][1]
** Output      : @string $ceinture (url du png)
** Description    : $ceinture (url du png)
** Creator    : Fr�d�ric LASSAVE
** Date        : 28/02/2017
*/ 

function getCeinture($grade)
{
		if ($grade == 'Blanche') {
			$ceinture = "templates/default/images/ceinture_blanche.png";
		} elseif ($grade == 'Blanche 1 liser�') {
			$ceinture = "templates/default/images/ceinture_blanche_1_liser�.png";
		} elseif ($grade == 'Blanche 2 liser�s') {
			$ceinture = "templates/default/images/ceinture_blanche_2_liser�s.png";
		}elseif ($grade == 'Blanche/Jaune') {
			$ceinture = "templates/default/images/Ceinture_blanc_jaune.png";
		} elseif ($grade == 'Jaune') {
			$ceinture = "templates/default/images/Ceinture_jaune.png";
		} elseif ($grade == 'Jaune/Orange') {
			$ceinture = "templates/default/images/jaune_orange.png";
		} elseif ($grade == 'Orange') {
			$ceinture = "templates/default/images/ceinture_orange.png";
		} elseif ($grade == 'Orange/Verte') {
			$ceinture = "templates/default/images/Ceinture_orange_verte.png";
		} elseif ($grade == 'Verte') {
			$ceinture = "templates/default/images/Ceinture_verte.png";
		} elseif ($grade == 'Verte/Bleu') {
			$ceinture = "templates/default/images/07verte_bleue.png";
		} elseif ($grade == 'Bleu') {
			$ceinture = "templates/default/images/Ceinture_bleue.png";
		} elseif ($grade == 'Bleu/Marron') {
			$ceinture = "templates/default/images/800px-ceinture-bleue-marron.png";
		} elseif ($grade == 'Violet') {
			$ceinture = "templates/default/images/Ceinture_violette.png";
		} elseif ($grade == 'Marron') {
			$ceinture = "templates/default/images/ceinture_marron.png";
		} elseif ($grade == 'Noire (1er DAN)' OR $grade == 'Noire (2eme DAN)' OR $grade == 'Noire (3eme DAN)') {
			$ceinture = "templates/default/images/ceinture_noire.png";
		} else {
			$ceinture = "templates/default/images/icon-warning.png";
		}
		
		return $ceinture;
}

/*
** Function    : array_sort
** Input      : $array, $on ('colonne'), $order= SORT_ASC ou SORT_DESC
** Output      : @array 
** Description    : $array tri� sur le champ $on, selon $order
** Creator    : Fr�d�ric LASSAVE
** Date        : 28/02/2017
*/ 

function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
?> 