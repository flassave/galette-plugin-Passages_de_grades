<?php

/**
 * Public Class PassagesDeGrades
 * 
 *
 * PHP version 5
 *
 * Copyright © 2011 Mélissa Djebel
 *
 * This file is part of Galette (http://galette.tuxfamily.org).
 *
 * Plugin Pilote is distributed in the hope that it will be useful,
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
 * @copyright 2011 Mélissa Djebel
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or (at your option) any later version
 * @version   SVN: $Id$
 * @link      http://galette.tuxfamily.org
 * @since     Available since 0.8.2.3
 */

/**
 * Class to store Member's points
 *
 **/
class NotesPassagesDeGrades {

    const TABLE = 'PassagesDeGrades_notes';
    const PK = 'id_adh';

    private $_fields = array(
        '_id_adh' => 'integer',
        '_uv1' => 'integer',
        '_uv2' => 'integer',
        '_uv3' => 'integer',
        '_uv4' => 'integer',
        '_uv5' => 'integer',
        '_uv6' => 'integer',
    );
    private $_id_adh;
    private $_uv1;
    private $_uv2;
    private $_uv3;
    private $_uv4;
    private $_uv5;
    private $_uv6;

	/**
     * Construit une nouvelle série de notes soit vierge, soit à partir de son ID
     * 
     * @param string|int|object $args Doit être un ID
     */
    public function __construct($args = null) {
        global $zdb;

        if (is_int($args)) {
            try {
                $select = $zdb->select(self::TABLE)
                        ->where(array(self::PK => $args));
                $result = $zdb->execute($select);
                if ($result->count() == 1) {
                    $this->_loadFromRS($result->current());
				} else {
					$values = array (
						$id_adh = $args,
						$uv1 = NULL,
						$uv2 = NULL,
						$uv3 = NULL,
						$uv4 = NULL,
						$uv5 = NULL,
						$uv6 = NULL,
					);
					$insert = $zdb->insert(self::TABLE)
							->values($values);
							$zdb->execute($insert);
				}
            } catch (Exception $e) {
                Analog\Analog::log(
                        'Something went wrong :\'( | ' . $e->getMessage() . "\n" .
                        $e->getTraceAsString(), Analog\Analog::ERROR
                );
            }
        } 
    }
	
	/**
     * Populate object from a resultset row
     *
     * @param ResultSet $r the resultset row
     *
     * @return void
     */
    private function _loadFromRS($r) {
        $this->_id_adh = $r->id_adh;
        $this->_uv1 = $r->uv1;
        $this->_uv2 = $r->uv2;
        $this->_uv3 = $r->uv3;
        $this->_uv4 = $r->uv4;
        $this->_uv5 = $r->uv5;
        $this->_uv6 = $r->uv6;
    }
	
    /**
    * Renvoie le nombre d'élèves enregistrés en base et ayant des notes
    * 
    * @return int le nombre d'élèves enregistrés en base et ayant des notes
    */
    public static function getNombreEleves() {
        global $zdb;

        try {
            $select = $zdb->select(self::TABLE)
                    ->columns(array('nb' => new Zend\Db\Sql\Predicate\Expression('count(*)')));

            $result = $zdb->execute($select);
            return $result->current()->nb;
        } catch (Exception $e) {
            Analog\Analog::log(
                    'Something went wrong :\'( | ' . $e->getMessage() . "\n" .
                    $e->getTraceAsString(), Analog\Analog::ERROR
            );
            return false;
        }
    }
	
	/**
    * Renvoie le nombre d'élèves enregistrés en base et ayant des notes
    * 
    * @return int le nombre d'élèves enregistrés en base et ayant des notes
    */
    public static function getAllNotes() {
        global $zdb;

        try {
			$values = array ();
			
            $select = $zdb->select(self::TABLE);
            $result = $zdb->execute($select);
			
			foreach ($result as $value){
				$values[] = $value;
			}
			return $values;
        } catch (Exception $e) {
            Analog\Analog::log(
                    'Something went wrong :\'( | ' . $e->getMessage() . "\n" .
                    $e->getTraceAsString(), Analog\Analog::ERROR
            );
            return false;
        }
    }

