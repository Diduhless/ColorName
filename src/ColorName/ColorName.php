<?php

declare(strict_types=1);

namespace ColorName;


use ColorName\command\ColorCommand;
use ColorName\provider\JSONProvider;
use ColorName\session\SessionManager;
use pocketmine\plugin\PluginBase;

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