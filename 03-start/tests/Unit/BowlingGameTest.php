<?php

use App\BowlingGame;

function rollMany($game, $n, $pins): void
{
    for ($i = 0; $i < $n; $i++) {
        $game->roll($pins);
    }
}

test('開局', function () {
    $game = new BowlingGame();
    rollMany($game, 20, 0);
    expect($game->score())->toBe(0);
});

test('投 20 球都只打中 1 隻球瓶', function () {
    $game = new BowlingGame();
    rollMany($game, 20, 1);
    expect($game->score())->toBe(20);
});

test('1 補中 spare', function () {
    $game = new BowlingGame();

    $game->roll(5);
    $game->roll(5);
    $game->roll(3);
    rollMany($game, 17, 0);

    expect($game->score())->toBe(16);
});