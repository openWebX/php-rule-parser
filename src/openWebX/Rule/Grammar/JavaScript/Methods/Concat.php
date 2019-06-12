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
use openWebX\Rule\TokenStream\Token\TokenArray;
use openWebX\Rule\TokenStream\Token\TokenString;

final class Concat extends CallableFunction {
    public function call(BaseToken $parameters = null): BaseToken {
        $value = $this->token->getValue();

        /** @var BaseToken[] $parameters */
        $parameters = func_get_args();

        foreach ($parameters as $parameter) {
            if ($parameter instanceof TokenArray) {
                $value .= implode(',', $parameter->toArray());
            } else {
                $value .= $parameter->getValue();
            }
        }

        return new TokenString($value);
    }
}
