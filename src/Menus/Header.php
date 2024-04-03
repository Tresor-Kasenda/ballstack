<?php

declare(strict_types=1);

namespace Tresorkasenda\Menus;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use Livewire\Component;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;
use Tresorkasenda\Contracts\HasImage;
use Tresorkasenda\Forms\FormComponent;

class Header extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;
    use HasImage;

    protected bool|Closure|null $notification = false;

    protected bool|Closure|null $searchable = false;

    protected string|Closure|null $theme;

    protected string|Closure|null $route;

    protected array|Closure|Collection|Arrayable|null $items = [];

    public function __construct(
        public ?string $name = null
    )
    {
    }

    public static function make(?string $name = null): static
    {
        return new static($name);
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
        return view('ballstack::sidebar.header', $this->extractPublicMethods());
    }

    public function isNotify(bool|Closure|null $state): static
    {
        $this->notification = $state;

        return $this;
    }

    public function route(string|Closure|null $route): static
    {
        if (!Route::has($route)) {
            throw new InvalidArgumentException('The provided route does not exist.');
        }
        $this->route = $route;

        return $this;
    }

    public function searchable(bool|Closure|null $searchable = true): static
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function isSearchable(): ?bool
    {
        return $this->evaluate($this->searchable);
    }

    public function getRoute(): string
    {
        return route($this->route);
    }

    public function getNotify(): bool
    {
        return $this->evaluate($this->notification);
    }

    public function items(array|Closure|Collection|Arrayable|null $items): static
    {
        $this->items = array_map(function ($item) {
            if ($item instanceof FormComponent || $item instanceof \Illuminate\View\Component) {
                return $item;
            }
            throw new InvalidArgumentException('Invalid must be instance of Link.');
        }, $items);

        return $this;
    }

    public function getItems(): array
    {
        return array_map(fn($item) => $item, $this->items);
    }

    public function theme(string|Closure|null $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->evaluate($this->theme);
    }
}
