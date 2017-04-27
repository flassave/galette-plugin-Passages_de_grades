<?php

/**
 * Public Class Grades
 * 
 *
 * PHP version 5
 *
 * Copyright © 2016 Frédéric LASSAVE
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
 * @package   GaletteGrades
 *
 * @author    Frédéric LASSAVE <f.lassave@free.fr>
 * @copyright 2016 Frédéric LASSAVE
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or (at your option) any later version
 * @version   SVN: $Id$
 * @link      http://galette.tuxfamily.org
 * @since     Available since 0.8.2.3
 */

namespace GaletteGrades;

/**
 * Class to store Grades
 *
 **/
class Grades {

    private $_fields = array(
        '_id_adh' => 'integer',
        '_grade' => 'string',
        '_df_val' => 'integer',
        '_img' => 'string',
    );
    private $_id_adh;
    private $_grade;
    private $_df_val;
    //private $_img;
    

	/**
     * Construit les infos grade à partir de son ID
     * 
     * @param string|int|object $args Doit être un ID
     */
    public function __construct($args = null) {
        global $zdb;

        if (is_int($args)) {
			$this->_id_adh = $args;
            try {
                $select = $zdb->select(dynamic_fields);
				$select->where(array(field_id => 4, item_id => $args));
				$result = $zdb->execute($select);
				//$df4 = $result->curent();
				echo print_r($result);
				$this->_load_df_val_from_df($result->current());
            } catch (Exception $e) {
                Analog\Analog::log(
                        'Something went wrong :\'( | ' . $e->getMessage() . "\n" .
                        $e->getTraceAsString(), Analog\Analog::ERROR
                );
            }
			try {
                $select = $zdb->select(field_contents_4);
				$select->where(array(id => $this->_df_val));
				$result = $zdb->execute($select);
				//echo print_r($result->curent());
				$this->_load_grade_from_df4($result->current());
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
    private function _load_df_val_from_df($r) {
        $this->_df_val = $r->fiel_val;
    }
	
	/**
     * Populate object from a resultset row
     *
     * @param ResultSet $r the resultset row
     *
     * @return void
     */
    private function _load_grade_from_df4($r) {
        $this->_grade = $r->val;
    }
	
	/**
    * Retourne le grade
    * 
    * @return string  
    */
	public function getgrade() {
		return $this->_grade;
	}	
	
	
    
}
