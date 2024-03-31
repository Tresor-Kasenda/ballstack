<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Editor;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\GenericForms;

class TextEditor extends GenericForms implements Htmlable
{
    use HasLabel;
    use HasPlaceholder;

    protected array|null $options = [];

    protected string|Closure|null $theme = null;

    public function __construct(
        public string $name
    ) {
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
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
        return view('ballstack::forms.editor.text-editor', $this->extractPublicMethods());
    }

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
