<?php

use App\Components\Common\Helper\ComponentHelper;

$web_routes = ComponentHelper::getFilesByName('web.php');

foreach ($web_routes as $route_file) {
    require $route_file;
}
