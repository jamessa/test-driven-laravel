<?php
declare(strict_types=1);
namespace App;

class BowlingGame
{
    private $rolls = [];
    private $currentRoll = 0;
    protected int $score = 0;

    /**
     * 每次玩家投球時調用。
     *
     * @param int $pins 擊倒的球瓶數量。
     * @return void
     */
    public function roll(int $pins): void
    {
        $this->score += $pins;
        $this->rolls[$this->currentRoll++] = $pins;
    }

    /**
     *
     * @return int
     */
    public function score(): int
    {
        $score = 0;

        foreach ($this->rolls as $roll) {
            $score += $roll;
        }

        return $score;
    }
}
