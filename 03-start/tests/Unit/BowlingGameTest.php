<?php

use App\BowlingGame;

test('開局', function () {
    $game = new BowlingGame();
    for ($i = 0; $i < 20; $i++) {
        $game->roll(0);
    }
    expect($game->score())->toBe(0);
})->only();
