<?php

declare(strict_types=1);

namespace Tresorkasenda\BallStack\Component;

use App\View\TallFlex\Contracts\HasExtractPublicMethods;
use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;

class Section extends Component implements Htmlable
{
    use HasExtractPublicMethods;

    protected array $schema = [];

    protected ?string $title = null;

    protected string|Closure|null $description = null;

    protected int|null $column = 0;

    public function __construct(string $title = null)
    {
        $this->title = $title;
    }

    public static function make(string $title = null): static
    {
        return new static($title);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('components.forms.section', $this->extractPublicMethods());
    }

    public function schema(array $schema): static
    {
        $this->schema = array_map(function ($schema) {
            if ($schema instanceof GenericForms || $schema instanceof Component) {
                return $schema;
            }
            throw new InvalidArgumentException('Invalid must be instance of GenerateForms.');
        }, $schema);

        return $this;
    }

    public function getSchema(): array
    {
        return array_map(fn($item) => $item, $this->schema);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string|null
    {
        if ($this->description instanceof Closure) {
            return ($this->description)();
        }

        return $this->description;
    }

    public function column(int $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function getColumn(): int|null
    {
        return $this->column;
    }
}
