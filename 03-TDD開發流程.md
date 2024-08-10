# 練習

## Prepare

```console
php artisan make:test --unit BowlingGameTest
```

tests/Unit/BowlingGameTest.php

```php
<?php

use App\BowlingGame;

test('開局', function () {
    $game = new BowlingGame();
});
```

## 保齡球計分

一場比賽由 10 局組成。在每一局中，玩家有兩次機會來擊倒 10 根球瓶。該局的得分是擊倒的球瓶總數，加上全倒和補中所帶來的獎金。

**補中 (Spare)** 是指玩家在兩次嘗試內擊倒所有 10 根球瓶。這一局的獎勵是下一次投球擊倒的球瓶數量。因此，在第三局中，得分是 10（擊倒的總球瓶數）加上 5 的獎勵（下一次投球擊倒的球瓶數）。

**全倒 (Strike)** 是指玩家在第一次嘗試中就擊倒所有 10 根球瓶。這一局的獎勵是接下來兩次投球的總值。

在第十局中，若玩家投出了補中或全倒，可以進行額外的投球來完成該局。然而，第十局最多只能投三次球。

## 規格

寫一個名為 Game 的類別，該類別具有兩個方法：

1. `roll(pins)`：每次玩家投球時調用。參數是擊倒的球瓶數量。
2. `score() -> int`：僅在比賽結束時調用。返回該場比賽的總得分。

## 原文

The game consists of 10 frames as shown above.  In each frame the player has
two opportunities to knock down 10 pins.  The score for the frame is the total
number of pins knocked down, plus bonuses for strikes and spares.

A spare is when the player knocks down all 10 pins in two tries.  The bonus for
that frame is the number of pins knocked down by the next roll.  So in frame 3
above, the score is 10 (the total number knocked down) plus a bonus of 5 (the
number of pins knocked down on the next roll.)

A strike is when the player knocks down all 10 pins on his first try.  The bonus
for that frame is the value of the next two balls rolled.

In the tenth frame a player who rolls a spare or strike is allowed to roll the extra
balls to complete the frame.  However no more than three balls can be rolled in
tenth frame.

Write a class named “Game” that has two methods
roll(pins : int) is called each time the player rolls a ball.  The argument is the number of pins knocked down.
score() : int is called only at the very end of the game.  It returns the total score for that game.

## Reference

<https://kata-log.rocks/bowling-game-kata>
<http://www.butunclebob.com/files/downloads/Bowling%20Game%20Kata.ppt>
<https://blog.marsen.me/2021/06/25/2021/bowling_kata/>
