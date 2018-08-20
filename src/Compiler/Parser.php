<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler;

use Railt\Lexer\Factory;
use Railt\Lexer\LexerInterface;
use Railt\Parser\Driver\Llk;
use Railt\Parser\Driver\Stateful;
use Railt\Parser\Grammar;
use Railt\Parser\ParserInterface;
use Railt\Parser\Rule\Alternation;
use Railt\Parser\Rule\Concatenation;
use Railt\Parser\Rule\Repetition;
use Railt\Parser\Rule\Terminal;
use Railt\Parser\GrammarInterface;

/**
 * --- DO NOT EDIT THIS FILE ---
 *
 * Class Parser has been auto-generated.
 * Generated at: 17-08-2018 21:54:33
 *
 * --- DO NOT EDIT THIS FILE ---
 */
class Parser extends Stateful
{
    public const T_AND = 'T_AND';
    public const T_OR = 'T_OR';
    public const T_PARENTHESIS_OPEN = 'T_PARENTHESIS_OPEN';
    public const T_PARENTHESIS_CLOSE = 'T_PARENTHESIS_CLOSE';
    public const T_BRACKET_OPEN = 'T_BRACKET_OPEN';
    public const T_BRACKET_CLOSE = 'T_BRACKET_CLOSE';
    public const T_BRACE_OPEN = 'T_BRACE_OPEN';
    public const T_BRACE_CLOSE = 'T_BRACE_CLOSE';
    public const T_NON_NULL = 'T_NON_NULL';
    public const T_THREE_DOTS = 'T_THREE_DOTS';
    public const T_COLON = 'T_COLON';
    public const T_EQUAL = 'T_EQUAL';
    public const T_DIRECTIVE_AT = 'T_DIRECTIVE_AT';
    public const T_HEX_NUMBER = 'T_HEX_NUMBER';
    public const T_BIN_NUMBER = 'T_BIN_NUMBER';
    public const T_NUMBER = 'T_NUMBER';
    public const T_TRUE = 'T_TRUE';
    public const T_FALSE = 'T_FALSE';
    public const T_NULL = 'T_NULL';
    public const T_BLOCK_STRING = 'T_BLOCK_STRING';
    public const T_STRING = 'T_STRING';
    public const T_EXTENDS = 'T_EXTENDS';
    public const T_IMPLEMENTS = 'T_IMPLEMENTS';
    public const T_ON = 'T_ON';
    public const T_TYPE = 'T_TYPE';
    public const T_ENUM = 'T_ENUM';
    public const T_UNION = 'T_UNION';
    public const T_INTERFACE = 'T_INTERFACE';
    public const T_SCHEMA = 'T_SCHEMA';
    public const T_SCALAR = 'T_SCALAR';
    public const T_DIRECTIVE = 'T_DIRECTIVE';
    public const T_INPUT = 'T_INPUT';
    public const T_EXTEND = 'T_EXTEND';
    public const T_FRAGMENT = 'T_FRAGMENT';
    public const T_VARIABLE = 'T_VARIABLE';
    public const T_NAME = 'T_NAME';
    public const T_COMMENT = 'T_COMMENT';
    public const T_COMMA = 'T_COMMA';
    public const T_HTAB = 'T_HTAB';
    public const T_LF = 'T_LF';
    public const T_CR = 'T_CR';
    public const T_WHITESPACE = 'T_WHITESPACE';
    public const T_BOM = 'T_BOM';

