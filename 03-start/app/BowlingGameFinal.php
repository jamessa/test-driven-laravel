<?php

namespace App;

class BowlingGameFinal
{
    private $rolls = [];
    private $currentRoll = 0;

    public function roll(int $pins): void
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function score(): int
    {
        $score = 0;

        $i=0;
        for($frame = 0; $frame < 10; $frame++) {
            if($this->isStrike($i)) {
                $score += 10 + $this->strikeBonus($i);
                $i++;
            } else if($this->isSpare($i)) {
                $score += 10 + $this->spareBonus($i);
                $i += 2;
            } else {
                $score += $this->sumOfBallsInFrame($i);
                $i += 2;
            }
        }
        return $score;
    }

    private function isSpare(int $i): bool
    {
        return $this->rolls[$i] + $this->rolls[$i + 1] == 10;
    }

    private function isStrike(int $i): bool
    {
        return $this->rolls[$i] == 10;
    }

    private function sumOfBallsInFrame(int $i): int
    {
        return $this->rolls[$i] + $this->rolls[$i + 1];
    }

    private function strikeBonus(int $i): int
    {
        return $this->rolls[$i + 1] + $this->rolls[$i + 2];
    }

    private function spareBonus(int $i): int
    {
        return $this->rolls[$i + 2];
    }
}
