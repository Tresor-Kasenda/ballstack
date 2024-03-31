<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Editor;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\GenericForms;

class MarkdownEditor extends GenericForms implements Htmlable
{
    use HasLabel;
    use HasPlaceholder;

    protected string $uniqueId = '';

    protected Closure|int|null $height = null;

    public function __construct(
        protected string $name
    ) {
        $this->uniqueId = uniqid('markdown-'.$this->name, true);
    }

    public static function make(?string $name): static
    {
        return app(static::class, ['name' => $name]);
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

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    public function getUniqueId(): string
    {
        return $this->evaluate($this->uniqueId);
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
        return view('ballstack::forms.editor.markdown', $this->extractPublicMethods());
    }
}
