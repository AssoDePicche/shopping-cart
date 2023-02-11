<?php

declare(strict_types=1);

namespace Util\Contract;

interface ObjectStatusHandler
{
    public function export(object $object): void;

    public function import(): mixed;
}
