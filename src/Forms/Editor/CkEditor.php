<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Editor;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\GenericForms;

class CkEditor extends GenericForms implements Htmlable
{
    use HasLabel;
    use HasPlaceholder;

    public function __construct(
        protected string $name
    )
    {
    }

    public static function make(?string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
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
        return view('ballstack::forms.editor.ckeditor', $this->extractPublicMethods());
    }
}
