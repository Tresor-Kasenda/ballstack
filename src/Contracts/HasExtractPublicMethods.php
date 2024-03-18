<?php

declare(strict_types=1);

namespace App\View\TallFlex\Contracts;

use ReflectionClass;
use ReflectionMethod;

trait HasExtractPublicMethods
{
    protected function extractPublicMethods(): array
    {
        $methods = new ReflectionClass($this);
        $publicMethods = [];

        foreach ($methods->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $methodName = $method->getName();
            if (method_exists($this, $methodName)) {
                $publicMethods[$methodName] = $this->$methodName(...);
            }
        }

        return $publicMethods;
    }
}
