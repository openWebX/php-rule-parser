<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Highlighter;

use ArrayIterator;
use openWebX\Rule\Tokenizer\TokenizerInterface;
use openWebX\Rule\TokenStream\Token\TokenType;

final class Highlighter {
    /** @var string[] */
    private $styles = [
        TokenType::COMMENT => 'color: #948a8a; font-style: italic;',
        TokenType::LOGICAL => 'color: #c72d2d;',
        TokenType::OPERATOR => 'color: #000;',
        TokenType::PARENTHESIS => 'color: #000;',
        TokenType::SPACE => '',
        TokenType::UNKNOWN => '',
        TokenType::VALUE => 'color: #e36700; font-style: italic;',
        TokenType::VARIABLE => 'color: #007694; font-weight: 900;',
        TokenType::METHOD => 'color: #000',
        TokenType::SQUARE_BRACKET => '',
        TokenType::COMMA => '',
        TokenType::FUNCTION => '',
        TokenType::INT_VALUE => '',
    ];

    /** @var TokenizerInterface */
    private $tokenizer;

    public function __construct(TokenizerInterface $tokenizer) {
        $this->tokenizer = $tokenizer;
    }

    public function setStyle(int $group, string $style) {
        if (!isset($this->styles[$group])) {
            throw new Exception\InvalidGroupException(
                'Invalid group'
            );
        }

        $this->styles[$group] = (string)$style;
    }

    public function highlightString(string $string): string {
        return $this->highlightTokens($this->tokenizer->tokenize($string));
    }

    public function highlightTokens(ArrayIterator $tokens): string {
        $string = '';

        foreach ($tokens as $token) {
            if ($style = $this->styles[$token->getType()]) {
                $value = htmlentities($token->getOriginalValue(), ENT_QUOTES, 'utf-8');
                $string .= '<span style="' . $style . '">' . $value . '</span>';
            } else {
                $string .= $token->getOriginalValue();
            }
        }

        return '<pre><code>' . $string . '</code></pre>';
    }
}
