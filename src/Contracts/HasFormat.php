<?php

declare(strict_types=1);

namespace App\View\TallFlex\Contracts;

trait HasFormat
{
    protected string|null $format = null;

    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->evaluate($this->format) ?? "Y-m-d";
    }
}
