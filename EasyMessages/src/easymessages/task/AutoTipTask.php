<?php

namespace easymessages\task;

use easymessages\EasyMessages;
use pocketmine\scheduler\PluginTask;

class AutoTipTask extends PluginTask{
    /** @var EasyMessages */
    private $plugin;
    public function __construct(EasyMessages $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }
    /** 
     * @return EasyMessages 
     */
    public function getPlugin(){
        return $this->plugin;
    }
    public function onRun($currentTick){
        $this->getPlugin()->broadcastTip($this->getPlugin()->getRandomMessage($this->getPlugin()->getConfig()->getNested("tip.autoMessages")));
    }
}
