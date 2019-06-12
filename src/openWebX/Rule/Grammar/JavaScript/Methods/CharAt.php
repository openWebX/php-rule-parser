<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar\JavaScript\Methods;

use openWebX\Rule\Grammar\CallableFunction;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenInteger;
use openWebX\Rule\TokenStream\Token\TokenString;

final class CharAt extends CallableFunction {
    public function call(BaseToken $offset = null): BaseToken {
        $tokenValue = $this->token->getValue();

        if (!$offset) {
            $offset = 0;
        } elseif (!$offset instanceof TokenInteger) {
            $offset = (int)$offset->getValue();
        } else {
            $offset = $offset->getValue();
        }

        if (!isset($tokenValue[$offset])) {
            $char = '';
        } else {
            $char = $tokenValue[$offset];
        }

        return new TokenString($char);
    }
}
