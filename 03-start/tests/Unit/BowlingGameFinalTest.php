<?php

use App\BowlingGameFinal;

class BowlingGameExtended extends BowlingGameFinal
{
    public function rollMany($n, $pins)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->roll($pins);
        }
    }

    public function rollSpare(int $i=5)
    {
        $this->roll($i);
        $this->roll(10-$i);
    }

    public function rollStrike()
    {
        $this->roll(10);
    }
}

test('投 20 球，全部都不中', function () {
    $game = new BowlingGameExtended();

    $game->rollMany(20, 0);

    expect($game->score())->toBe(0);
});

test('投 20 球，但是每次都只有打出一球', function(){
    $game = new BowlingGameExtended();

    $game->rollMany(20, 1);

    expect($game->score())->toBe(20);
});

function rollSpare($game)
{
    $game->roll(5);
    $game->roll(5);
}


test('1 補中 spare', function(){
    $game = new BowlingGameExtended();

    rollSpare($game); // 第一局 13 分，因為全到會加上下一局的第一球
    $game->roll(3);
    $game->rollMany(17, 0);

    expect($game->score())->toBe(16);
});

function rollStrike($game)
{
    $game->roll(10);
}

test('1 全倒 strike', function(){
    $game = new BowlingGameExtended();

    $game->rollStrike();
    $game->roll(3);
    $game->roll(4);
    $game->rollMany(16, 0);

    expect($game->score())->toBe(24);
});

test('perfect game', function(){
    $game = new BowlingGameExtended();

    $game->rollMany(12, 10);

    expect($game->score())->toBe(300);
});

test('範例 1', function(){
    $game = new BowlingGameExtended();

    // 1
    $game->rollSpare(6);
    // 2
    $game->rollStrike();
    // 3
    $game->roll(0);
    $game->roll(1);
    expect($game->score())->toBe(32);

    // 4
    $game->rollStrike();
    // 5
    $game->rollStrike();
    // 6
    $game->roll(0);
    $game->roll(8);
    expect($game->score())->toBe(78);

    // 7
    $game->rollSpare();
    // 8
    $game->roll(3);
    $game->roll(5);
    // 9
    $game->roll(2);
    $game->roll(2);
    expect($game->score())->toBe(103);

    // 10
    $game->rollStrike();
    $game->roll(3);
    $game->roll(4);

    expect($game->score())->toBe(120);
});
