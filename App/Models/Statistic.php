<?php

namespace App\Models;

use Core\Model;
use Core\Validator;

/**
 * The statistic class.
 *
 * The model is used to create statistics.
 *
 * @category   Models
 * @package    App\Models
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Statistic extends Model {

    /**
     * The model construct
     *
     */
    public function __construct() {
        parent::__construct("");
    }

    /**
     * Database statistics.
     *
     * The method returns from the database statistics for the dashboard for a given period.
     * 
     *  - float  total_revenue
     *  - integer  total_orders
     *  - integer  total_customers
     *
     * @return array  [[total_revenue, total_orders, total_customers]]
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function getForDashboard(string $from = NULL, string $to = NULL): iterable {

        if (Validator::dates(compact(["from", "to"])) === false) {

            $from = date("Y-m-01");
            $to = date("Y-m-t");
        }

        return $this->DB()
                        ->query('SELECT '
                                . ' SUM(quantity * price) as total_revenue, '
                                . ' COUNT(DISTINCT order_id) as total_orders, '
                                . ' COUNT(DISTINCT customer_id) as total_customers '
                                . 'FROM orders AS o '
                                . 'LEFT JOIN order_item ON (order_item.order_id = o.id)'
                                . 'WHERE o.created_at >= ' . " '$from' AND o.created_at <= " . " '$to'")
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Monthly graphic
     *
     * Data for monthly graphic display for a given month and year.
     * 
     *  - integer  orders
     *  - integer  customers
     *  - integer  day (1-31)
     *
     * @return array  [[orders, customers, day]]
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function getMountlyGraphicData(string $year_month = NULL): iterable {

        if (Validator::dates(compact("year_month"), "Y-m") === false) {
            
            $year_month = date("Y-m");
        }

        $rows = $this->DB()
                ->query('SELECT '
                        . ' COUNT(DISTINCT order_id) as orders, '
                        . ' COUNT(DISTINCT customer_id) as customers, '
                        . ' DAY(o.created_at) as day '
                        . 'FROM orders AS o '
                        . 'LEFT JOIN order_item ON (order_item.order_id = o.id)'
                        . 'WHERE o.created_at LIKE ' . " '$year_month%' "
                        . "GROUP BY DAY(o.created_at)")
                ->fetchAll(\PDO::FETCH_ASSOC);

        // Format data for the chart
        $response = [];
        $response['orders'] = [];
        $response['customers'] = [];

        // Init vars
        for ($index = 0; $index < date("t", strtotime($year_month)); $index++) {
            $response['orders'][$index] = 0;
            $response['customers'][$index] = 0;
            $response['days'][$index] = $index + 1;
        }

        // Insert data from database
        foreach ($rows as $row) {
            $day = (int) $row['day'];
            $response['orders'][$day - 1] = $row['orders'];
            $response['customers'][$day - 1] = $row['customers'];
        }

        return $response;
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
        
    }

}
