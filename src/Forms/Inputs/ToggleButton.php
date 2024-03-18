<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms\Inputs;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasExtractPublicMethods;
use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasRequired;
use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;

/**
 * Class AdvancedControl
 *
 * The AdvancedControl class extends the GenericForms class and implements the Htmlable interface.
 * It provides methods for creating and managing advanced form controls.
 *
 * @package App\View\TallFlex\Forms\Inputs
 */
class ToggleButton extends GenericForms implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;
    use HasLabel;
    use HasRequired;

    protected string|Closure|null $mode = null;

    protected array|Closure|null $icons = [];

    protected Closure|string|null $description = null;

    protected Closure|bool $disabled = false;

    protected array|Closure|null $options = [];
    private Closure|bool $multiple = false;

    public function __construct(
        protected string $name
    )
    {
    }

    public static function make(?string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    public function mode(string|Closure|null $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMode(): string|null
    {
        return $this->evaluate($this->mode);
    }

    public function icons(array|Closure|null $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    public function getIcons(): array
    {
        return $this->evaluate($this->icons);
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
        return view('components.forms.advanced-control', $this->extractPublicMethods());
    }

    public function description(string|Closure|null $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function multiple(bool|Closure $multiple = true): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->evaluate($this->multiple);
    }

    public function getDescription(): string
    {
        return $this->evaluate($this->description);
    }

    public function disabled(bool|Closure $disabled = true): static
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function isDisabled(): bool
    {
        return $this->evaluate($this->disabled);
    }

    public function options(array|Closure|null $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array|Closure|null
    {
        return $this->evaluate($this->options);
    }
}
