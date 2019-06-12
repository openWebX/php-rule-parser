<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\TokenStream;

use openWebX\Rule\Grammar\CallableUserFunctionInterface;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenInteger;

class TestFunc implements CallableUserFunctionInterface
{
    public function call(BaseToken $param = null): BaseToken
    {
        return new TokenInteger(234);
    }
}
