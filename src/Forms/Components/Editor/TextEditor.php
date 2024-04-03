<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components\Editor;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\Field;

class TextEditor extends Field
{
    use HasLabel;
    use HasPlaceholder;

    protected array|Arrayable|null $options = [];

    protected string|Closure|null $theme = null;

    protected string $view = "ballstack::forms.components.editor.text-editor";

    public function options(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->evaluate($this->options);
    }

    public function getTheme(): string
    {
        return $this->evaluate($this->theme) ?? '';
    }

    public function theme(string|Closure|null $theme = 'snow'): TextEditor
    {
        $this->theme = $theme;
        return $this;
    }
}
