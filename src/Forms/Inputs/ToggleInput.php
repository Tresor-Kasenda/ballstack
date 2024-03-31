<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Inputs;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;
use Tresorkasenda\Contracts\HasChecked;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\GenericForms;

class ToggleInput extends GenericForms implements Htmlable
{
    use HasChecked;
    use HasEvaluated;
    use HasLabel;
    use HasRequired;

    protected string $uniqueId;

    public function __construct(
        public string $name,
    ) {
        $this->uniqueId = uniqid('toggle-'.$this->name, true);
    }

    public static function make(?string $name): self
    {
        return new self($name);
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
     * @throws Throwable
     */
    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('components.forms.toggle', $this->extractPublicMethods());
    }
}
