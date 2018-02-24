<?php

namespace Core;

/**
 * This interface allows to run seeders.
 *
 * They are used to fill the database table with the dummy data.
 *
 * @category   Seeder
 * @package    Core
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
interface Seeder {

    /**
     * The run method.
     * 
     * In this method, there should be a procedure for creating data 
     * and inserting them in the database.
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function run();
}
