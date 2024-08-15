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
        $i = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->rolls[$i] + $this->rolls[$i + 1] == 10) {
                $score += $this->rolls[$i + 2];
            } // spare
            $score += $this->rolls[$i];
            $score += $this->rolls[$i + 1];
            $i += 2;
        }

        return $score;
    }
}
