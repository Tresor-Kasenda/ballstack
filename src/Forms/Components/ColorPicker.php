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

    protected int|Closure|null $size = null;

    protected string $view = "ballstack::forms.components.color-picker";

    public function getSize(): ?int
    {
        return $this->evaluate($this->size);
    }

    public function size(int|Closure|null $width): ColorPicker
    {
        $this->size = $width;

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
