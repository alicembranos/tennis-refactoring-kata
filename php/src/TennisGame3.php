<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private const SCORES_NAMES = ['Love', 'Fifteen', 'Thirty', 'Forty'];

    private const DEUCE = 'Deuce';

    private int $pointsPlayer1 = 0;

    private int $pointsPlayer2 = 0;

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function getScore(): string
    {
        if (! $this->hasEnoughPointsToWin()) {
            return $this->generalScore();
        }

        if ($this->isTied()) {
            return self::DEUCE;
        }

        if ($this->inAdvantage()) {
            return "Advantage {$this->getLeader()}";
        }

        return "Win for {$this->getLeader()}";
    }

    public function wonPoint(string $playerName): void
    {
        $this->isPlayer1($playerName) ? $this->pointsPlayer1++ : $this->pointsPlayer2++;
    }

    private function hasEnoughPointsToWin(): bool
    {
        return ! ($this->pointsPlayer1 < 4 && $this->pointsPlayer2 < 4 && ! ($this->pointsPlayer1 + $this->pointsPlayer2 === 6));
    }

    private function inAdvantage(): bool
    {
        return abs($this->pointsPlayer1 - $this->pointsPlayer2) === 1;
    }

    private function generalScore(): string
    {
        $scorePlayer1 = self::SCORES_NAMES[$this->pointsPlayer1];
        $scorePlayer2 = self::SCORES_NAMES[$this->pointsPlayer2];
        return $this->isTied() ? "{$scorePlayer1}-All" : "{$scorePlayer1}-{$scorePlayer2}";
    }

    private function getLeader(): string
    {
        return $this->pointsPlayer1 > $this->pointsPlayer2 ? $this->player1Name : $this->player2Name;
    }

    private function isTied(): bool
    {
        return $this->pointsPlayer1 === $this->pointsPlayer2;
    }

    private function isPlayer1(string $playerName): bool
    {
        return $playerName === $this->player1Name;
    }
}
