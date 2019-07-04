<?php

namespace Version;

class Version
{
    public static function getVersion(): string
    {
        // Try to find a composer.json file in the current directory, then the parent, then the parent, etc until it is found
        // parse the composer.json, and return the `version` key (i.e. `1.1.0`)
        // If no composer.json is found, try the same for a package.json
    }
}
