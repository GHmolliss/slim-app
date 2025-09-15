<?php

declare(strict_types=1);

namespace App\Domain;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class Builder
{
    protected function buildSymfonyStyle(): SymfonyStyle
    {
        $input = new ArgvInput();
        $output = new ConsoleOutput();

        return new SymfonyStyle($input, $output);
    }
}
