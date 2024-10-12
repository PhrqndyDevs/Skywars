<?php

namespace SkyWars\Utils;

use pocketmine\utils\Config;

class ConfigLoader {

    public static function load(string $filePath): Config {
        return new Config($filePath, Config::YAML);
    }
}
?>
