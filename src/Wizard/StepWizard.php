<?php

declare(strict_types=1);

namespace Tresorkasenda\Wizard;

use Closure;
use Tresorkasenda\Forms\Field;

class StepWizard extends Field
{
    protected string|Closure|null $description = null;

    protected Closure|array|null $schema = [];

    protected Closure|int|null $column = null;

    protected Closure|string|null $icon = null;

    protected string $view = "ballstack::forms.wizard.step";

    public function description(string|Closure|null $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->evaluate($this->description);
    }

    public function column(int|Closure|null $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getColumn(): ?int
    {
        return $this->evaluate($this->column);
    }

    public function schema(array|Closure|null $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function getSchema(): ?array
    {
        return $this->evaluate($this->schema);
    }

    public function icon(string|Closure|null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->evaluate($this->icon);
    }
}
