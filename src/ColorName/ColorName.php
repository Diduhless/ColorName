<?php

declare(strict_types=1);

namespace ColorName;


use ColorName\command\ColorCommand;
use ColorName\provider\JSONProvider;
use ColorName\session\SessionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class ColorName extends PluginBase {

    /** @var SessionManager */
    private $sessionManager;

    /** @var JSONProvider */
    private $provider;

    public function onEnable() {
        $this->sessionManager = new SessionManager($this);
        $this->provider = new JSONProvider($this);

        $server = $this->getServer();
        $server->getCommandMap()->register("color", new ColorCommand($this));
        $server->getPluginManager()->registerEvents(new ColorNameListener($this), $this);

        $this->getLogger()->info(TextFormat::LIGHT_PURPLE . "ColorName has been enabled! Kindly support this creator ^^ (twitter.com/Diduhless)");
    }

    /**
     * @return SessionManager
     */
    public function getSessionManager(): SessionManager {
        return $this->sessionManager;
    }

    /**
     * @return JSONProvider
     */
    public function getProvider(): JSONProvider {
        return $this->provider;
    }

}