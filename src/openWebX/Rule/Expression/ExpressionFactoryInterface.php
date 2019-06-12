<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Expression;

use openWebX\Rule\TokenStream\Token\BaseToken;

interface ExpressionFactoryInterface {
    public function createFromOperator(BaseToken $operator): BaseExpression;
}
