<?php

declare(strict_types=1);

namespace Tresorkasenda\Widgets;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use Override;
use Throwable;
use Tresorkasenda\Contracts\HasEvaluated;
use Tresorkasenda\Contracts\HasExtractPublicMethods;

class Card extends Component implements Htmlable
{
    use HasEvaluated;
    use HasExtractPublicMethods;

    protected string|Closure|null $header = null;

    protected string|Closure|null $image = null;

    protected string|Closure|null $content = null;

    public function __construct(
        protected ?string $name
    )
    {
    }

    public static function make(?string $name = null): static
    {
        return new static($name);
    }

    public function getName(): ?string
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
        return view('ballstack::widgets.card', $this->extractPublicMethods());
    }

    public function header(string|Closure|null $header): static
    {
        $this->header = $header;

        return $this;
    }

    public function getHeader(): ?string
    {
        return $this->evaluate($this->header);
    }

    public function image(string|Closure|null $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->evaluate($this->image);
    }

    public function content(string|Closure|null $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->evaluate($this->content);
    }
}
