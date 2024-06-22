<?php

function strip_zeros_from_date($marked_string = "") {
    return str_replace('0', '', $marked_string);
}

function redirect($location = NULL, $use_js = false) {
    if ($location != NULL) {
        if ($use_js) {
            echo "<script>window.location='{$location}'</script>";
        } else {
            header("Location: {$location}");
            exit;
        }
    } else {
        echo 'Error: No location provided';
    }
}

function output_message($message = "") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

function date_toText($datetime = "") {
    $nicetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $nicetime);
}

function autoload_register($class_name) {
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}
spl_autoload_register('autoload_register');

function getCurrentPage($level = 0) {
    $this_page = $_SERVER['SCRIPT_NAME'];
    $bits = explode('/', $this_page);
    return isset($bits[$level]) ? $bits[$level] : '';
}

function currentpage_public() {
    return getCurrentPage(2);
}

function currentpage_admin() {
    return getCurrentPage(4);
}

function currentpage() {
    return getCurrentPage(3);
}

function curPageName() {
    $uri = $_SERVER['REQUEST_URI'];
    return basename(parse_url($uri, PHP_URL_PATH));
}

function file_path() {
    $pathinfo = pathinfo(__FILE__);
    echo $pathinfo['dirname'];
}
?>
