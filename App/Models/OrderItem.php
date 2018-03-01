<?php

namespace App\Models;

/**
 * The order item class.
 *
 * This model for managing the order items.
 *
 * @category   Models
 * @package    App\Models
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
use Core\Model;

/**
 * Description of Home
 *
 * @author majksector
 */
class OrderItem extends Model {

    /**
     * The model construct
     *
     */
    public function __construct() {

        /**
         * The database table name.
         */
        parent::__construct("order_item");
    }

    /**
     * Method getting all records from database.
     * [Implemented method from the Model class]
     *
     * @return array
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function getAll(): iterable {

        return $this->DB()
                        ->query('SELECT * FROM order_item LIMIT 1')
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

}
