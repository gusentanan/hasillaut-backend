<?php
    const extension = ".php";

    function loader($class_name) {
        include_once $class_name.extension;
    }

    spl_autoload_register('loader');

?>