    /**
     * Lexical tokens list.
     *
     * @var string[]
     */
    protected const LEXER_TOKENS = [
        self::T_AND => '&',
        self::T_OR => '\\|',
        self::T_PARENTHESIS_OPEN => '\\(',
        self::T_PARENTHESIS_CLOSE => '\\)',
        self::T_BRACKET_OPEN => '\\[',
        self::T_BRACKET_CLOSE => '\\]',
        self::T_BRACE_OPEN => '{',
        self::T_BRACE_CLOSE => '}',
        self::T_NON_NULL => '!',
        self::T_THREE_DOTS => '\\.{3}',
        self::T_COLON => ':',
        self::T_EQUAL => '=',
        self::T_DIRECTIVE_AT => '@',
        self::T_HEX_NUMBER => '\\-?0x([0-9a-fA-F]+)',
        self::T_BIN_NUMBER => '\\-?0b([0-1]+)',
        self::T_NUMBER => '\\-?(?:0|[1-9][0-9]*)(?:\\.[0-9]+)?(?:[eE][\\+\\-]?[0-9]+)?',
        self::T_TRUE => '(?<=\\b)true\\b',
        self::T_FALSE => '(?<=\\b)false\\b',
        self::T_NULL => '(?<=\\b)null\\b',
        self::T_BLOCK_STRING => '"""((?:\\\\"""|(?!""").)*)"""',
        self::T_STRING => '"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"',
        self::T_EXTENDS => '(?<=\\b)extends\\b',
        self::T_IMPLEMENTS => '(?<=\\b)implements\\b',
        self::T_ON => '(?<=\\b)on\\b',
        self::T_TYPE => '(?<=\\b)type\\b',
        self::T_ENUM => '(?<=\\b)enum\\b',
        self::T_UNION => '(?<=\\b)union\\b',
        self::T_INTERFACE => '(?<=\\b)interface\\b',
        self::T_SCHEMA => '(?<=\\b)schema\\b',
        self::T_SCALAR => '(?<=\\b)scalar\\b',
        self::T_DIRECTIVE => '(?<=\\b)directive\\b',
        self::T_INPUT => '(?<=\\b)input\\b',
        self::T_EXTEND => '(?<=\\b)extend\\b',
        self::T_FRAGMENT => '(?<=\\b)fragment\\b',
        self::T_VARIABLE => '\\$[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*',
        self::T_NAME => '[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*',
        self::T_COMMENT => '#[^\\n]*',
        self::T_COMMA => ',',
        self::T_HTAB => '\\x09',
        self::T_LF => '\\x0a',
        self::T_CR => '\\x0d',
        self::T_WHITESPACE => '\\x20',
        self::T_BOM => '\\xfe\\xff',
    ];

    /**
     * List of skipped tokens.
     *
     * @var string[]
     */
    protected const LEXER_SKIPPED_TOKENS = [
        'T_COMMENT',
        'T_COMMA',
        'T_HTAB',
        'T_LF',
        'T_CR',
        'T_WHITESPACE',
        'T_BOM',
    ];

    /**
     * @var int
     */
    protected const LEXER_FLAGS = Factory::LOOKAHEAD;

    /**
     * List of rule delegates.
     *
     * @var string[]
     */
    protected const PARSER_DELEGATES = [
        'TypeName' => \Railt\SDL\Ast\Common\TypeNameNode::class,
        'BooleanValue' => \Railt\SDL\Ast\Value\BooleanValueNode::class,
        'NumberValue' => \Railt\SDL\Ast\Value\NumberValueNode::class,
        'StringValue' => \Railt\SDL\Ast\Value\StringValueNode::class,
        'NullValue' => \Railt\SDL\Ast\Value\NullValueNode::class,
        'ListValue' => \Railt\SDL\Ast\Value\ListValueNode::class,
        'ConstantValue' => \Railt\SDL\Ast\Value\ConstantValueNode::class,
        'Value' => \Railt\SDL\Ast\Value\ValueNode::class,
        'TypeHint' => \Railt\SDL\Ast\Common\TypeHintNode::class,
        'DirectiveDefinition' => \Railt\SDL\Ast\Definition\DirectiveDefinitionNode::class,
        'EnumDefinition' => \Railt\SDL\Ast\Definition\EnumDefinitionNode::class,
        'InputDefinition' => \Railt\SDL\Ast\Definition\InputDefinitionNode::class,
        'InterfaceDefinition' => \Railt\SDL\Ast\Definition\InterfaceDefinitionNode::class,
        'ObjectDefinition' => \Railt\SDL\Ast\Definition\ObjectDefinitionNode::class,
        'ScalarDefinition' => \Railt\SDL\Ast\Definition\ScalarDefinitionNode::class,
        'SchemaDefinition' => \Railt\SDL\Ast\Definition\SchemaDefinitionNode::class,
        'UnionDefinition' => \Railt\SDL\Ast\Definition\UnionDefinitionNode::class,
        'ArgumentDefinition' => \Railt\SDL\Ast\Dependent\ArgumentDefinitionNode::class,
        'FieldDefinition' => \Railt\SDL\Ast\Dependent\FieldDefinitionNode::class,
        'DirectiveInvocation' => \Railt\SDL\Ast\Invocation\DirectiveInvocationNode::class,
    ];

