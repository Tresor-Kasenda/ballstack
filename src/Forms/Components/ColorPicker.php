<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\Field;

class ColorPicker extends Field
{
    use HasLabel;
    use HasPlaceholder;

    protected string|Closure|null $type = null;

    protected int|Closure|null $width = null;

    protected string $view = "ballstack::forms.components.color-picker";

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
}
