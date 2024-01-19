<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private const LOVE = 'Love';
    private const FIFTEEN = 'Fifteen';
    private const THIRTY = 'Thirty';
    private const DEUCE = 'Deuce';
    private const FORTY = 'Forty';
    private const THREE_POINTS = 3;
    private const FOUR_POINTS = 4;
    private const TWO_POINTS = 2;
    private const ONE_POINT = 1;
    private const ZERO_POINTS = 0;
    private int $pointsPlayer1 = self::ZERO_POINTS;
    private int $pointsPlayer2 = self::ZERO_POINTS;

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function getScore(): string
    {
        if (!$this->hasEnoughPointsToWin() && !$this->isTied()) {
            return $this->getGeneralScore($this->pointsPlayer1) . '-' . $this->getGeneralScore($this->pointsPlayer2);
        }

        if ($this->isTied()) {
            return $this->pointsPlayer1 >= self::THREE_POINTS ? self::DEUCE : $this->getGeneralScore($this->pointsPlayer1) . '-All';
        }

        if ($this->inAdvantage()) {
            return 'Advantage ' . $this->getLeader();
        }

        return 'Win for ' . $this->getLeader();
    }

    public function wonPoint(string $playerName): void
    {
        $playerName === $this->player1Name ? $this->pointsPlayer1++ : $this->pointsPlayer2++;
    }

    private function hasEnoughPointsToWin(): bool
    {
        return $this->pointsPlayer1 >= self::FOUR_POINTS || $this->pointsPlayer2 >= self::FOUR_POINTS;
    }

    private function isTied(): bool
    {
        return $this->pointsPlayer1 === $this->pointsPlayer2;
    }

    public function getGeneralScore(int $score): string
    {
        return match ($score) {
            self::ZERO_POINTS => self::LOVE,
            self::ONE_POINT => self::FIFTEEN,
            self::TWO_POINTS => self::THIRTY,
            default => self::FORTY
        };
    }

    private function inAdvantage(): bool
    {
        return abs($this->pointsPlayer1 - $this->pointsPlayer2) === self::ONE_POINT;
    }

    private function getLeader(): string
    {
        return $this->pointsPlayer1 > $this->pointsPlayer2 ? $this->player1Name : $this->player2Name;
    }
}
