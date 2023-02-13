<?php

declare(strict_types=1);

namespace Serialization;

use Logger\Logger;
use RuntimeException;

final class Serializer
{
    private mixed $stream;

    private string $ext;

    public function __construct(
        private string $filename,
        bool $json = false
    ) {
        $this->filename .= ($json) ? '.json' : '.bin';

        $this->ext = explode('.', $this->filename)[1];

        $directory = dirname(__DIR__, 2) . '/tmp/';

        $subdirectory = ($this->ext === 'json') ? 'json/' : 'bin/';

        $file = $this->filename;

        $this->filename = $directory . $subdirectory . $file;

        $this->stream = fopen($this->filename, 'w+');
    }

    public function export(Serializable $object): void
    {
        try {
            $data = ($this->ext === 'json') ? JSON::encode($object) : serialize($object);

            fwrite($this->stream, $data);
        } catch (RuntimeException $exception) {
            Logger::log($exception->getMessage(), Logger::ERROR);
        }
    }

    public function import(): mixed
    {
        $data = file_get_contents($this->filename);

        if ($this->ext === 'json') {
            try {
                return JSON::decode($data);
            } catch (RuntimeException $exception) {
                Logger::log($exception->getMessage(), Logger::ERROR);
            }
        }

        return unserialize($data);
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}
