<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms\Editor;

use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasPlaceholder;
use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;

class MarkdownEditor extends GenericForms implements Htmlable
{
    use HasLabel;
    use HasPlaceholder;

    protected string $uniqueId = '';

    protected Closure|int|null $height = null;

    public function __construct(
        protected string $name
    )
    {
        $this->uniqueId = uniqid('markdown-' . $this->name, true);
    }

    public static function make(string $name)
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
        return view('components.forms.editor.markdown', $this->extractPublicMethods());
    }
}
