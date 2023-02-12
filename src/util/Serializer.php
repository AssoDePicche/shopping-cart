<?php

declare(strict_types=1);

namespace Util;

final class Serializer
{
    private mixed $stream;

    private string $ext;

    public function __construct(
        private string $filename
    ) {
        $hasExt = explode('.', $this->filename);

        $this->ext = $hasExt[1] ?? 'bin';

        $this->filename .= '.bin';

        $this->stream = fopen($this->filename, 'w+');
    }

    public function export(object $object): void
    {
        $data = ($this->ext === 'json') ? JsonParser::encode($object) : serialize($object);

        fwrite($this->stream, $data);
    }

    public function import(): mixed
    {
        $data = file_get_contents($this->filename);

        if ($this->ext === 'json') {
            return JsonParser::decode($data);
        }

        return unserialize($data);
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}
