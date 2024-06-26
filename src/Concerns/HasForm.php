<?php

declare(strict_types=1);

namespace Tresorkasenda\Concerns;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Tresorkasenda\Forms\Forms;

interface HasForm
{
    public function dispatchFormEvent(mixed ...$args): void;

    public function getActiveFormsLocale(): ?string;

    public function getForm(string $name): ?Forms;

    public function getFormComponentFileAttachment(string $statePath): ?TemporaryUploadedFile;

    public function getFormComponentFileAttachmentUrl(string $statePath): ?string;

    /**
     * @return array<array{'label': string, 'value': string}>
     */
    public function getFormSelectOptionLabels(string $statePath): array;

    public function getFormSelectOptionLabel(string $statePath): ?string;

    /**
     * @return array<array{'label': string, 'value': string}>
     */
    public function getFormSelectOptions(string $statePath): array;

    /**
     * @return array<array{'label': string, 'value': string}>
     */
    public function getFormSelectSearchResults(string $statePath, string $search): array;

    /**
     * @return array<array{name: string, size: int, type: string, url: string} | null> | null
     */
    public function getFormUploadedFiles(string $statePath): ?array;

    public function getOldFormState(string $statePath): mixed;

    public function isCachingForms(): bool;

    public function removeFormUploadedFile(string $statePath, string $fileKey): void;

    /**
     * @param array<array-key> $fileKeys
     */
    public function reorderFormUploadedFiles(string $statePath, array $fileKeys): void;

    /**
     * @param array<string, array> | null $rules
     * @param array<string, string> $messages
     * @param array<string, string> $attributes
     * @return array<string, mixed>
     */
    public function validate(array $rules = null, array $messages = [], array $attributes = []): array;
}
