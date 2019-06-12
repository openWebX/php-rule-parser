<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Expression;

use openWebX\Rule\Parser\Exception\ParserException;
use openWebX\Rule\TokenStream\TokenCollection;

final class InExpression extends BaseExpression {
    public function evaluate($leftValue, $rightValue): bool {
        if ($rightValue instanceof TokenCollection) {
            $rightValue = $rightValue->toArray();
        }

        if (!is_array($rightValue)) {
            throw new ParserException(sprintf(
                'Expected array, got "%s"',
                gettype($rightValue)
            ));
        }

        return in_array($leftValue, $rightValue, true);
    }
}
