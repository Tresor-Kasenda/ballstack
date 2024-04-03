<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Tresorkasenda\Contracts\HasDisabled;
use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Contracts\HasRule;
use Tresorkasenda\Forms\Field;

class SelectInput extends Field
{
    use HasDisabled;
    use HasLabel;
    use HasPlaceholder;
    use HasRequired;
    use HasRule;

    public bool $native = true;

    protected array|Collection $options = [];

    protected bool $searchable = false;

    protected bool $multiple = false;

    protected bool $autofocus = false;

    protected bool $autocomplete = false;

    protected string $autocapitalize = 'off';

    protected bool $live = false;

    protected string $view = "ballstack::forms.components.select";

    public function options(array|Closure|null $options): static
    {
        if ($options instanceof Closure) {
            $this->options = $options();
        } elseif ($options instanceof Model) {
            $this->options = $options->toArray();
        } else {
            $this->options = $options;
        }

        return $this;
    }

    public function getOptions()
    {
        return $this->evaluate($this->options);
    }

    public function native(bool $native = true): static
    {
        $this->native = $native;

        return $this;
    }

    public function getNative(): bool
    {
        return $this->evaluate($this->native);
    }

    public function searchable(bool $searchable = true): static
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function getSearchable(): bool
    {
        return $this->evaluate($this->searchable);
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getMultiple(): bool
    {
        return $this->evaluate($this->multiple);
    }

    public function autofocus(bool $autofocus = true): static
    {
        $this->autofocus = $autofocus;

        return $this;
    }

    public function getAutofocus(): bool
    {
        return $this->evaluate($this->autofocus);
    }

    public function autocomplete(bool $autocomplete = true): static
    {
        $this->autocomplete = $autocomplete;

        return $this;
    }

    public function getAutocomplete(): bool
    {
        return $this->evaluate($this->autocomplete);
    }

    public function autocapitalize(string $autocapitalize = 'off'): static
    {
        $this->autocapitalize = $autocapitalize;

        return $this;
    }

    public function getAutocapitalize(): string
    {
        return $this->evaluate($this->autocapitalize);
    }

    public function live(bool $live = true): static
    {
        $this->live = $live;
        return $this;
    }

    public function getLive(): bool
    {
        return $this->evaluate($this->live);
    }
}
