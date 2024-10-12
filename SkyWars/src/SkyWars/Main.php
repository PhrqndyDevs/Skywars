<?php

namespace SkyWars;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use SkyWars\Command\StartGameCommand;
use SkyWars\Command\EndGameCommand;
use SkyWars\Command\SpectateCommand;
use SkyWars\Command\JoinCommand;
use SkyWars\Command\LeaveCommand;
use SkyWars\Command\KitCommand;
use SkyWars\Command\LeaderboardCommand;
use SkyWars\Utils\ConfigLoader;
use SkyWars\Utils\ChestLoot;
use SkyWars\Utils\UI;
use pocketmine\entity\Entity;
use SkyWars\Items\ThrowablePumpkin;
use SkyWars\Task\SaveStatsTask;
use SkyWars\Task\DailyQuestTask;
use SkyWars\OreDrops;

class Main extends PluginBase implements Listener {

    private $arena;
    private $kit;
    private $game;
    private $playerManager;
    private $currencyManager;
    private $achievementManager;
    private $oreDrops;

    public function onEnable(): void {
        // Load configurations
        $this->loadConfigurations();

        // Load arena data
        $arenaData = ConfigLoader::load($this->getDataFolder() . "arenas.yml")->getAll();
        $this->arena = new Arena($arenaData['arenas'][0]); // Using the first arena as an example

        // Initialize core components
        $this->kit = new Kit($this);
        $this->game = new Game($this, $this->arena);
        $this->playerManager = new PlayerManager($this);
        $this->currencyManager = new CurrencyManager($this);
        $this->achievementManager = new AchievementManager($this);
        $this->oreDrops = new OreDrops($this);

        // Initialize loot system
        ChestLoot::init($this->getDataFolder() . "loot.yml");

        // Register custom entity
        Entity::registerEntity(ThrowablePumpkin::class, true);

        // Register commands
        $this->getServer()->getCommandMap()->registerAll("skywars", [
            new StartGameCommand($this),
            new EndGameCommand($this),
            new SpectateCommand($this),
            new JoinCommand($this),
            new LeaveCommand($this),
            new KitCommand($this),
            new LeaderboardCommand($this)
        ]);

        // Register event listeners
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents($this->oreDrops, $this);
        $this->getLogger()->info("SkyWars Halloween Edition enabled!");

        // Schedule recurring tasks
        $this->getScheduler()->scheduleRepeatingTask(new SaveStatsTask($this), 1200); // Save stats every minute
        $this->getScheduler()->scheduleRepeatingTask(new DailyQuestTask($this), 72000); // Reset daily quests every day
    }

    private function loadConfigurations(): void {
        if (!is_dir($this->getDataFolder())) {
            mkdir($this->getDataFolder());
        }
        $this->saveResource("config.yml");
        $this->saveResource("arenas.yml");
        $this->saveResource("kits.yml");
        $this->saveResource("loot.yml");

        ConfigLoader::load($this->getDataFolder() . "config.yml");
        ConfigLoader::load($this->getDataFolder() . "arenas.yml");
        ConfigLoader::load($this->getDataFolder() . "kits.yml");
        ConfigLoader::load($this->getDataFolder() . "loot.yml");
    }
}
?>
