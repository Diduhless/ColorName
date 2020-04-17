<?php

declare(strict_types=1);

namespace ColorName\session;


use pocketmine\Player;

class Session {

    /** @var Player */
    private $player;

    /** @var int|string */
    private $color;

    /**
     * Session constructor.
     * @param Player $player
     */
    public function __construct(Player $player) {
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player {
        return $this->player;
    }

    /**
     * @return int|string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @param int|string $color
     */
    public function setColor($color): void {
        $this->color = $color;
    }

    public function setColorName(): void {
        $this->player->setNameTag("§" . $this->color . $this->player->getName());
    }

}