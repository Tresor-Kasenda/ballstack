<?php

declare(strict_types=1);

namespace Tresorkasenda\Tabs;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;
use ReflectionClass;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;
use Tresorkasenda\Forms\GenericForms;

class Tab extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    protected Closure|array|null $schema = [];
    private string|Closure|null $icon = null;
    private string|Closure|null $position = null;
    private Closure|int|null $column = null;

    public function __construct(
        protected string $name
    ) {
    }

    public static function make(string $name)
    {
        return app(static::class, ['name' => $name]);
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
        return view('ballstack::sections.tab', $this->extractPublicMethods());
    }

    public function schema(array|Closure|null $schema): static
    {
        $instance = new ReflectionClass($this);
        $parentClass = $instance
            ->getParentClass()
            ->getName();

        $this->schema = array_map(function ($schema) use ($parentClass) {
            if ($schema instanceof GenericForms || $schema instanceof Component) {
                return $schema;
            }

            throw new InvalidArgumentException("Invalid must be instance of {$parentClass}.");
        }, $schema);

        return $this;
    }

    public function getName()
    {
        return $this->evaluate($this->name);
    }

    public function icon(string|Closure|null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function position(string|Closure|null $position = 'left'): static
    {
        $this->position = $position;

        return $this;
    }

    public function column(int|Closure|null $column = 1): static
    {
        $this->column = $column;

        return $this;
    }

    public function getColumn(): ?int
    {
        return $this->evaluate($this->column);
    }

    public function getPosition(): ?string
    {
        return $this->evaluate($this->position);
    }

    public function getIcon(): string|Closure|null
    {
        return $this->evaluate($this->icon);
    }

    public function getSchema(): array
    {
        return array_map(fn ($item) => $item, $this->schema);
    }
}
