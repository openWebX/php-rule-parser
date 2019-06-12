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
use openWebX\Rule\TokenStream\Token\TokenRegex;

final class Split extends CallableFunction {
    public function call(BaseToken $separator = null, BaseToken $limit = null): BaseToken {
        if (!$separator || !is_string($separator->getValue())) {
            $newValue = [$this->token->getValue()];
        } else {
            $params = [$separator->getValue(), $this->token->getValue()];

            if ($limit) {
                $params[] = (int)$limit->getValue();
            }

            if ($separator instanceof TokenRegex) {
                $func = 'preg_split';
            } else {
                $func = 'explode';
            }

            $newValue = $func(...$params);
        }

        return new TokenArray($newValue);
    }
}
