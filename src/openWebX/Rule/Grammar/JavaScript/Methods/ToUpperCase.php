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
use openWebX\Rule\TokenStream\Token\TokenString;

final class ToUpperCase extends CallableFunction {
    public function call(BaseToken $string = null): BaseToken {
        return new TokenString(strtoupper((string)$this->token->getValue()));
    }
}
