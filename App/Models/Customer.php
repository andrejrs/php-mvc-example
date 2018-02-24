<?php

namespace App\Models;

use Core\Model;

/**
 * The customer class.
 *
 * This model for managing the customers.
 *
 * @category   Models
 * @package    App\Models
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Customer extends Model {

    /**
     * The database table name.
     * [Variable from the Model class\
     *
     * @var string
     */
    protected $_table = "customers";

    /**
     * Method getting all records from database.
     * [Implemented method from the Model class]
     *
     * @return array
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function getAll() {

        return $this->DB()
                        ->query('SELECT id, first_name FROM customers')
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

}
