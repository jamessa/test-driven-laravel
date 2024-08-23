# 練習

## 測試驅動流程

1. 新增測試，執行後失敗。
2. 新增最簡單的功能，讓測試通過。
3. 完善功能。

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

## 範例 1

![保齡球計分案例](assets/bowling%20example.jpg)

每局兩次擊倒機會。

第一局：第一次擊倒６瓶，第二次Spare。Spare要加上下一次擊倒分數。10+10=20

第二局：第一次擊倒Strike。Strike要加上下兩個擊倒分數。20(上一個分數)+10+1+0=31

第三局：兩次加起來擊倒1瓶。31+1=32

第四局：Strike。加上下兩個擊倒分數。32+10+10+0=52

第五局：Strike。加上下兩個擊倒分數。52+10+0+8=70

第六局：兩次加起來擊倒8瓶。70+8=78

第七局：Spare。加上下一個擊倒分數。78+10+3=91

第八局：3,5 兩次加起來擊倒8瓶。91+8=99

第九局：兩次加起來擊倒4瓶。99+4=103

第十局：Strike。加上下兩個擊倒分數。103+10+3+4=120

## 範例 2

完美球局就是12個Strike。300分

## 規格

寫一個名為 Game 的類別，該類別具有兩個方法：

1. `roll(pins)`：每次玩家投球時調用。參數是擊倒的球瓶數量。
2. `score() -> int`：僅在比賽結束時調用。返回該場比賽的總得分。

## 參考資料

<https://kata-log.rocks/bowling-game-kata>
<http://www.butunclebob.com/files/downloads/Bowling%20Game%20Kata.ppt>
<https://blog.marsen.me/2021/06/25/2021/bowling_kata/>

![TDD cycle](https://upload.wikimedia.org/wikipedia/commons/0/0b/TDD_Global_Lifecycle.png)
