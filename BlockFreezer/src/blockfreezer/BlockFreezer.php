<?php

namespace blockfreezer;

use pocketmine\block\Block;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class BlockFreezer extends PluginBase implements Listener{
    public function onEnable(){
        $this->saveFiles();
        $this->registerAll();
    }
    private function saveFiles(){
        if(file_exists($this->getDataFolder()."config.yml")){
            if($this->getConfig()->get("version") !== $this->getDescription()->getVersion() or !$this->getConfig()->exists("version")){
		$this->getServer()->getLogger()->warning("An invalid configuration file for ".$this->getDescription()->getName()." was detected.");
		if($this->getConfig()->getNested("plugin.autoUpdate") === true){
		    $this->saveResource("config.yml", true);
                    $this->getServer()->getLogger()->warning("Successfully updated the configuration file for ".$this->getDescription()->getName()." to v".$this->getDescription()->getVersion().".");
		}
	    }  
        }
        else{
            $this->saveDefaultConfig();
        }
    }
    private function registerAll(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    /**
     * @param Block $block
     * @return bool
     */
    private function isBlockSpecified(Block $block){
        $key = array_change_key_case($this->getConfig()->getNested("level.".$block->getLevel()->getName()), CASE_LOWER);
    	if(is_array($key)) return in_array($block->getId().":".$block->getDamage(), $key);	
    }
    /** 
     * @param BlockUpdateEvent $event 
     */
    public function onBlockUpdate(BlockUpdateEvent $event){
	if($this->isBlockSpecified($event->getBlock())){
	    $event->setCancelled(true);
	}
    }
}
