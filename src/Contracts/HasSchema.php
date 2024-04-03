<?php

namespace Tresorkasenda\Contracts;

use Closure;
use Illuminate\View\Component as BaseComponent;
use InvalidArgumentException;
use Livewire\Component;

trait HasSchema
{
    protected array|Closure|null $schema = [];

    public function schema(array|Closure|null $schema): static
    {
        $this->schema = array_map(function ($schema) {
            if ($schema instanceof BaseComponent || $schema instanceof Component) {
                return $schema;
            }
            throw new InvalidArgumentException('Invalid must be instance of GenerateForms.');
        }, $schema);

        return $this;
    }

    public function getSchema(): ?array
    {
        return $this->evaluate($this->schema);
    }
}
