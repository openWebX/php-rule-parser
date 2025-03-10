<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar;

abstract class Grammar {
    abstract public function getDefinition(): array;

    public function getInternalFunctions(): array {
        return [];
    }

    public function getInternalMethods(): array {
        return [];
    }
}
