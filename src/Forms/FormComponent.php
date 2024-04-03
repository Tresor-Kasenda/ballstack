<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;
use Tresorkasenda\Contracts\BelongsToParent;
use Tresorkasenda\Contracts\HasColumns;
use Tresorkasenda\Contracts\HasDisplayedCard;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;
use Tresorkasenda\Contracts\HasLivewire;
use Tresorkasenda\Contracts\HasSchema;

class FormComponent extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;
    use BelongsToParent;
    use HasSchema;
    use HasDisplayedCard;
    use HasColumns;
    use HasLivewire;

    public function __construct(
        protected ?string $name = null
    )
    {
    }

    public static function make(string $name = null): static
    {
        return new static($name);
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
        return view($this->view, $this->extractPublicMethods());
    }
}
