<?php

namespace easymessages\task;

use easymessages\EasyMessages;
use pocketmine\scheduler\PluginTask;

class BlinkingPopupTask extends PluginTask{
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
        $this->getPlugin()->broadcastPopup($this->getPlugin()->getConfig()->getNested("popup.blinkingMessage"));
    }
}
