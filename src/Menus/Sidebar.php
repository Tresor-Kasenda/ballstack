<?php

declare(strict_types=1);

namespace Tresorkasenda\Menus;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Traits\Macroable;
use Illuminate\View\Component;
use InvalidArgumentException;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;
use Tresorkasenda\Contracts\HasIcons;
use Tresorkasenda\Contracts\HasImage;
use Tresorkasenda\Menus\Links\LinkItems;

class Sidebar extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;
    use HasIcons;
    use HasImage;
    use Macroable;

    protected string|Closure|null $theme;

    protected string $route;

    protected array $items = [];

    public function __construct(
        protected ?string $name = null
    ) {
    }

    public static function make(string $name = null): self
    {
        return new static($name);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('ballstack::sidebar.sidebar', $this->extractPublicMethods());
    }


    public function route(string|Route $route): static
    {
        if ( ! Route::has($route)) {
            throw new InvalidArgumentException('The provided route does not exist.');
        }
        $this->route = $route;

        return $this;
    }

    public function getRoute(): string
    {
        return route($this->route);
    }

    public function items(array $items): static
    {
        $this->items = array_map(function ($item) {
            if ($item instanceof LinkItems) {
                return $item;
            }
            throw new InvalidArgumentException('Invalid must be instance of Link.');
        }, $items);

        return $this;
    }

    public function getItems(): array
    {
        return array_map(fn ($item) => $item, $this->items);
    }

    public function theme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): Closure|string|null
    {
        return $this->theme;
    }
}
