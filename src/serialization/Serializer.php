<?php

declare(strict_types=1);

namespace Serialization;

final class Serializer
{
    private mixed $stream;

    private string $ext;

    public function __construct(
        private string $filename
    ) {
        $hasExt = explode('.', $this->filename);

        if ($hasExt[1] === false) {
            $this->ext = 'bin';

            $this->filename .= '.bin';
        } else {
            $this->ext = $hasExt[1];
        }

        $this->stream = fopen($this->filename, 'w+');
    }

    public function export(Serializable $object): void
    {
        $data = ($this->ext === 'json') ? JSON::encode($object) : serialize($object);

        fwrite($this->stream, $data);
    }

    public function import(): mixed
    {
        $data = file_get_contents($this->filename);

        if ($this->ext === 'json') {
            return JSON::decode($data);
        }

        return unserialize($data);
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}
