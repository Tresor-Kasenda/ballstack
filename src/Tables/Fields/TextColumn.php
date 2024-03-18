<?php

declare(strict_types=1);

namespace App\View\TallFlex\Tables\Fields;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;

class TextColumn extends Component implements Htmlable
{
    public function __construct(
        protected ?string $name
    ) {
    }

    public static function make(string $name): static
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
        return view('');
    }


}
