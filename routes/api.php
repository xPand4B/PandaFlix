<?php

use App\Components\Common\Helper\ComponentHelper;

$api_routes = ComponentHelper::getFilesByName('api.php');

foreach ($api_routes as $route_file) {
    require $route_file;
}
