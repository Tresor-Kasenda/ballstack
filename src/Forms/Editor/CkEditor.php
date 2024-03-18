<?php

namespace App\View\TallFlex\Forms\Editor;

use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasPlaceholder;
use App\View\TallFlex\Forms\GenericForms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Override;
use Throwable;

class CkEditor extends GenericForms implements Htmlable
{
    use HasLabel;
    use HasPlaceholder;

    public function __construct(
        protected string $name
    )
    {
    }

    public static function make(string $name)
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
        return view('components.forms.editor.ckeditor', $this->extractPublicMethods());
    }
}