    /**
    * Enregistre l'élément en cours que ce soit en insert ou update
    * 
    * @return bool False si l'enregistrement a échoué, true si aucune erreur
    */
    public function store() {
        global $zdb;

        try {
            $values = array();

            foreach ($this->_fields as $k => $v) {
                $values[substr($k, 1)] = $this->$k;
            }

            if (!isset($this->_id_adh) || $this->_id_adh == '') {
                $insert = $zdb->insert(self::TABLE)
                        ->values($values);
                $add = $zdb->execute($insert);
                if ($add > 0) {
                    $this->_id_adh = $zdb->driver->getLastGeneratedValue();
                } else {
                    throw new Exception(_T("AVION.AJOUT ECHEC"));
                }
            } else {
                $update = $zdb->update(self::TABLE)
                        ->set($values)
                        ->where(array(self::PK => $this->_id_adh));
                $zdb->execute($update);
            }
            return true;
        } catch (Exception $e) {
            Analog\Analog::log(
                    'Something went wrong :\'( | ' . $e->getMessage() . "\n" .
                    $e->getTraceAsString(), Analog\Analog::ERROR
            );
            return false;
        }
    }

	/**
     * Remove specified Notes
     *
     * 
     *
     * @return boolean
     */
    public function remove()
    {
        global $zdb;

            try {
            
            //remove transaction itself
            $delete = $zdb->delete(self::TABLE);
            $delete->where(array(self::PK => $this->_id_adh));
            $zdb->execute($delete);
   
            return true;
        } catch (\Exception $e) {
            if ( $transaction ) {
                $zdb->connection->rollBack();
            }
            Analog::log(
                'An error occured trying to remove NotesPassagesDeGrades #' .
                $this->_id_adh . ' | ' . $e->getMessage(),
                Analog::ERROR
            );
            return false;
        }
    }
	
	/**
    * Enregistre l'élément en cours que ce soit en insert ou update
    * 
    * @return bool False si l'enregistrement a échoué, true si aucune erreur
    */
    public function majnotes() {
        global $zdb;

        try {
            $values = array();

            foreach ($this->_fields as $k => $v) {
                //$values[$k] = $this->$k;
				$values[substr($k, 1)] = $this->$k;
            }
            
            $update = $zdb->update(self::TABLE)
                    ->set($values)
					//->set($this->_fields)
                    ->where(array(self::PK => $this->_id_adh));
					//echo print_r($values);
            $zdb->execute($update);
            return true;
        } catch (Exception $e) {
            Analog\Analog::log(
                    'Something went wrong :\'( | ' . $e->getMessage() . "\n" .
                    $e->getTraceAsString(), Analog\Analog::ERROR
            );
            return false;
        }
    }

	/**
    * Affiche la note
    * 
    * @return int 
    */
    public function getuv1() {
		
		return $this->_uv1;
	}
	
	/**
    * Affiche la note
    * 
    * @return int 
    */
    public function getuv2() {
		
		return $this->_uv2;
		
	}
			
	/**
    * Affiche la note
    * 
    * @return int 
    */
    public function getuv3() {
		
		return $this->_uv3;
		
	}
	
	/**
    * Affiche la note
    * 
    * @return int 
    */
    public function getuv4() {
		
		return $this->_uv4;
		
	}
	
	/**
    * Affiche la note
    * 
    * @return int 
    */
    public function getuv5() {
		
		return $this->_uv5;
		
	}
	
	/**
    * Affiche la note
    * 
    * @return int 
    */
    public function getuv6() {
		
		return $this->_uv6;
		
	}
	
	/**
    * Enregistre la note
	*
    * @param int $n note à écrire dans l'UV1
	*
    */
    public function storeuv1($n) {
		
		$this->_uv1 = $n;
		
	}

	/**
    * Enregistre la note
	*
    * @param int $n note à écrire dans l'UV2
    * 
    */
    public function storeuv2($n) {
		
		$this->_uv2 = $n;
		
	}
	
	/**
    * Enregistre la note
	*
    * @param int $n note à écrire dans l'UV3
    * 
    */
    public function storeuv3($n) {
		
		$this->_uv3 = $n;
		
	}
	
	/**
    * Enregistre la note
    * 
    * @param int $n note à écrire dans l'UV4
    * 
    */
    public function storeuv4($n) {
		
		$this->_uv4 = $n;
		
	}
	
	/**
    * Enregistre la note
    * 
    * @param int $n note à écrire dans l'UV5
    * 
    */
    public function storeuv5($n) {
		
		$this->_uv5 = $n;
		
	}
	
	/**
    * Enregistre la note
    * 
    * @param int $n note à écrire dans l'UV6
    * 
    */
    public function storeuv6($n) {
		
		$this->_uv6 = $n;
		
	}
	

}