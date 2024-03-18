<?php

declare(strict_types=1);

namespace App\View\TallFlex\Menus\Links;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;
use Throwable;

class LinkItems extends Component implements Htmlable
{
    public string|Closure|null $icon = null;
    public string|null $active = null;
    public array $children = [];
    public string $route;

    public function __construct(
        public ?string $name = null
    ) {
    }

    public static function make(string $name): self
    {
        return new static($name);
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function route(string $route): static
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

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): Closure|string|null
    {
        return $this->icon;
    }

    public function children(array $children): static
    {
        $this->children = array_map(function ($child) {
            if ($child instanceof LinkItems) {
                return $child;
            }
            throw new InvalidArgumentException('Invalid must be instance of Link.');
        }, $children);

        return $this;
    }

    public function getChildren(): array
    {
        return array_map(fn ($child) => $child, $this->children);
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
        return view('components.sidebar.link-items', $this->extractPublicMethods());
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
