<?php

namespace App\Services;

use App\Match;
use Illuminate\Http\Request;

class MatchUpdateService {

	/**
	 * Register a movement from an user input.
	 * 
	 * @param int $matchId
	 * @param int $position
	 * @return Match $match
	 */
    public function move(int $matchId, int $position) {
		$match = Match::findOrFail($matchId);
		$match->makeMovement($position);
		
		$match->save();
		
		return $match;
	}

}