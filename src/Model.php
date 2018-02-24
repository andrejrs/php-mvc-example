<?php

namespace Core;

use Config\Database;

/**
 * The abstract model class.
 *
 * This class allows connection to the database via PDO.
 *
 * @category   Database
 * @package    Core
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
abstract class Model {

    /**
     * It represents a PDO instance
     *
     * @var object
     */
    private $db = null;

    /**
     * The name of the table in the database that the model binds
     *
     * @var string
     */
    protected $_table;

    /**
     * The model construct
     *
     */
    public function __construct() {

        $conn_string = 'mysql:host=' . Database::DB_HOST . ';dbname=' . Database::DB_NAME . ';charset=utf8';
        $this->db = new \PDO($conn_string, Database::DB_USER, Database::DB_PASSWORD);
        
        // Throw an Exception when an error occurs
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Abstract method for getting all records from database.
     *
     *
     * @return array
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    abstract function getAll();

    /**
     * The insert method.
     * 
     * This method makes it easy to insert data into the database 
     * in a quick and easy way. The data set must be associative. 
     * Index of array represents the field in the database.
     * 
     * For example: [ "fist_name" => "John" ]
     *
     * @param array $data A set of data to be added to the database.
     *
     * @return integer The last insert ID
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public function insert($data) {

        // Fields to be added.
        $fields = [];
        // Fields values
        $values = [];
        // Question marks
        $marks = array_fill(0, count($data), '?');

        // Separate the field name from the value.
        foreach ($data as $field => $value) {
            $fields[] = $field;
            $values[] = $value;
        }
        
        // Prepare statement
        $stmt = $this->DB()->prepare("
            INSERT INTO " . $this->_table . "(" . implode(",", $fields) . ")
            VALUES(" . implode(",", $marks) . ")
        ");
        
        // Execute statement with values
        $stmt->execute($values);

        // Return last inserted ID.
        return $this->DB()->lastInsertId();
    }

    /**
     * The method return a PDO database connection.
     *
     * @return object
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    protected function DB() {
        return $this->db;
    }

}