    /**
     * Parser root rule name.
     *
     * @var string
     */
    protected const PARSER_ROOT_RULE = 'Document';

    /**
     * @return ParserInterface
     * @throws \InvalidArgumentException
     * @throws \Railt\Lexer\Exception\BadLexemeException
     */
    protected function boot(): ParserInterface
    {
        return new Llk($this->bootLexer(), $this->bootGrammar());
    }

    /**
     * @return LexerInterface
     * @throws \InvalidArgumentException
     * @throws \Railt\Lexer\Exception\BadLexemeException
     */
    protected function bootLexer(): LexerInterface
    {
        return Factory::create(static::LEXER_TOKENS, static::LEXER_SKIPPED_TOKENS, static::LEXER_FLAGS);
    }

    /**
     * @return GrammarInterface
     */
    protected function bootGrammar(): GrammarInterface
    {
        return new Grammar([
            new Concatenation(0, ['DocumentBody'], null), 
            (new Concatenation('Document', ['DocumentHead', 0], 'Document'))->setDefaultId('Document'), 
            new Repetition('DocumentHead', 0, -1, 'DirectiveInvocation', null), 
            new Alternation(3, ['Extension', 'Definition'], null), 
            new Repetition('DocumentBody', 0, -1, 3, null), 
            new Terminal('NameWithoutReserved', 'T_NAME', true), 
            new Terminal(6, 'T_TRUE', true), 
            new Terminal(7, 'T_FALSE', true), 
            new Terminal(8, 'T_NULL', true), 
            new Alternation('NameWithReserved', ['NameExceptValues', 6, 7, 8], null), 
            new Terminal(10, 'T_NAMESPACE', true), 
            new Terminal(11, 'T_EXTENDS', true), 
            new Terminal(12, 'T_IMPLEMENTS', true), 
            new Terminal(13, 'T_ON', true), 
            new Terminal(14, 'T_TYPE', true), 
            new Terminal(15, 'T_ENUM', true), 
            new Terminal(16, 'T_UNION', true), 
            new Terminal(17, 'T_INPUT_UNION', true), 
            new Terminal(18, 'T_INTERFACE', true), 
            new Terminal(19, 'T_SCHEMA', true), 
            new Terminal(20, 'T_SCALAR', true), 
            new Terminal(21, 'T_DIRECTIVE', true), 
            new Terminal(22, 'T_INPUT', true), 
            new Terminal(23, 'T_EXTEND', true), 
            new Terminal(24, 'T_FRAGMENT', true), 
            new Alternation('NameExceptValues', ['NameWithoutReserved', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24], null), 
            new Concatenation(26, ['NameWithReserved'], null), 
            (new Concatenation('TypeName', [26], 'TypeName'))->setDefaultId('TypeName'), 
            new Concatenation(28, ['NameWithReserved'], null), 
            (new Concatenation('DependentName', [28], 'DependentName'))->setDefaultId('DependentName'), 
            new Concatenation(30, ['NameExceptValues'], null), 
            (new Concatenation('ValueName', [30], 'ValueName'))->setDefaultId('ValueName'), 
            new Terminal(32, 'T_FALSE', true), 
            new Concatenation(33, [32], 'BooleanValue'), 
            new Terminal(34, 'T_TRUE', true), 
            new Concatenation(35, [34], 'BooleanValue'), 
            (new Alternation('BooleanValue', [33, 35], null))->setDefaultId('BooleanValue'), 
            new Terminal(37, 'T_NUMBER', true), 
            new Concatenation(38, [37], 'NumberValue'), 
            new Terminal(39, 'T_HEX_NUMBER', true), 
            new Concatenation(40, [39], 'NumberValue'), 
            new Terminal(41, 'T_BIN_NUMBER', true), 
            new Concatenation(42, [41], 'NumberValue'), 
            (new Alternation('NumberValue', [38, 40, 42], null))->setDefaultId('NumberValue'), 
            new Terminal(44, 'T_BLOCK_STRING', true), 
            new Concatenation(45, [44], 'StringValue'), 
            new Terminal(46, 'T_STRING', true), 
            new Concatenation(47, [46], 'StringValue'), 
            (new Alternation('StringValue', [45, 47], null))->setDefaultId('StringValue'), 
            new Terminal(49, 'T_NULL', true), 
            (new Concatenation('NullValue', [49], 'NullValue'))->setDefaultId('NullValue'), 
            new Terminal(51, 'T_BRACKET_OPEN', false), 
            new Repetition(52, 0, -1, 'Value', null), 
            new Terminal(53, 'T_BRACKET_CLOSE', false), 
            (new Concatenation('ListValue', [51, 52, 53], 'ListValue'))->setDefaultId('ListValue'), 
            new Concatenation(55, ['NameExceptValues'], null), 
            (new Concatenation('ConstantValue', [55], 'ConstantValue'))->setDefaultId('ConstantValue'), 
            new Concatenation(57, ['ConstantValue'], 'Value'), 
            new Concatenation(58, ['BooleanValue'], 'Value'), 
            new Concatenation(59, ['NumberValue'], 'Value'), 
            new Concatenation(60, ['StringValue'], 'Value'), 
            new Concatenation(61, ['NullValue'], 'Value'), 
            new Concatenation(62, ['InputInvocation'], 'Value'), 
            new Concatenation(63, ['ListValue'], null), 
            new Concatenation(64, [63], 'Value'), 
            (new Alternation('Value', [57, 58, 59, 60, 61, 62, 64], null))->setDefaultId('Value'), 
            new Concatenation('Documentation', ['StringValue'], 'Description'), 
            new Terminal(67, 'T_IMPLEMENTS', false), 
            new Terminal(68, 'T_AND', false), 
            new Concatenation(69, [68, 'TypeName'], 'TypeDefinitionImplementations'), 
            new Repetition(70, 0, -1, 69, null), 
            (new Concatenation('TypeDefinitionImplementations', [67, 'TypeName', 70], null))->setDefaultId('TypeDefinitionImplementations'), 
            new Terminal(72, 'T_EXTENDS', false), 
            new Concatenation(73, ['TypeName'], null), 
            (new Concatenation('TypeDefinitionExtends', [72, 73], 'TypeDefinitionExtends'))->setDefaultId('TypeDefinitionExtends'), 
            new Concatenation(75, ['__typeHintList'], 'TypeHint'), 
            new Concatenation(76, ['__typeHintSingular'], null), 
            new Concatenation(77, [76], 'TypeHint'), 
            (new Alternation('TypeHint', [75, 77], null))->setDefaultId('TypeHint'), 
            new Concatenation(79, ['__typeHintNullableList'], null), 
            new Alternation('__typeHintList', ['__typeHintNonNullList', 79], null), 
            new Terminal(81, 'T_BRACKET_OPEN', false), 
            new Terminal(82, 'T_BRACKET_CLOSE', false), 
            new Concatenation('__typeHintNullableList', [81, '__typeHintSingular', 82], 'List'), 
            new Terminal(84, 'T_NON_NULL', false), 
            new Concatenation('__typeHintNonNullList', ['__typeHintNullableList', 84], 'NonNull'), 
            new Concatenation(86, ['__typeHintNullableSingular'], null), 
            new Alternation('__typeHintSingular', ['__typeHintNonNullSingular', 86], null), 
            new Concatenation('__typeHintNullableSingular', ['TypeName'], null), 
            new Terminal(89, 'T_NON_NULL', false), 
            new Concatenation('__typeHintNonNullSingular', ['TypeName', 89], 'NonNull'), 
            new Repetition(91, 0, 1, 'Documentation', null), 
            new Concatenation(92, ['DirectiveDefinitionBody'], null), 
            (new Concatenation('DirectiveDefinition', [91, 'DirectiveDefinitionHead', 92], 'DirectiveDefinition'))->setDefaultId('DirectiveDefinition'), 
            new Terminal(94, 'T_DIRECTIVE', false), 
            new Terminal(95, 'T_DIRECTIVE_AT', false), 
            new Repetition(96, 0, 1, '__directiveDefinitionArguments', null), 
            new Concatenation('DirectiveDefinitionHead', [94, 95, 'TypeName', 96], null), 
            new Terminal(98, 'T_ON', false), 
            new Concatenation(99, ['DirectiveLocations'], null), 
            new Concatenation('DirectiveDefinitionBody', [98, 99], null), 
            new Terminal(101, 'T_PARENTHESIS_OPEN', false), 
            new Repetition(102, 0, 1, 'ArgumentDefinitions', null), 
            new Terminal(103, 'T_PARENTHESIS_CLOSE', false), 
            new Concatenation('__directiveDefinitionArguments', [101, 102, 103], null), 
            new Terminal(105, 'T_OR', false), 
            new Repetition(106, 0, 1, 105, null), 
            new Terminal(107, 'T_OR', false), 
            new Concatenation(108, [107, 'DirectiveLocation'], 'DirectiveLocations'), 
            new Repetition(109, 0, -1, 108, null), 
            (new Concatenation('DirectiveLocations', [106, 'DirectiveLocation', 109], null))->setDefaultId('DirectiveLocations'), 
            new Concatenation(111, ['ValueName'], null), 
            (new Concatenation('DirectiveLocation', [111], 'DirectiveLocation'))->setDefaultId('DirectiveLocation'), 
            new Repetition(113, 0, 1, 'Documentation', null), 
            new Concatenation(114, ['EnumDefinitionBody'], null), 
            (new Concatenation('EnumDefinition', [113, 'EnumDefinitionHead', 114], 'EnumDefinition'))->setDefaultId('EnumDefinition'), 
            new Terminal(116, 'T_ENUM', false), 
            new Repetition(117, 0, 1, 'Directives', null), 
            new Concatenation('EnumDefinitionHead', [116, 'TypeName', 117], null), 
            new Terminal(119, 'T_BRACE_OPEN', false), 
            new Repetition(120, 0, 1, 'EnumValues', null), 
            new Terminal(121, 'T_BRACE_CLOSE', false), 
            new Concatenation('EnumDefinitionBody', [119, 120, 121], null), 
            new Repetition(123, 1, -1, 'EnumValue', null), 
            (new Concatenation('EnumValues', [123], 'EnumValues'))->setDefaultId('EnumValues'), 
            new Repetition(125, 0, 1, 'Documentation', null), 
            new Repetition(126, 0, 1, '__enumDefinitionValue', null), 
            new Repetition(127, 0, 1, 'Directives', null), 
            (new Concatenation('EnumValue', [125, 'ValueName', 126, 127], 'EnumValue'))->setDefaultId('EnumValue'), 
            new Terminal(129, 'T_COLON', false), 
            new Terminal(130, 'T_EQUAL', false), 
            new Concatenation(131, ['Value'], null), 
            new Concatenation('__enumDefinitionValue', [129, 'TypeHint', 130, 131], null), 
            new Repetition(133, 0, 1, 'Documentation', null), 
            new Concatenation(134, ['InputDefinitionBody'], null), 
            (new Concatenation('InputDefinition', [133, 'InputDefinitionHead', 134], 'InputDefinition'))->setDefaultId('InputDefinition'), 
            new Terminal(136, 'T_INPUT', false), 
            new Repetition(137, 0, 1, 'Directives', null), 
            new Concatenation('InputDefinitionHead', [136, 'TypeName', 137], null), 
            new Terminal(139, 'T_BRACE_OPEN', false), 
            new Repetition(140, 0, 1, 'InputFieldDefinitions', null), 
            new Terminal(141, 'T_BRACE_CLOSE', false), 
            new Concatenation('InputDefinitionBody', [139, 140, 141], null), 
            new Repetition(143, 1, -1, 'InputFieldDefinition', null), 
            (new Concatenation('InputFieldDefinitions', [143], 'InputFieldDefinitions'))->setDefaultId('InputFieldDefinitions'), 
            new Repetition(145, 0, 1, 'Documentation', null), 
            new Repetition(146, 0, 1, '__inputFieldDefinitionDefaultValue', null), 
            new Repetition(147, 0, 1, 'Directives', null), 
            (new Concatenation('InputFieldDefinition', [145, '__inputFieldDefinitionBody', 146, 147], 'InputFieldDefinition'))->setDefaultId('InputFieldDefinition'), 
            new Terminal(149, 'T_COLON', false), 
            new Concatenation(150, ['TypeHint'], null), 
            new Concatenation('__inputFieldDefinitionBody', ['DependentName', 149, 150], null), 
            new Terminal(152, 'T_EQUAL', false), 
            new Concatenation(153, ['Value'], null), 
            new Concatenation('__inputFieldDefinitionDefaultValue', [152, 153], null), 
            new Repetition(155, 0, 1, 'Documentation', null), 
            new Concatenation(156, ['InterfaceDefinitionBody'], null), 
            (new Concatenation('InterfaceDefinition', [155, 'InterfaceDefinitionHead', 156], 'InterfaceDefinition'))->setDefaultId('InterfaceDefinition'), 
            new Terminal(158, 'T_INTERFACE', false), 
            new Repetition(159, 0, 1, 'TypeDefinitionImplementations', null), 
            new Repetition(160, 0, 1, 'Directives', null), 
            new Concatenation('InterfaceDefinitionHead', [158, 'TypeName', 159, 160], null), 
            new Terminal(162, 'T_BRACE_OPEN', false), 
            new Repetition(163, 0, 1, 'FieldDefinitions', null), 
            new Terminal(164, 'T_BRACE_CLOSE', false), 
            new Concatenation('InterfaceDefinitionBody', [162, 163, 164], null), 
            new Repetition(166, 0, 1, 'Documentation', null), 
            new Concatenation(167, ['ObjectDefinitionBody'], null), 
            (new Concatenation('ObjectDefinition', [166, 'ObjectDefinitionHead', 167], 'ObjectDefinition'))->setDefaultId('ObjectDefinition'), 
            new Terminal(169, 'T_TYPE', false), 
            new Repetition(170, 0, 1, 'TypeDefinitionImplementations', null), 
            new Repetition(171, 0, 1, 'Directives', null), 
            new Concatenation('ObjectDefinitionHead', [169, 'TypeName', 170, 171], null), 
            new Terminal(173, 'T_BRACE_OPEN', false), 
            new Repetition(174, 0, 1, 'FieldDefinitions', null), 
            new Terminal(175, 'T_BRACE_CLOSE', false), 
            new Concatenation('ObjectDefinitionBody', [173, 174, 175], null), 
            new Repetition(177, 0, 1, 'Documentation', null), 
            new Concatenation(178, ['ScalarDefinitionBody'], null), 
            (new Concatenation('ScalarDefinition', [177, 178], 'ScalarDefinition'))->setDefaultId('ScalarDefinition'), 
            new Terminal(180, 'T_SCALAR', false), 
            new Repetition(181, 0, 1, 'TypeDefinitionExtends', null), 
            new Repetition(182, 0, 1, 'Directives', null), 
            new Concatenation('ScalarDefinitionBody', [180, 'TypeName', 181, 182], null), 
            new Repetition(184, 0, 1, 'Documentation', null), 
            new Concatenation(185, ['SchemaDefinitionBody'], null), 
            (new Concatenation('SchemaDefinition', [184, 'SchemaDefinitionHead', 185], 'SchemaDefinition'))->setDefaultId('SchemaDefinition'), 
            new Terminal(187, 'T_SCHEMA', false), 
            new Repetition(188, 0, 1, 'TypeName', null), 
            new Repetition(189, 0, 1, 'Directives', null), 
            new Concatenation('SchemaDefinitionHead', [187, 188, 189], null), 
            new Terminal(191, 'T_BRACE_OPEN', false), 
            new Repetition(192, 0, 1, 'SchemaFields', null), 
            new Terminal(193, 'T_BRACE_CLOSE', false), 
            new Concatenation('SchemaDefinitionBody', [191, 192, 193], null), 
            new Repetition(195, 1, -1, 'SchemaField', null), 
            (new Concatenation('SchemaFields', [195], 'SchemaFields'))->setDefaultId('SchemaFields'), 
            new Terminal(197, 'T_COLON', false), 
            new Concatenation(198, ['TypeHint'], null), 
            (new Concatenation('SchemaField', ['DependentName', 197, 198], 'SchemaField'))->setDefaultId('SchemaField'), 
            new Repetition(200, 0, 1, 'Documentation', null), 
            new Repetition(201, 0, 1, 'UnionDefinitionBody', null), 
            (new Concatenation('UnionDefinition', [200, 'UnionDefinitionHead', 201], 'UnionDefinition'))->setDefaultId('UnionDefinition'), 
            new Terminal(203, 'T_UNION', false), 
            new Repetition(204, 0, 1, 'Directives', null), 
            new Concatenation('UnionDefinitionHead', [203, 'TypeName', 204], null), 
            new Terminal(206, 'T_EQUAL', false), 
            new Terminal(207, 'T_OR', false), 
            new Repetition(208, 0, 1, 207, null), 
            new Repetition(209, 0, 1, '__unionDefinitionTargets', null), 
            new Concatenation('UnionDefinitionBody', [206, 208, 209], null), 
            new Terminal(211, 'T_OR', false), 
            new Concatenation(212, [211, 'TypeName'], null), 
            new Repetition(213, 0, -1, 212, null), 
            new Concatenation('__unionDefinitionTargets', ['TypeName', 213], 'UnionDefinitionTargets'), 
            new Repetition(215, 1, -1, 'ArgumentDefinition', null), 
            (new Concatenation('ArgumentDefinitions', [215], 'ArgumentDefinitions'))->setDefaultId('ArgumentDefinitions'), 
            new Repetition(217, 0, 1, 'Documentation', null), 
            new Repetition(218, 0, 1, '__argumentDefinitionDefaultValue', null), 
            new Repetition(219, 0, 1, 'Directives', null), 
            (new Concatenation('ArgumentDefinition', [217, '__argumentDefinitionBody', 218, 219], 'ArgumentDefinition'))->setDefaultId('ArgumentDefinition'), 
            new Terminal(221, 'T_COLON', false), 
            new Concatenation(222, ['TypeHint'], null), 
            new Concatenation('__argumentDefinitionBody', ['DependentName', 221, 222], null), 
            new Terminal(224, 'T_EQUAL', false), 
            new Concatenation(225, ['Value'], null), 
            new Concatenation('__argumentDefinitionDefaultValue', [224, 225], null), 
            new Repetition(227, 1, -1, 'FieldDefinition', null), 
            (new Concatenation('FieldDefinitions', [227], 'FieldDefinitions'))->setDefaultId('FieldDefinitions'), 
            new Repetition(229, 0, 1, 'Documentation', null), 
            new Repetition(230, 0, 1, '__fieldDefinitionArguments', null), 
            new Terminal(231, 'T_COLON', false), 
            new Repetition(232, 0, 1, 'Directives', null), 
            (new Concatenation('FieldDefinition', [229, 'DependentName', 230, 231, 'TypeHint', 232], 'FieldDefinition'))->setDefaultId('FieldDefinition'), 
            new Terminal(234, 'T_PARENTHESIS_OPEN', false), 
            new Repetition(235, 0, 1, 'ArgumentDefinitions', null), 
            new Terminal(236, 'T_PARENTHESIS_CLOSE', false), 
            new Concatenation('__fieldDefinitionArguments', [234, 235, 236], null), 
            new Concatenation(238, ['UnionDefinition'], null), 
            new Alternation('Definition', ['DirectiveDefinition', 'SchemaDefinition', 'EnumDefinition', 'InputDefinition', 'InterfaceDefinition', 'ObjectDefinition', 'ScalarDefinition', 238], null), 
            new Repetition(240, 0, 1, 'Documentation', null), 
            new Terminal(241, 'T_EXTEND', false), 
            new Concatenation(242, ['__enumExtensionVariants'], null), 
            (new Concatenation('EnumExtension', [240, 241, 242], 'EnumExtension'))->setDefaultId('EnumExtension'), 
            new Concatenation(244, ['EnumDefinitionHead', 'EnumDefinitionBody'], null), 
            new Alternation('__enumExtensionVariants', ['EnumDefinitionHead', 244], null), 
            new Repetition(246, 0, 1, 'Documentation', null), 
            new Terminal(247, 'T_EXTEND', false), 
            new Concatenation(248, ['__inputExtensionVariants'], null), 
            (new Concatenation('InputExtension', [246, 247, 248], 'InputExtension'))->setDefaultId('InputExtension'), 
            new Concatenation(250, ['InputDefinitionHead', 'InputDefinitionBody'], null), 
            new Alternation('__inputExtensionVariants', ['InputDefinitionHead', 250], null), 
            new Repetition(252, 0, 1, 'Documentation', null), 
            new Terminal(253, 'T_EXTEND', false), 
            new Concatenation(254, ['__interfaceExtensionVariants'], null), 
            (new Concatenation('InterfaceExtension', [252, 253, 254], 'InterfaceExtension'))->setDefaultId('InterfaceExtension'), 
            new Concatenation(256, ['InterfaceDefinitionHead', 'InterfaceDefinitionBody'], null), 
            new Alternation('__interfaceExtensionVariants', ['InterfaceDefinitionHead', 256], null), 
            new Repetition(258, 0, 1, 'Documentation', null), 
            new Terminal(259, 'T_EXTEND', false), 
            new Concatenation(260, ['__objectExtensionVariants'], null), 
            (new Concatenation('ObjectExtension', [258, 259, 260], 'ObjectExtension'))->setDefaultId('ObjectExtension'), 
            new Concatenation(262, ['ObjectDefinitionHead', 'ObjectDefinitionBody'], null), 
            new Alternation('__objectExtensionVariants', ['ObjectDefinitionHead', 262], null), 
            new Repetition(264, 0, 1, 'Documentation', null), 
            new Terminal(265, 'T_EXTEND', false), 
            new Concatenation(266, ['__scalarExtensionVariants'], null), 
            (new Concatenation('ScalarExtension', [264, 265, 266], 'ScalarExtension'))->setDefaultId('ScalarExtension'), 
            new Concatenation('__scalarExtensionVariants', ['ScalarDefinitionBody'], null), 
            new Repetition(269, 0, 1, 'Documentation', null), 
            new Terminal(270, 'T_EXTEND', false), 
            new Concatenation(271, ['__schemaExtensionVariants'], null), 
            (new Concatenation('SchemaExtension', [269, 270, 271], 'SchemaExtension'))->setDefaultId('SchemaExtension'), 
            new Concatenation(273, ['SchemaDefinitionHead', 'SchemaDefinitionBody'], null), 
            new Alternation('__schemaExtensionVariants', ['SchemaDefinitionHead', 273], null), 
            new Repetition(275, 0, 1, 'Documentation', null), 
            new Terminal(276, 'T_EXTEND', false), 
            new Concatenation(277, ['__unionExtensionVariants'], null), 
            (new Concatenation('UnionExtension', [275, 276, 277], 'UnionExtension'))->setDefaultId('UnionExtension'), 
            new Concatenation(279, ['UnionDefinitionHead', 'UnionDefinitionBody'], null), 
            new Alternation('__unionExtensionVariants', ['UnionDefinitionHead', 279], null), 
            new Concatenation(281, ['UnionExtension'], null), 
            new Alternation('Extension', ['EnumExtension', 'InputExtension', 'InterfaceExtension', 'ObjectExtension', 'ScalarExtension', 'SchemaExtension', 281], null), 
            new Repetition(283, 1, -1, 'DirectiveInvocation', null), 
            (new Concatenation('Directives', [283], 'Directives'))->setDefaultId('Directives'), 
            new Terminal(285, 'T_DIRECTIVE_AT', false), 
            new Repetition(286, 0, 1, '__directiveInvocationArgumentsGroup', null), 
            (new Concatenation('DirectiveInvocation', [285, 'TypeName', 286], 'DirectiveInvocation'))->setDefaultId('DirectiveInvocation'), 
            new Terminal(288, 'T_PARENTHESIS_OPEN', false), 
            new Repetition(289, 0, 1, '__directiveInvocationArguments', null), 
            new Terminal(290, 'T_PARENTHESIS_CLOSE', false), 
            new Concatenation('__directiveInvocationArgumentsGroup', [288, 289, 290], null), 
            new Repetition('__directiveInvocationArguments', 1, -1, 'ArgumentInvocation', null), 
            new Terminal(293, 'T_COLON', false), 
            new Concatenation(294, ['Value'], null), 
            (new Concatenation('ArgumentInvocation', ['DependentName', 293, 294], 'ArgumentInvocation'))->setDefaultId('ArgumentInvocation'), 
            new Terminal(296, 'T_BRACE_OPEN', false), 
            new Repetition(297, 0, 1, 'InputInvocationArguments', null), 
            new Terminal(298, 'T_BRACE_CLOSE', false), 
            (new Concatenation('InputInvocation', [296, 297, 298], 'InputInvocation'))->setDefaultId('InputInvocation'), 
            new Repetition(300, 1, -1, 'ArgumentInvocation', null), 
            (new Concatenation('InputInvocationArguments', [300], 'InputInvocationArguments'))->setDefaultId('InputInvocationArguments')
        ], static::PARSER_ROOT_RULE, static::PARSER_DELEGATES);
    }
}
