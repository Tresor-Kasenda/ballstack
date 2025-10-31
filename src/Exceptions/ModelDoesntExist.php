<?php

declare(strict_types=1);

namespace Tresorkasenda\Exceptions;

use Exception;

/**
 * Exception thrown when a provided class is not a valid Eloquent model.
 *
 * This exception is typically thrown in the Datatable component when
 * attempting to use a class that doesn't extend Illuminate\Database\Eloquent\Model.
 */
class ModelDoesntExist extends Exception
{
}
