<?php
namespace App\Entity;

class Player
{
    public const GOALKEEPER_POSITION = 'В';
    public const DEFENDER_POSITION = 'З';
    public const HALFBACK_POSITION = 'П';
    public const ATTACK_POSITION = 'Н';

    private const PLAY_PLAY_STATUS = 'play';
    private const BENCH_PLAY_STATUS = 'bench';

    private int $number;
    private string $name;
    private string $playStatus;
    private int $inMinute;
    private int $outMinute;
    private int $goals;
    private int $yellowCards;
    private bool $hasRedCard;
    private string $position;

    public function __construct(int $number, string $name, string $position)
    {
        $this->number = $number;
        $this->name = $name;
        $this->playStatus = self::BENCH_PLAY_STATUS;
        $this->inMinute = 0;
        $this->outMinute = 0;
        $this->goals = 0;
        $this->yellowCards = 0;
        $this->hasRedCard = false;
        $this->position = $position;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInMinute(): int
    {
        return $this->inMinute;
    }

    public function getOutMinute(): int
    {
        return $this->outMinute;
    }

    public function isPlay(): bool
    {
        return $this->playStatus === self::PLAY_PLAY_STATUS;
    }

    public function getPlayTime(): int
    {
        if(!$this->outMinute) {
            return 0;
        }

        return $this->outMinute - $this->inMinute;
    }

    public function goToPlay(int $minute): void
    {
        $this->inMinute = $minute;
        $this->playStatus = self::PLAY_PLAY_STATUS;
    }

    public function goToBench(int $minute): void
    {
        $this->outMinute = $minute;
        $this->playStatus = self::BENCH_PLAY_STATUS;
    }

    public function addGoal(): void
    {
        $this->goals += 1;
    }

    public function getGoals(): int
    {
        return $this->goals;
    }

    public function addYellowCard(): void
    {
        $this->yellowCards += 1;
    }

    public function getYellowCards(): int
    {
        return $this->yellowCards;
    }

    public function addRedCard()
    {
        $this->hasRedCard = true;
    }

    public function hasRedCard(): bool
    {
        return $this->hasRedCard;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}
