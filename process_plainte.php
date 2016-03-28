<?php

require_once( 'vendor/autoload.php' );

use Mgl846\Plainte\controller\app as app;

$app = new app();
print $app->processer_plainte();
