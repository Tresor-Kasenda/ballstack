<?php

declare(strict_types=1);

namespace App\View\TallFlex\Menus;

use App\View\TallFlex\Contracts\HasExtractPublicMethods;
use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use Livewire\Component;
use Throwable;

class Header extends Component implements Htmlable
{
    use HasExtractPublicMethods;

    protected bool $notification = false;

    protected string|Closure|null $logo = '';

    protected string|Closure|null $theme;

    protected string|Closure|null $icon;

    protected string $route;

    protected array $items = [];

    public function __construct(
        public ?string $name = null
    )
    {
    }

    public static function make(?string $name): static
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
        return view('components.sidebar.header', $this->extractPublicMethods());
    }

    public function logo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLogo(): Closure|string|null
    {
        if ($this->logo && file_exists(public_path($this->logo))) {
            return $this->logo;
        }
        return asset('assets/images/logo.jpg');
    }

    public function isNotify(bool $state): static
    {
        $this->notification = $state;

        return $this;
    }

    public function route(string $route): static
    {
        if (!Route::has($route)) {
            throw new InvalidArgumentException('The provided route does not exist.');
        }
        $this->route = $route;

        return $this;
    }

    public function getRoute(): string
    {
        return route($this->route);
    }

    public function getNotify(): bool
    {
        return $this->notification;
    }

    public function items(array $items): static
    {
        $this->items = array_map(function ($item) {
            if ($item instanceof GenericForms || $item instanceof \Illuminate\View\Component) {
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

    public function theme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): Closure|string|null
    {
        return $this->theme;
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): Closure|string|null
    {
        return $this->icon;
    }
}
