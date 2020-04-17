<?php

declare(strict_types=1);

namespace ColorName\command;


use ColorName\ColorName;
use ColorName\form\Form;
use ColorName\form\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class ColorCommand extends Command {

    /** @var ColorName */
    private $plugin;

    /**
     * ColorCommand constructor.
     * @param ColorName $plugin
     */
    public function __construct(ColorName $plugin) {
        $this->plugin = $plugin;
        parent::__construct("color", "Changes your nametag color");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($sender instanceof Player) {
            $sender->sendForm($this->getColorCommandForm());
        }
    }

    /**
     * @return SimpleForm
     */
    private function getColorCommandForm(): SimpleForm {
        $form = new SimpleForm(function (Player $player, int $result) {
            $session = $this->plugin->getSessionManager()->getSession($player);

            if($result != null) {
                $session->setColor($result);
                $player->sendMessage(TF::GREEN . "Your color has been updated!");
            }
        });

        $form->setTitle(TF::AQUA . "Choose your new color");
        $form->addButton(TF::BLACK . "Black");
        $form->addButton(TF::DARK_BLUE . "Dark Blue");
        $form->addButton(TF::DARK_GREEN . "Dark Green");
        $form->addButton(TF::DARK_AQUA . "Dark Aqua");
        $form->addButton(TF::DARK_RED . "Dark Red");
        $form->addButton(TF::DARK_PURPLE . "Dark Purple");
        $form->addButton(TF::GOLD . "Gold");
        $form->addButton(TF::GRAY . "Gray");
        $form->addButton(TF::DARK_GRAY . "Dark Gray");
        $form->addButton(TF::BLUE . "Blue");
        $form->addButton(TF::GREEN . "Green");
        $form->addButton(TF::AQUA . "Aqua");
        $form->addButton(TF::RED . "Red");
        $form->addButton(TF::LIGHT_PURPLE . "Light Purple");
        $form->addButton(TF::YELLOW . "Yellow");
        $form->addButton(TF::WHITE . "White");

        return $form;
    }

}