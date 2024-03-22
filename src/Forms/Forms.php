<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;
use Throwable;

class Forms extends GenericForms implements Htmlable
{
    protected array|Closure|null $schema = [];

    protected string|Closure|null $route = null;

    protected int|Closure|null $column = 0;

    protected bool|Closure|null $hasCard = false;

    public function __construct(
        protected ?string $name = null
    )
    {
    }

    public static function make(string $name = null): static
    {
        return new static($name);
    }

    public function schema(array|Closure|null $schema): static
    {
        $this->schema = array_map(function ($schema) {
            if ($schema instanceof GenericForms || $schema instanceof Component) {
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

    /**
     * @throws Throwable
     */
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('ballstack::forms.form-builder', $this->extractPublicMethods());
    }

    public function action(string|Closure|null $route): static
    {
        if (!Route::has($route)) {
            throw new InvalidArgumentException('The provided route does not exist.');
        }
        $this->route = $route;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route ?? "";
    }

    public function column(int|Closure|null $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getColumn(): int|Closure|null
    {
        return $this->column;
    }

    public function hasCard(bool|Closure|null $hasCard = true): static
    {
        $this->hasCard = $hasCard;

        return $this;
    }

    public function isCard(): ?bool
    {
        return $this->evaluate($this->hasCard);
    }
}
