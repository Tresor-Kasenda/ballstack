<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components;

use Closure;
use Tresorkasenda\Contracts\HasDisabled;
use Tresorkasenda\Contracts\HasLivewire;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Contracts\HasRequired;
use Tresorkasenda\Forms\Field;

/**
 * TextInput component for creating various types of text-based form inputs.
 *
 * This component supports multiple input types including text, email, password, number,
 * telephone, and URL. It provides a fluent API for configuring input attributes such as
 * validation rules, placeholders, autofocus, and more.
 *
 * @example
 * ```php
 * TextInput::make('email')
 *     ->email()
 *     ->required()
 *     ->placeholder('you@example.com')
 *     ->autofocus();
 * ```
 */
class TextInput extends Field
{
    use HasDisabled;
    use HasLivewire;
    use HasPlaceholder;
    use HasRequired;

    protected string|Closure|null $type = "";

    protected int|Closure|null $minimum = null;

    protected Closure|bool $autofocus = true;
    protected mixed $maxValue = null;
    protected string|Closure|null $pattern = null;
    protected string|Closure|null $helpText = null;

    protected int|float|string|Closure|null $step = null;
    protected bool|Closure $isReadOnly = false;

    protected bool $autocomplete = false;

    protected string|Closure|null $prefix = null;

    protected string $view = "ballstack::forms.components.text-input";

    /**
     * Set the input type attribute.
     *
     * @param string|Closure $type The input type (e.g., 'text', 'email', 'password')
     * @return self
     */
    public function type(string|Closure $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): string|Closure|null
    {
        return $this->evaluate($this->type) ?? "text";
    }

    public function minLength(int $minimum): static
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function getMinLength(): int|Closure|null
    {
        return $this->evaluate($this->minimum) ?? null;
    }

    public function autofocus(bool|Closure $autofocus = true): static
    {
        $this->autofocus = $autofocus;

        return $this;
    }

    public function getAutofocus(): bool
    {
        return (bool)$this->evaluate($this->autofocus);
    }

    public function maxLength(int $maximum): static
    {
        $this->maxValue = $maximum;

        return $this;
    }

    public function getMaxLength(): int|Closure|null
    {
        return $this->evaluate($this->maxValue) ?? null;
    }

    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function getPattern(): string|Closure|null
    {
        return $this->evaluate($this->pattern) ?? null;
    }

    public function helpText(string $helpText): static
    {
        $this->helpText = $helpText;

        return $this;
    }

    public function readOnly(bool $readOnly = true): static
    {
        $this->isReadOnly = $readOnly;

        return $this;
    }

    public function getReadOnly(): bool
    {
        return (bool)$this->evaluate($this->isReadOnly);
    }

    public function step(int|float|string|Closure|null $interval): static
    {
        $this->step = $interval;

        return $this;
    }

    public function getStep(): int|float|string|null
    {
        return $this->evaluate($this->step ?? null) ?? null;
    }


    public function autocomplete(bool|Closure $autocomplete = true): static
    {
        $this->autocomplete = $autocomplete;

        return $this;
    }

    public function getAutocomplete(): bool
    {
        return $this->evaluate($this->autocomplete);
    }

    public function getHelpText(): string|Closure|null
    {
        return $this->evaluate($this->helpText);
    }

    public function email(): static
    {
        $this->type = 'email';

        return $this;
    }

    public function numeric(): static
    {
        $this->type = 'number';

        return $this;
    }

    public function password(): static
    {
        $this->type = 'password';

        return $this;
    }

    public function tel(): static
    {
        $this->type = 'tel';

        return $this;
    }

    public function url(): static
    {
        $this->type = 'url';

        return $this;
    }

    public function prefix(string|Closure|null $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->evaluate($this->prefix);
    }
}
