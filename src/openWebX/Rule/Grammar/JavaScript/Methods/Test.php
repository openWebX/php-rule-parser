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
use openWebX\Rule\TokenStream\Token\TokenBool;
use openWebX\Rule\TokenStream\Token\TokenRegex;
use openWebX\Rule\TokenStream\TokenCollection;

final class Test extends CallableFunction {
    public function call(BaseToken $string = null): BaseToken {
        if (!$this->token instanceof TokenRegex) {
            throw new ParserException('undefined is not a function');
        }

        if (!$string) {
            $bool = false;
        } else {
            // Remove "g" modifier as is does not exist in PHP
            // It's also irrelevant in .test() but allowed in JS here
            $pattern = preg_replace_callback(
                '~/[igm]{0,3}$~',
                function (array $modifiers) {
                    return str_replace('g', '', $modifiers[0]);
                },
                $this->token->getValue()
            );

            $subject = $string->getValue();

            while ($subject instanceof TokenCollection) {
                $subject = current($subject->toArray());
            }

            $bool = (bool)preg_match($pattern, (string)$subject);
        }

        return new TokenBool($bool);
    }
}
