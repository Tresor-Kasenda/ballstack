<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Inputs;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;
use Tresorkasenda\Contracts\HasChecked;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\GenericForms;

class CheckboxInput extends GenericForms implements Htmlable
{
    use HasChecked;
    use HasEvaluated;
    use HasLabel;
    use HasRequired;

    protected string $uniqueId;

    protected string|null $tooltip = null;

    public function __construct(
        protected ?string $name
    ) {
        $this->uniqueId = uniqid('checkbox-'.$this->name, true);
    }

    public static function make(?string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    public function getUniqueId(): string
    {
        return $this->evaluate($this->uniqueId);
    }

    public function tooltip(string $tooltip): static
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    public function getTooltip(): string|null
    {
        return $this->evaluate($this->tooltip);
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
        return view('components.forms.checkbox', $this->extractPublicMethods());
    }
}
