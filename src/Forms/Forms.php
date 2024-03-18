<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;
use Throwable;

class Forms extends GenericForms implements Htmlable
{
    protected array $schema = [];

    protected string|null $route = null;

    protected int|Closure|null $column = 0;

    public function __construct(
        protected ?string $name
    ) {
    }

    public static function make(string $name = null): static
    {
        return new static($name);
    }

    public function schema(array $schema): static
    {
        $this->schema = array_map(function ($schema) {
            if ($schema instanceof GenericForms || $schema instanceof Component) {
                return $schema;
            }
            throw new InvalidArgumentException('Invalid must be instance of GenerateForms.');
        }, $schema);

        return $this;
    }

    public function getSchema(): array
    {
        return array_map(fn ($item) => $item, $this->schema);
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
        return view('components.forms.form-builder', $this->extractPublicMethods());
    }

    public function action(string $route): static
    {
        if ( ! Route::has($route)) {
            throw new InvalidArgumentException('The provided route does not exist.');
        }
        $this->route = $route;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route ?? "";
    }

    public function hasColumn(): bool
    {
        return isset($this->column);
    }

    public function hasSection(): bool
    {
        return isset($this->schema);
    }

    public function column(int $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getColumn(): int|Closure|null
    {
        return $this->column;
    }
}
