<?php

//
// Add this line to your crontab file:
//
// * * * * * cd /path/to/project && php jobby.php 1>> /dev/null 2>&1
//
require(__DIR__ . '/vendor/autoload.php');


$jobby = new \Jobby\Jobby(
		array(
				"recipients" => "jaradd@gmail.com",
				"debug" => true,
				"output" => "app/logs/cron.log"
			)
	);


$jobby->add('UpdateSalesCount', array(
    'command' => 'php app/console elleol:update',
    'schedule' => '* * * * *',
    'enabled' => true
));

$jobby->add('testImp', array(
    'command' => 'php app/console elleol:test:imp',
    'schedule' => '* * * * *',
    'enabled' => false
));

$jobby->run();
