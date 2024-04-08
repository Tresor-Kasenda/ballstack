<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasName;

class Field extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;
    use HasLabel;
    use HasName;

    protected string $uniqueId;

    protected string $view = '';

    final public function __construct(string $name)
    {
        $this->name($name);
        $this->uniqueId = uniqid('input-' . $this->name, true);
    }

    public static function make(string $name): static
    {
        return app(static::class, ['name' => $name]);
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

    public function getUniqueId(): string
    {
        return $this->evaluate($this->uniqueId);
    }
}
