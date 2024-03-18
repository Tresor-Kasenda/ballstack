<?php

declare(strict_types=1);

namespace App\View\TallFlex\Forms\Inputs;

use App\View\TallFlex\Contracts\HasEvaluated;
use App\View\TallFlex\Contracts\HasLabel;
use App\View\TallFlex\Contracts\HasRequired;
use App\View\TallFlex\Forms\GenericForms;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Throwable;

class FileUpload extends GenericForms implements Htmlable
{
    use HasEvaluated;
    use HasLabel;
    use HasRequired;

    protected string $directory = 'public';

    protected string|null $fileSize = null;

    protected string|null $accepts = null;

    protected bool|Closure $multiple = false;

    protected bool|Closure $reorder = false;

    protected bool|Closure $dropped = false;
    protected bool|Closure $allowRevert = true;
    protected bool|Closure $allowImagePreview = true;
    protected bool|Closure $allowImageCrop = true;
    protected bool|Closure $allowProcess = true;
    protected int|Closure $fileSizeBase = 1000;

    protected bool|Closure $allowFileSizeValidation = false;

    protected bool|Closure $allowFileTypeValidation = false;

    protected bool|Closure $allowRemove = true;
    protected int|Closure $maxParallelUploads = 3;

    public function __construct(
        public string $name,
    )
    {
    }

    public static function make(?string $name): static
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
        return view('components.forms.file-upload', $this->extractPublicMethods());
    }

    public function directory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function allowFileSizeValidation(bool $allowFileSizeValidation = true): static
    {
        $this->allowFileSizeValidation = $allowFileSizeValidation;

        return $this;
    }

    public function allowFileTypeValidation(bool $allowFileTypeValidation = true): static
    {
        $this->allowFileTypeValidation = $allowFileTypeValidation;

        return $this;
    }

    public function isAllowFileTypeValidation(): bool
    {
        return (bool)$this->evaluate($this->allowFileTypeValidation);
    }

    public function getName(): string
    {
        return $this->evaluate($this->name);
    }

    public function isAllowFileSizeValidation(): bool
    {
        return (bool)$this->evaluate($this->allowFileSizeValidation);
    }

    public function getMultiple(): bool
    {
        return (bool)$this->evaluate($this->multiple);
    }

    public function reorder(bool $reorder = true): static
    {
        $this->reorder = $reorder;

        return $this;
    }

    public function getReorder(): bool
    {
        return (bool)$this->evaluate($this->reorder);
    }

    public function maxFileSize(string $fileSize): static
    {
        $this->fileSize = $fileSize;
        return $this;
    }

    public function getFileSize(): string|null
    {
        return $this->evaluate($this->fileSize);
    }

    public function acceptedFileTypes(string $accepts): static
    {
        $this->accepts = $accepts;
        return $this;
    }

    public function dropped(bool $dropped = true): self
    {
        $this->dropped = $dropped;

        return $this;
    }

    public function getDropped(): bool
    {
        return (bool)$this->evaluate($this->dropped);
    }

    public function getAccepts(): string|null
    {
        return $this->evaluate($this->accepts);
    }

    public function allowRevert(bool $allowRevert = true): static
    {
        $this->allowRevert = $allowRevert;
        return $this;
    }

    public function getAllowRevert(): bool
    {
        return (bool)$this->evaluate($this->allowRevert);
    }

    public function allowImagePreview(bool $allowImagePreview = true): static
    {
        $this->allowImagePreview = $allowImagePreview;
        return $this;
    }

    public function getAllowImagePreview(): bool
    {
        return (bool)$this->evaluate($this->allowImagePreview);
    }

    public function allowImageCrop(bool $allowImageCrop = true): static
    {
        $this->allowImageCrop = $allowImageCrop;
        return $this;
    }

    public function getAllowImageCrop(): bool
    {
        return (bool)$this->evaluate($this->allowImageCrop);
    }

    public function allowProcess(bool $allowProcess = true): static
    {
        $this->allowProcess = $allowProcess;
        return $this;
    }

    public function getAllowProcess(): bool
    {
        return (bool)$this->evaluate($this->allowProcess);
    }

    public function fileSizeBase(int $fileSizeBase = 1000): static
    {
        $this->fileSizeBase = $fileSizeBase;
        return $this;
    }

    public function getFileSizeBase(): int
    {
        return (int)$this->evaluate($this->fileSizeBase);
    }

    public function allowRemove(bool $allowRemove = true): static
    {
        $this->allowRemove = $allowRemove;
        return $this;
    }

    public function getAllowRemove(): bool
    {
        return (bool)$this->evaluate($this->allowRemove);
    }

    public function maxParallelUploads(int $maxParallelUploads = 3): static
    {
        $this->maxParallelUploads = $maxParallelUploads;
        return $this;
    }

    public function getMaxParallelUploads(): int
    {
        return (int)$this->evaluate($this->maxParallelUploads);
    }

    public function upload(string $file)
    {

    }

    public function removeUpload(string $removeUpload)
    {
        
    }
}
