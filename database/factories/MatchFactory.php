<?php

$factory->define(App\Match::class, function () {
	static $order = 0;
	
	$order++;
    return [
        'name' => "Match #{$order}",
		'next' => rand(1, 2),
		'winner' => 0,
		'board' => [
			0, 0, 0,
			0, 0, 0,
			0, 0, 0,
		]
    ];
});
