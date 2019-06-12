<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar\JavaScript\Functions;

use openWebX\Rule\Grammar\CallableFunction;
use openWebX\Rule\Grammar\CallableUserFunctionInterface;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenFloat;

final class ParseFloat extends CallableFunction implements CallableUserFunctionInterface {
    public function call(BaseToken $value = null): BaseToken {
        if ($value === null) {
            return new TokenFloat(NAN);
        }

        return new TokenFloat((float)$value->getValue());
    }
}
