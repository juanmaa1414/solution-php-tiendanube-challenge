<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Support\Facades\Input;
use App\Services\MatchUpdateService;
use App\Services\MatchCreationService;

class MatchController extends Controller {

	public function index() {
        return view('index');
    }

    /**
     * Returns a list of matches
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function matches() {
		return response()->json( Match::all() );
    }

    /**
     * Returns the state of a single match
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function match($id) {
		$match = Match::findOrFail($id);
		
        return response()->json($match);
    }

    /**
     * Makes a move in a match
     *
     * @param $id
	 * @param MatchUpdateService $matchUpdateService
     * @return \Illuminate\Http\JsonResponse
     */
    public function move($id, MatchUpdateService $matchUpdateService) {
		// TODO: Validate.
        $position = Input::get('position');
		
        $match = $matchUpdateService->move($id, $position);

        return response()->json($match);
    }

    /**
	 * Creates a new match and returns the new list of matches
	 * 
	 * @param CreateMatch $request
	 * @param MatchCreationService $matchCreationService
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function create(MatchCreationService $matchCreationService) {
		$matchCreationService->make();
		
        return response()->json( Match::all() );
    }

    /**
     * Deletes the match and returns the new list of matches
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {
		Match::destroy($id);
		
        return response()->json( Match::all() );
    }

}
