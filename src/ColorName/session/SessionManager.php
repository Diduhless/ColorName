<?php

declare(strict_types=1);

namespace ColorName\session;


use ColorName\ColorName;
use pocketmine\Player;

class SessionManager {

    /** @var ColorName */
    private $plugin;

    /** @var Session[] */
    private $sessions = [];

    /**
     * SessionManager constructor.
     * @param ColorName $plugin
     */
    public function __construct(ColorName $plugin) {
        $this->plugin = $plugin;
        $this->registerEvents();
    }

    /**
     * @param Player $player
     * @return Session|null
     */
    public function getSession(Player $player): ?Session {
        return $this->sessions[$player->getName()] ?? null;
    }

    /**
     * @param Player $player
     */
    public function openSession(Player $player): void {
        $this->sessions[$username = $player->getName()] = new Session($player);
        $this->plugin->getProvider()->loadSession($this->sessions[$username]);
    }

    /**
     * @param Player $player
     */
    public function closeSession(Player $player): void {
        if(isset($this->sessions[$username = $player->getName()])) {
            $session = $this->sessions[$username];
            $this->plugin->getProvider()->saveSession($session);
            unset($session);
        }
    }

    private function registerEvents(): void {
        $this->plugin->getServer()->getPluginManager()->registerEvents(new SessionListener($this), $this->plugin);
    }

}