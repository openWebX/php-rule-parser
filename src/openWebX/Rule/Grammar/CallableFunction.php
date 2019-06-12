<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar;

use openWebX\Rule\TokenStream\Token\BaseToken;

abstract class CallableFunction implements CallableUserFunctionInterface {
    /** @var BaseToken|null */
    protected $token;

    public function __construct(BaseToken $token = null) {
        $this->token = $token;
    }
}
