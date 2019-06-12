<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
declare(strict_types=1);

namespace openWebX\Rule\Expression;

final class LessThanExpression extends BaseExpression {
    public function evaluate($leftValue, $rightValue): bool {
        return $leftValue < $rightValue;
    }
}
