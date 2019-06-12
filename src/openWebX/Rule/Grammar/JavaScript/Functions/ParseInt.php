<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar\JavaScript\Functions;

use openWebX\Rule\Grammar\CallableFunction;
use openWebX\Rule\Grammar\CallableUserFunctionInterface;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenInteger;

final class ParseInt extends CallableFunction implements CallableUserFunctionInterface {
    public function call(BaseToken $value = null): BaseToken {
        if ($value === null) {
            return new TokenInteger(NAN);
        }

        return new TokenInteger((int)$value->getValue());
    }
}
