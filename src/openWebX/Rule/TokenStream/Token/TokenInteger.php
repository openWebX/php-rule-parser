<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Token;

final class TokenInteger extends BaseToken {
    public function getType(): int {
        return TokenType::INT_VALUE;
    }

    public function getValue(): int {
        return (int)parent::getValue();
    }
}
