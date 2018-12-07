<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
		'name',	'next',	'winner', 'board'
	];
	
	protected $dates = ['created_at', 'updated_at'];
	
	protected $casts = [
        'board' => 'array'
    ];
	
	protected $winnerIndexes = [
		[0, 1, 2], [3, 4, 5], [6, 7, 8],
		[0, 3, 6], [1, 4, 7], [2, 5, 8],
		[0, 4, 8], [2, 4, 6],
	];

	/**
	 * Makes a movement into the current match board.
	 * 
	 * @param int $position
	 */
	public function makeMovement(int $position)
	{
		// Do movement.
		$newBoard = $this->board;
		$newBoard[$position] = $this->next;
		
		// Then set our board property with the new values.
		$this->board = $newBoard;
		
		$this->switchPlayer();
		$this->checkForWinner();
	}
	
	/**
	 * Verifies if we have a winner.
	 */
	public function checkForWinner()
	{
		foreach ($this->winnerIndexes as [$first, $second, $third]) {
			$possibleHit = collect([
				$this->board[$first], 
				$this->board[$second], 
				$this->board[$third]
			]);
			
			$evalPlayerOne = $possibleHit->diff([1, 1, 1]);
			$evalPlayerTwo = $possibleHit->diff([2, 2, 2]);
			
			// In some case of hit.
			// HAVE A WINNER !
			if (count($evalPlayerOne) === 0) {
				$this->winner = 1;
				return;
			}
			
			if (count($evalPlayerTwo) === 0) {
				$this->winner = 2;
				return;
			}
		}
	}

	/**
	 * Enables the next player to move.
	 */
	private function switchPlayer()
	{
		$this->next = ($this->next == 1) ? 2 : 1;
	}
}
