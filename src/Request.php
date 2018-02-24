<?php

namespace Core;

/**
 * The request class.
 *
 * This class stores parameters from get or post requests.
 *
 * @category   Request
 * @package    Core
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Request {

    /**
     * The array of request parameters.
     *
     * @var object
     */
    static $params = [];

    /**
     * The static method for getting certain parameter.
     *
     *
     * @return mixed  It will return null if the parameter is not sent.
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public static function getParam($name) {
        if (isset(Request::$params[$name])) {
            return Request::$params[$name];
        }
        return null;
    }

    /**
     * The method for setting request parameters
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public static function setParams($params) {
        Request::$params = $params;
    }

}
