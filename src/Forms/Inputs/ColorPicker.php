<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Inputs;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\GenericForms;

class ColorPicker extends GenericForms implements Htmlable
{
    use HasEvaluated;
    use HasLabel;
    use HasPlaceholder;

    protected string|Closure|null $type = null;

    protected int|Closure|null $width = null;

    public function __construct(
        protected string $name,
    ) {
    }

    public static function make(?string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    public function getWidth(): ?int
    {
        return $this->evaluate($this->width);
    }

    public function width(int|Closure|null $width): ColorPicker
    {
        $this->width = $width;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->evaluate($this->type);
    }

    public function type(string|Closure|null $type): ColorPicker
    {
        $this->type = $type;

        return $this;
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
        return view('components.forms.color-picker', $this->extractPublicMethods());
    }
}
