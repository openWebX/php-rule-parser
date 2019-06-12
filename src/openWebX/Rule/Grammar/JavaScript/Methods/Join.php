<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar\JavaScript\Methods;

use openWebX\Rule\Grammar\CallableFunction;
use openWebX\Rule\Parser\Exception\ParserException;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenArray;
use openWebX\Rule\TokenStream\Token\TokenString;
use openWebX\Rule\TokenStream\TokenCollection;

final class Join extends CallableFunction {
    public function call(BaseToken $glue = null): BaseToken {
        if (!$this->token instanceof TokenArray) {
            throw new ParserException(sprintf('%s.join is not a function', $this->token->getValue()));
        }

        if ($glue) {
            $glue = $glue->getValue();
        } else {
            $glue = ',';
        }

        $array = $this->token->getValue();

        if ($array instanceof TokenCollection) {
            $array = $array->toArray();
        }

        return new TokenString(implode($glue, $array));
    }
}
