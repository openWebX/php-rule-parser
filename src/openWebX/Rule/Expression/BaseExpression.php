<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Expression;

abstract class BaseExpression {
    abstract public function evaluate($leftValue, $rightValue): bool;
}
