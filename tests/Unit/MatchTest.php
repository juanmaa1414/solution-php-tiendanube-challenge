<?php

namespace Tests\Unit;

use Tests\TestCase;

class MatchTest extends TestCase
{
    /** @test */
    public function it_should_detect_a_winner_move()
    {
		$testBoard = [
			1, 0, 1,
			2, 2, 0,
			0, 0, 0,
		];
		$targetPosition = 1;
        $match = factory(\App\Match::class)->create([
            'name' => 'Test match',
			'next' => 1,
			'board' => $testBoard
		]);
		
		// When
		$match->makeMovement($targetPosition);
		
		// Then
		$this->assertEquals(1, $match->winner);
    }
}
