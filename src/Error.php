<?php

namespace Core;

use Core\Error;
use Config\Application as AppConfig;

/**
 * Error class
 *
 * This class is responsible for displaying errors.
 *
 * @category   Errors
 * @package    Core
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Error {

    /**
     * The error handler method.
     * 
     * The error handler will be called for every error regardless 
     * to the setting of the error_reporting setting.
     *
     * @param int $level  Error level
     * @param string $message  Error message
     * @param string $file  Filename the error was raised in
     * @param int $line  Line number in the file
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public static function errorHandler($level, $message, $file, $line) {

        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * The exception handler method.
     * 
     * The method will be called when an uncaught exception occurs.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public static function exceptionHandler($exception) {

        // Variables
        $errorinfo = "";
        $header = "404";
        $homepage = AppConfig::DEFAULT_ROUTE;

        // Error code
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }

        // Set the response code
        http_response_code($code);

        // Log type
        if (AppConfig::SHOW_ERRORS) {
            $errorinfo = Error::getErrorInfo($exception);
        } else {
            Error::logToFile($exception);
        }

        // Render error page
        View::renderError(compact(["errorinfo", "header", "homepage"]));
    }

    /**
     * The method that write error info to log file.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public static function logToFile($exception) {

        // Set log path
        ini_set('error_log', APPLICATION_PATH . '/logs/' . date('Y-m-d') . '.txt');

        // Set error info
        $message = "Uncaught exception: '" . get_class($exception) . "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= "\nStack trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

        // Write log
        error_log($message);
    }

    /**
     * The method makes error info string.
     *
     * @param Exception $exception  The exception
     *
     * @return string
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    public static function getErrorInfo($exception) {

        $errorinfo = "";
        $errorinfo .= "<h1>Fatal error</h1>";
        $errorinfo .= "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        $errorinfo .= "<p class=\"text-danger\">Message: '" . $exception->getMessage() . "'</p>";
        $errorinfo .= "<p class=\"text-warning text-left\">Stack trace:<br /><span>" . nl2br($exception->getTraceAsString()) . "</span></p>";
        $errorinfo .= "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        return $errorinfo;
    }

}
