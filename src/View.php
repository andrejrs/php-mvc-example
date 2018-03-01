<?php

namespace Core;

/**
 * This view class.
 *
 * This class allows to display HTML.
 *
 * @category   View
 * @package    Core
 * @author     Andrej <*.*.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class View {

    /**
     * The render method.
     * 
     * TThis method displays the template and site's content.
     *
     * @param string $view A string representation of page template.
     * @param array $params A array of the controller variables.
     *
     * @return void
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    static function render(string $view, array $params): void {

        // Extract controller variables
        extract($params, EXTR_SKIP);

        // Page template path.
        $content = APPLICATION_PATH . "/App/Views/Page/$view.php";

        if (is_readable($content)) {
            
            // Include global template
            require_once APPLICATION_PATH . "/App/Views/Template.php";
            
        } else {
            
            throw new \Exception("View $view not found");
        }
    }

    /**
     * The error render method.
     * 
     * This method displays the errors.
     * 
     * @param array $params A array of the controller variables.
     *
     * @return array  The route details.
     * @access  public
     * @since   Method available since Release 1.0.0
     */
    static function renderError(array $params): void {

        // Extract controller variables
        extract($params, EXTR_SKIP);

        // Error template path
        $content = APPLICATION_PATH . "/App/Views/error.php"; 

        if (is_readable($content)) {
            
            require_once $content;
            
        } else {
            
            throw new \Exception("View ERROR not found");
        }
    }

}
