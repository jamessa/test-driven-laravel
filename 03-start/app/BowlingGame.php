<?php

declare(strict_types=1);

namespace App;

use phpDocumentor\Reflection\Types\Boolean;

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

    public function isSpare(int $i): bool
    {
        return $this->rolls[$i] + $this->rolls[$i + 1] == 10;
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
            if($this->isSpare($i)){
                $score += 10;
                $score += $this->rolls[$i + 2];
                $i += 2;
            }
            else if($this->rolls[$i] == 10){
                $score += 10;
                $score += $this->rolls[$i + 1];
                $score += $this->rolls[$i + 2];
                $i += 1;
            }
            else{
                $score += $this->rolls[$i];
                $score += $this->rolls[$i + 1];
                $i += 2;
            }
        }

        return $score;
    }
}
