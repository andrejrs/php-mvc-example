<?php

namespace Seeder;

use Core\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

/**
 * The order seeder class.
 *
 * Filling the database with randomly generated data.
 *
 * @category   Seeders
 * @package    App\Seeder
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class OrderSeeder implements Seeder {

    /**
     * The current route path
     *
     * @var object
     */
    private $customers;

    /**
     * The run method.
     * [Method from seeder interface]
     * 
     * In this method, there should be a procedure for creating data 
     * and inserting them in the database.
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function run() {

        $this->getCustomersArray();

        $this->insertOrders(31, "2018-01-01");

        $this->insertOrders(4, "2018-01-03");

        $this->insertOrders(3, "2018-01-08");

        $this->insertOrders(6, "2018-01-10");

        $this->insertOrders(4, "2018-01-05");

        $this->insertOrders(6, "2018-01-16");

        echo "Done \n";
    }

    /**
     * Method for inserting orders.
     * 
     * @param integer $num The number of records to be added.
     * @param string $date A string representation of date.
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    private function insertOrders($num, $date) {


        for ($index = 0; $index < $num; $index++) {

            $order = new Order();
            $order_id = $order->insert([
                "customer_id" => $this->getRandomCustomer(),
                "country_id" => rand(1, 6),
                "device_id" => 1,
                "created_at" => date('Y-m-d H:i:s', strtotime($date . ' +' . $index . ' day'))
            ]);

            $this->insertItems($order_id, rand(1, 10));
        }
    }

    /**
     * Method for inserting items.
     * 
     * @param integer $order_id A id of the order
     * @param integer $num The number of records to be added.
     * 
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    private function insertItems($order_id, $num) {

        for ($index = 0; $index < $num; $index++) {

            $orderItem = new OrderItem();
            $orderItem->insert([
                "order_id" => $order_id,
                "ean" => rand(111111, 9999999),
                "quantity" => rand(1, 3),
                "price" => rand(1, 5)
            ]);
        }
    }

    /**
     * Method for getting random customer from array.
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    private function getRandomCustomer() {
        $rand_key = array_rand($this->customers, 1);
        return $this->customers[$rand_key];
    }

    /**
     * Method for getting customers from the database.
     * 
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    private function getCustomersArray() {

        $mdlCustomer = new \App\Models\Customer();
        $rows = $mdlCustomer->getAll();

        $this->customers = array_column($rows, 'id');
    }

}
