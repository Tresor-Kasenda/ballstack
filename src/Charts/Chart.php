<?php

declare(strict_types=1);

namespace Tresorkasenda\Charts;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

class Chart extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    protected array|string|Closure|null $backgroundColor = null;

    protected array|Closure|string|null $borderColor = null;

    protected Closure|array|null $dataset = [];

    protected Closure|string|null $label = null;

    protected string|Closure|null $type = null;

    public function __construct(
        protected ?string $name
    ) {
    }

    public static function make(string $name = null): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName(): ?string
    {
        return $this->evaluate($this->name);
    }

    public function label(string|Closure|null $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->evaluate($this->label);
    }

    public function type(string|Closure|null $type = 'line'): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->evaluate($this->type);
    }

    public function datasets(array|Closure|null $dataset): static
    {
        $this->dataset = $dataset;

        return $this;
    }

    public function backgroundColor(array|string|Closure|null $backgroundColor): static
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->evaluate($this->backgroundColor);
    }

    public function borderColor(array|string|Closure|null $borderColor): static
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->evaluate($this->borderColor);
    }

    public function getDataset(): array
    {
        return $this->evaluate($this->dataset);
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
        return view('ballstack::charts.chart', $this->extractPublicMethods());
    }
}
