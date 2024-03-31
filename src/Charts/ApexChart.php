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

class ApexChart extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    /**
     * @var Closure|array|null
     */
    protected Closure|array|null $categories = [];

    /**
     * @var Closure|string|null
     */
    protected Closure|string|null $color = null;

    protected Closure|bool|null $dataLabel = false;

    protected Closure|array|null $dataset = [];

    protected Closure|int|null $height = null;

    protected Closure|string|null $stroke = null;

    protected string|Closure|null $type = null;

    public function __construct(
        protected ?string $name
    ) {
    }

    public static function make(string $name = null): static
    {
        return new static($name);
    }

    public function stroke(string|Closure|null $stroke = 'smooth'): static
    {
        $this->stroke = $stroke;

        return $this;
    }

    public function categories(array|Closure|null $categories = []): static
    {
        $this->categories = $categories;

        return $this;
    }

    public function getCategories(): ?array
    {
        return $this->evaluate($this->categories);
    }

    public function getStroke(): ?string
    {
        return $this->evaluate($this->stroke);
    }

    public function getName(): ?string
    {
        return $this->evaluate($this->name);
    }

    public function height(int|Closure|null $height = 300): static
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->evaluate($this->height);
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

    public function dataLabel(bool|Closure|null $dataLabel = true): static
    {
        $this->dataLabel = $dataLabel;

        return $this;
    }

    public function getDataLabel(): ?bool
    {
        return (bool)$this->evaluate($this->dataLabel);
    }

    public function datasets(array|Closure|null $datasets): static
    {
        $this->dataset = $datasets;

        return $this;
    }

    public function getDataset(): ?array
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
        return view('ballstack::charts.apex-chart', $this->extractPublicMethods());
    }
}
