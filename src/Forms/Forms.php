<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms;

use Closure;

/**
 * Forms component for creating and managing form structures.
 *
 * This component provides a fluent interface for building forms with customizable
 * actions and column layouts. It extends FormComponent to provide rendering
 * capabilities through Blade views.
 *
 * @example
 * ```php
 * Forms::make('user-registration')
 *     ->action('/register')
 *     ->schema([
 *         TextInput::make('name')->required(),
 *         TextInput::make('email')->email()->required(),
 *     ]);
 * ```
 */
class Forms extends FormComponent
{
    protected string|Closure|null $action = null;

    protected int|Closure|null $column = 0;

    protected string|null $view = "ballstack::forms.form-builder";

    /**
     * Set the form action URL.
     *
     * @param string|Closure|null $action The URL to submit the form to
     * @return static
     */
    public function action(string|Closure|null $action): static
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the evaluated form action URL.
     *
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->evaluate($this->action);
    }
}
