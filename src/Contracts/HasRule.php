<?php

declare(strict_types=1);

namespace Tresorkasenda\Contracts;

trait HasRule
{
    protected array $rules = [];

    public function rules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
