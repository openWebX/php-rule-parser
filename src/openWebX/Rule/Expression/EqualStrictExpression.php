<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Expression;

use openWebX\Rule\TokenStream\TokenCollection;

final class EqualStrictExpression extends BaseExpression {
    public function evaluate($leftValue, $rightValue): bool {
        if ($leftValue instanceof TokenCollection) {
            $leftValue = $leftValue->toArray();
        }

        if ($rightValue instanceof TokenCollection) {
            $rightValue = $rightValue->toArray();
        }

        return $leftValue === $rightValue;
    }
}
