<?php

use App\BowlingGameFinal;

function rollMany($game, $n, $pins)
{
    for ($i = 0; $i < $n; $i++) {
        $game->roll($pins);
    }
}

test('投 20 球，全部都不中', function () {
    $game = new BowlingGame();

    rollMany($game, 20, 0);

    expect($game->score())->toBe(0);
});

test('投 20 球，但是每次都只有打出一球', function(){
    $game = new BowlingGame();

    rollMany($game, 20, 1);

    expect($game->score())->toBe(20);
});

function rollSpare($game)
{
    $game->roll(5);
    $game->roll(5);
}


test('1 補中 spare', function(){
    $game = new BowlingGame();

    rollSpare($game); // 第一局 13 分，因為全到會加上下一局的第一球
    $game->roll(3);
    rollMany($game, 17, 0);

    expect($game->score())->toBe(16);
});

function rollStrike($game)
{
    $game->roll(10);
}

test('1 全倒 strike', function(){
    $game = new BowlingGame();

    rollStrike($game);
    $game->roll(3);
    $game->roll(4);
    rollMany($game, 16, 0);

    expect($game->score())->toBe(24);
});

test('perfect game', function(){
    $game = new BowlingGame();

    rollMany($game, 12, 10);

    expect($game->score())->toBe(300);
});
