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

final class Substr extends CallableFunction {
    public function call(BaseToken $start = null, BaseToken $offset = null): BaseToken {
        $params = [];

        if (!$start) {
            $params[] = 0;
        } else {
            $params[] = (int)$start->getValue();
        }

        if ($offset) {
            $params[] = (int)$offset->getValue();
        }

        $value = substr($this->token->getValue(), ...$params);

        return new TokenString((string)$value);
    }
}
