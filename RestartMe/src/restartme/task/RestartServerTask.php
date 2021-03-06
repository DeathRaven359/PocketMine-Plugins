<?php

namespace restartme\task;

use pocketmine\scheduler\PluginTask;
use restartme\RestartMe;

class RestartServerTask extends PluginTask{
    /** @var RestartMe */
    private $plugin;
    public function __construct(RestartMe $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }
    /** 
     * @return RestartMe 
     */
    public function getPlugin(){
        return $this->plugin;
    }
    public function onRun($currentTick){
        if(!$this->getPlugin()->isTimerPaused()) return;
        $this->getPlugin()->subtractTime(1);
        if($this->getPlugin()->getTime() <= $this->getPlugin()->getConfig()->getNested("restart.startCountdown")){
            $this->getPlugin()->broadcastTime($this->getPlugin()->getConfig()->getNested("restart.displayType"));
        }
        if($this->getPlugin()->getTime() < 1){
            $this->getPlugin()->initiateRestart(RestartMe::TYPE_NORMAL);
        }
    }
}