<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 23.02.17
 * Time: 14:17
 */
function render($view, $valuesArray = [])
{
   // echo "view/{$view}";
    if (file_exists("../view/{$view}"));
    {
        ob_start();
        extract($valuesArray);
        require("view/{$view}");
        return ob_get_flush();
    }

}