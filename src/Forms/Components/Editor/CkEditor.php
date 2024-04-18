<?php

declare(strict_types=1);

namespace Tresorkasenda\Forms\Components\Editor;

use Tresorkasenda\Contracts\HasLabel;
use Tresorkasenda\Contracts\HasPlaceholder;
use Tresorkasenda\Forms\Field;

class CkEditor extends Field
{
    use HasLabel;
    use HasPlaceholder;

    protected array $fieldsHeadings = [
        'heading',
        '|',
        'bold',
        'italic',
        'link',
        'bulletedList',
        'numberedList',
        '|',
        'outdent',
        'indent',
        '|',
        'blockQuote',
        'insertTable',
        'mediaEmbed',
        'undo',
        'redo'
    ];

    protected string $view = "ballstack::forms.components.editor.ckeditor";
}
