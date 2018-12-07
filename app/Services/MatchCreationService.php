<?php

namespace App\Services;

use App\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchCreationService {

	/**
	 * Register a new match.
	 * 
	 * @param Request $input
	 */
    public function make() {
		$nextId = DB::table('matches')->orderBy('id', 'desc')->first()->id + 1;
		
		$match = Match::create([
			'name' => "Match #{$nextId}",
			'next' => rand(1, 2),
			'winner' => 0,
			'board' => [
				0, 0, 0,
				0, 0, 0,
				0, 0, 0,
			]
		]);
	}

}
