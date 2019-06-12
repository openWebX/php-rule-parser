<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Token;

final class TokenEncapsedString extends TokenString {
    public function getValue() {
        return substr(parent::getValue(), 1, -1);
    }
}
