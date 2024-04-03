<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components\Editor;

use Closure;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\Field;

class MarkdownEditor extends Field
{
    use HasLabel;
    use HasPlaceholder;

    protected Closure|int|null $height = null;

    protected string $view = "ballstack::forms.components.editor.markdown";

    public function height(int|Closure|null $height = 300): static
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->evaluate($this->height);
    }
}
