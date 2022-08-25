<?php

declare(strict_types=1);

namespace Pixel\AntiVoid\Listener;

use pocketmine\level\Level;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use Pixel\AntiVoid\Core\Main;

class VoidListener implements Listener
{
    private $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onPlayerMove(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        $level = $plugin->$config->get("world");
        
        if ($player.getY() < (double)$plugin->config->get("pos.minY"))
        {
            if (!($plugin->config->get("pos.safe_spawn")))
            {
                $player.teleport((double)$plugin->config->get("pos.x"),(double)$plugin->config->get("pos.y"), (double)$plugin->config->get("pos.z"), $level);
            }
            else 
            {
                $player.teleport($level->getSafeSpawn());
            }
        }
    }
}
?>