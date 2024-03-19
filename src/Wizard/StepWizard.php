<?php

declare(strict_types=1);

namespace Tresorkasenda\Wizard;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Forms\GenericForms;

class StepWizard extends GenericForms implements Htmlable
{
    protected string|Closure|null $description = null;

    protected Closure|array|null $schema = [];

    protected Closure|int|null $column = null;

    protected Closure|string|null $icon = null;

    public function __construct(
        protected ?string $name
    )
    {
    }

    #[Override]
    public static function make(?string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    /**
     * @inheritDoc
     * @throws Throwable
     */
    #[Override]
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('ballstack::forms.wizard.step', $this->extractPublicMethods());
    }

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

    public function getName(): ?string
    {
        return $this->evaluate($this->name);
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
