<?php

use App\BowlingGame;

test('開局', function () {
    $game = new BowlingGame();
    for ($i = 0; $i < 20; $i++) {
        $game->roll(0);
    }
    expect($game->score())->toBe(0);
});

test('投 20 球都只打中 1 隻球瓶', function () {
    $game = new BowlingGame();
    for ($i = 0; $i < 20; $i++) {
        $game->roll(1);
    }
    expect($game->score())->toBe(20);
});
