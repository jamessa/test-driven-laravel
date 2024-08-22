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

function rollStrike(BowlingGame $game): void
{
    $game->roll(10);
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

    rollStrike($game);
    $game->roll(3);
    $game->roll(4);
    rollMany($game, 16, 0);

    expect($game->score())->toBe(24);
});

test('範例二：連投 12 球全倒', function(){
    $game = new BowlingGame();

    rollMany($game, 12, 10);

    expect($game->score())->toBe(300);
});

test(
    '在第十局中，若玩家投出了補中或全倒，可以進行額外的投球來完成該局。然而，第十局最多只能投三次球。',
    function () {
        $game = new BowlingGame();

        rollMany($game, 18, 0);

        // 地 10 局 投 3 次都全倒。
        rollMany($game, 3, 10);

        expect($game->score())->toBe(30);
    }
);

test('範例一', function () {
    $game = new BowlingGame();

    // 第一次擊倒６瓶，第二次Spare。Spare要加上下一次擊倒分數。10+10=20
    rollSpare($game);

    // 2: 全倒
    rollStrike($game);

    // 3
    $game->roll(0);
    $game->roll(1);

    //4
    rollStrike($game);

    // 5
    rollStrike($game);

    // 6
    $game->roll(3);
    $game->roll(5);

    // 7
    rollSpare($game);

    //8
    $game->roll(3);
    $game->roll(5);

    //9
    $game->roll(2);
    $game->roll(2);

    //10
    rollStrike($game);

    expect($game->score())->toBe(120);
});
