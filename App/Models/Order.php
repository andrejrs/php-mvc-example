<?php

namespace App\Models;

use Core\Model;

/**
 * The order class.
 *
 * This model for managing the orders.
 *
 * @category   Models
 * @package    App\Models
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Order extends Model {

    /**
     * The model construct
     *
     */
    public function __construct() {

        /**
         * The database table name.
         */
        parent::__construct("orders");
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
                        ->query('SELECT * FROM orders LIMIT 1')
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Method getting last 10 records from database.
     *
     * @return array
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function getLastTen(): iterable {

        return $this->DB()
                        ->query('SELECT o.*, c.first_name, c.last_name, '
                                . 'cn.name as country_name, d.name as device_name '
                                . 'FROM orders as o '
                                . 'LEFT JOIN customers as c ON (o.customer_id = c.id) '
                                . 'LEFT JOIN countries as cn ON (o.country_id = cn.id) '
                                . 'LEFT JOIN devices as d ON (o.device_id = d.id) '
                                . 'ORDER BY id DESC '
                                . 'LIMIT 10')
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

}
