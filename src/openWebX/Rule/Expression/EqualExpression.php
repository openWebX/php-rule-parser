<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Expression;

final class EqualExpression extends BaseExpression {
    public function evaluate($leftValue, $rightValue): bool {
        return $leftValue == $rightValue;
    }
}
