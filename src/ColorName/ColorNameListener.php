<?php

declare(strict_types=1);

namespace ColorName;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class ColorNameListener implements Listener {

    /** @var ColorName */
    private $plugin;

    /**
     * ColorNameListener constructor.
     * @param ColorName $plugin
     */
    public function __construct(ColorName $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param PlayerJoinEvent $event
     */
    public function onJoin(PlayerJoinEvent $event): void {
        $this->plugin->getSessionManager()->getSession($event->getPlayer())->setColorName();
    }

}