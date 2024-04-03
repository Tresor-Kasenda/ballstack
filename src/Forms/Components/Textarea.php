<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasDisabled;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasReadOnly;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

class Textarea extends Field
{
    use HasDisabled;
    use HasLabel;
    use HasPlaceholder;
    use HasReadOnly;
    use HasRequired;

    protected int|Closure|null $rows = null;

    protected int|Closure|null $length = null;

    protected int|Closure|null $cols = null;
    protected bool $autosize = false;

    protected string $view = "ballstack::forms.components.editor.textarea";

    public function getLength(): ?int
    {
        return $this->evaluate($this->length);
    }

    public function length(int|Closure|null $length): Textarea
    {
        $this->length = $length;
        return $this;
    }

    public function isAutosize(): ?bool
    {
        return $this->evaluate($this->autosize);
    }

    public function autosize(bool $autosize = true): Textarea
    {
        $this->autosize = $autosize;

        return $this;
    }

    public function getCols(): ?int
    {
        return $this->evaluate($this->cols);
    }

    public function cols(int|Closure|null $cols): Textarea
    {
        $this->cols = $cols;
        return $this;
    }

    public function rows(int|Closure|null $rows): static
    {
        $this->rows = $rows;

        return $this;
    }

    public function getRows(): ?int
    {
        return $this->evaluate($this->rows);
    }

    public function getName(): ?string
    {
        return $this->evaluate($this->name);
    }
}
