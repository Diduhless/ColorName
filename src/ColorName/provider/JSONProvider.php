<?php

declare(strict_types=1);

namespace ColorName\provider;


use ColorName\ColorName;
use ColorName\session\Session;
use pocketmine\Player;
use pocketmine\utils\Config;

class JSONProvider {

    /** @var ColorName */
    private $plugin;

    /**
     * JSONProvider constructor.
     * @param ColorName $plugin
     */
    public function __construct(ColorName $plugin) {
        $this->plugin = $plugin;
        $this->createDataFolder();
    }

    /**
     * @param Player $player
     * @return Config
     */
    public function getUserConfig(Player $player): Config {
        return new Config(
            $this->plugin->getDataFolder() . "users/" .
            strtolower($player->getName()) . ".json", Config::JSON,
            ["color" => 0]
        );
    }

    /**
     * @param Session $session
     */
    public function loadSession(Session $session): void {
        $session->setColor((int) $this->getUserConfig($session->getPlayer())->get("color"));
    }

    /**
     * @param Session $session
     */
    public function saveSession(Session $session): void {
        $config = $this->getUserConfig($session->getPlayer());
        $config->set("color", $session->getColor());
        $config->save();
    }


    private function createDataFolder(): void {
        $dataFolder = $this->plugin->getDataFolder();
        if(!is_dir($dataFolder . "users")) {
            mkdir($dataFolder . "users");
        }
    }

}