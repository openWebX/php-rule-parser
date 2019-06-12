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

final class IndexOf extends CallableFunction {
    public function call(BaseToken $needle = null): BaseToken {
        if (!$needle) {
            $value = -1;
        } else {
            $value = strpos($this->token->getValue(), $needle->getValue());

            if ($value === false) {
                $value = -1;
            }
        }

        return new TokenInteger($value);
    }
}
