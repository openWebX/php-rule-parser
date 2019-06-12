<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\Parser;

use openWebX\Rule\Grammar\Grammar;
use PHPUnit\Framework\TestCase;

class GrammarTest extends TestCase
{
    public function testDefaultValues()
    {
        $grammar = new class extends Grammar {
            public function getDefinition(): array
            {
                return [];
            }
        };

        $this->assertSame([], $grammar->getDefinition());
        $this->assertSame([], $grammar->getInternalFunctions());
        $this->assertSame([], $grammar->getInternalMethods());
    }
}
