<?php

namespace Version;

use DirectoryIterator;

class Version
{
    public static function getVersion(): ?string
    {
        $self = new self();
        $dir = __DIR__;
        $version = null;

        if (!$version = $self->getJsonVersion($dir, 'composer.json')) {
            $version = $self->getJsonVersion($dir, 'package.json');
        }

        return $version;
    }

    public function getJsonVersion($dir, $filename)
    {
        static $version = null;

        if (!$dir instanceof DirectoryIterator) {
            $dir = new DirectoryIterator((string) $dir);
        }

        foreach ($dir as $node) {
            if (!$node->isDot() && $node->isFile() && $filename == strtolower($node->getFilename())) {
                $arrayResult = json_decode(file_get_contents($node->getPathName()), true);
                if (is_array($arrayResult) && array_key_exists('version', $arrayResult)) {
                    $version = $arrayResult['version'];
                }
            }
        }

        if (empty($version)) {
            $dir = dirname($node->getPath());
            if (!empty($dir) && is_dir($dir) && !in_array($dir, ['\\', '/'])) {
                $this->getJsonVersion($dir, $filename);
            }
        }

        return $version;
    }
}
