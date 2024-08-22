<?php

use App\BowlingGame;

function rollMany($game, $n, $pins): void
{
    for ($i = 0; $i < $n; $i++) {
        $game->roll($pins);
    }
}

function rollSpare($game): void
{
    for ($i = 0; $i < 2; $i++) {
        $game->roll(5);
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

    rollSpare($game);
    $game->roll(3);
    rollMany($game, 17, 0);

    expect($game->score())->toBe(16);
});

test('1 全倒 strike', function(){
    $game = new BowlingGame();

    $game->roll(10);
    $game->roll(3);
    $game->roll(4);
    rollMany($game, 16, 0);

    expect($game->score())->toBe(24);
});
