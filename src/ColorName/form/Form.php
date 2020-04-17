<?php

## THIS FORM API IS NOT MINE, ALL THE CREDITS GO TO jojoe77777
## THE ORIGINAL API CAN BE DOWNLOADED AT https://github.com/jojoe77777/FormAPI

declare(strict_types=1);

namespace ColorName\form;


use pocketmine\Player;

abstract class Form implements \pocketmine\form\Form {

    /** @var array */
    protected $data = [];

    /** @var callable|null */
    private $callable;

    /**
     * @param callable|null $callable
     */
    public function __construct(?callable $callable) {
        $this->callable = $callable;
    }

    /**
     * @return callable|null
     */
    public function getCallable() : ?callable {
        return $this->callable;
    }

    /**
     * @param callable|null $callable
     */
    public function setCallable(?callable $callable) {
        $this->callable = $callable;
    }

    /**
     * @param Player $player
     * @param mixed $data
     */
    public function handleResponse(Player $player, $data) : void {
        $this->processData($data);
        $callable = $this->getCallable();
        if($callable !== null) {
            $callable($player, $data);
        }
    }

    public function processData(&$data) : void { }

    public function jsonSerialize(){
        return $this->data;
    }

}