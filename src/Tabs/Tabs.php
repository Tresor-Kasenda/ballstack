<?php

declare(strict_types=1);

namespace Tresorkasenda\Tabs;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

class Tabs extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    protected Closure|array|null $schema = [];
    protected Closure|string|null $alignment = null;

    public function __construct(
        protected string $name
    ) {
    }

    public static function make(string|null $name = '')
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName()
    {
        return $this->evaluate($this->name);
    }

    /**
     * @throws Throwable
     */
    #[Override]
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    #[Override]
    public function render(): View
    {
        return view('ballstack::sections.tabs', $this->extractPublicMethods());
    }

    public function schemas(array|Closure|null $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function getSchemas(): array
    {
        return $this->evaluate($this->schema);
    }

    public function alignment(string|Closure|null $alignment = 'horizontal'): static
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function getAlignment()
    {
        return $this->evaluate($this->alignment);
    }
}
