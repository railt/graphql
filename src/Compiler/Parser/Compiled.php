<?php
/**
 * This file is part of Parser package.
 * 
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Parser;

use Railt\Compiler\Parser\Runtime as CompiledRuntime;
use Railt\Compiler\Lexer\NativeStateful as CompiledLexer;

/**
 * This class has been auto-generated by the Railt\Compiler\Generator
 */
final class Compiled extends CompiledRuntime
{
    /**#@+
     * List of Compiled::class tokens defined as public constants
     */
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
    public const T_NUMBER = 'T_NUMBER';
    public const T_TRUE = 'T_TRUE';
    public const T_FALSE = 'T_FALSE';
    public const T_NULL = 'T_NULL';
    public const T_BLOCK_STRING = 'T_BLOCK_STRING';
    public const T_STRING = 'T_STRING';
    public const T_NAMESPACE = 'T_NAMESPACE';
    public const T_NAMESPACE_SEPARATOR = 'T_NAMESPACE_SEPARATOR';
    public const T_EXTENDS = 'T_EXTENDS';
    public const T_IMPLEMENTS = 'T_IMPLEMENTS';
    public const T_ON = 'T_ON';
    public const T_TYPE = 'T_TYPE';
    public const T_ENUM = 'T_ENUM';
    public const T_UNION = 'T_UNION';
    public const T_INPUT_UNION = 'T_INPUT_UNION';
    public const T_INTERFACE = 'T_INTERFACE';
    public const T_SCHEMA = 'T_SCHEMA';
    public const T_SCALAR = 'T_SCALAR';
    public const T_DIRECTIVE = 'T_DIRECTIVE';
    public const T_INPUT = 'T_INPUT';
    public const T_EXTEND = 'T_EXTEND';
    public const T_FRAGMENT = 'T_FRAGMENT';
    public const T_VARIABLE = 'T_VARIABLE';
    public const T_NAME = 'T_NAME';
    public const T_WHITESPACE = 'T_WHITESPACE';
    public const T_COMMENT = 'T_COMMENT';
    public const T_COMMA = 'T_COMMA';
    /**#@-*/

    public function __construct()
    {
        parent::__construct(new CompiledLexer('/\\G(?P<T_AND>&)|(?P<T_OR>\\|)|(?P<T_PARENTHESIS_OPEN>\\()|(?P<T_PARENTHESIS_CLOSE>\\))|(?P<T_BRACKET_OPEN>\\[)|(?P<T_BRACKET_CLOSE>\\])|(?P<T_BRACE_OPEN>{)|(?P<T_BRACE_CLOSE>})|(?P<T_NON_NULL>!)|(?P<T_THREE_DOTS>\\.\\.\\.)|(?P<T_COLON>:)|(?P<T_EQUAL>=)|(?P<T_DIRECTIVE_AT>@)|(?P<T_NUMBER>\\-?(0|[1-9][0-9]*)(\\.[0-9]+)?([eE][\\+\\-]?[0-9]+)?\\b)|(?P<T_TRUE>true\\b)|(?P<T_FALSE>false\\b)|(?P<T_NULL>null\\b)|(?P<T_BLOCK_STRING>"""(?:\\\\"""|(?!""").|\\s)+""")|(?P<T_STRING>"[^"\\\\]+(\\\\.[^"\\\\]*)*")|(?P<T_NAMESPACE>namespace\\b)|(?P<T_NAMESPACE_SEPARATOR>\\/)|(?P<T_EXTENDS>extends\\b)|(?P<T_IMPLEMENTS>implements\\b)|(?P<T_ON>on\\b)|(?P<T_TYPE>type\\b)|(?P<T_ENUM>enum\\b)|(?P<T_UNION>union\\b)|(?P<T_INPUT_UNION>inputUnion\\b)|(?P<T_INTERFACE>interface\\b)|(?P<T_SCHEMA>schema\\b)|(?P<T_SCALAR>scalar\\b)|(?P<T_DIRECTIVE>directive\\b)|(?P<T_INPUT>input\\b)|(?P<T_EXTEND>extend\\b)|(?P<T_FRAGMENT>fragment\\b)|(?P<T_VARIABLE>\\$[_A-Za-z][_0-9A-Za-z]*)|(?P<T_NAME>[_A-Za-z][_0-9A-Za-z]*)|(?P<T_WHITESPACE>(\\xfe\\xff|\\x20|\\x09|\\x0a|\\x0d)+)|(?P<T_COMMENT>#[^\\n]*)|(?P<T_COMMA>,)|(?P<T_UNKNOWN>.*?)/usS', ['T_WHITESPACE','T_COMMENT','T_COMMA',]), [
                            0 =>
new \Railt\Compiler\Parser\Rule\Repetition(0, 0, -1, ['DocumentImports',], null),
                            1 =>
new \Railt\Compiler\Parser\Rule\Repetition(1, 0, -1, ['DocumentDefinitions',], null),
                            'Document' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Document', [0,1,], '#Document'),
                            'DocumentImports' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DocumentImports', ['Directive',], null),
                            'DocumentDefinitions' =>
new \Railt\Compiler\Parser\Rule\Alternation('DocumentDefinitions', ['Extension','Definition',], null),
                            'NameWithoutReserved' =>
new \Railt\Compiler\Parser\Rule\Token('NameWithoutReserved', 'T_NAME', true),
                            6 =>
new \Railt\Compiler\Parser\Rule\Token(6, 'T_TRUE', true),
                            7 =>
new \Railt\Compiler\Parser\Rule\Token(7, 'T_FALSE', true),
                            8 =>
new \Railt\Compiler\Parser\Rule\Token(8, 'T_NULL', true),
                            9 =>
new \Railt\Compiler\Parser\Rule\Alternation(9, ['NameExceptValues',6,7,8,], null),
                            'NameWithReserved' =>
new \Railt\Compiler\Parser\Rule\Concatenation('NameWithReserved', [9,], '#Name'),
                            11 =>
new \Railt\Compiler\Parser\Rule\Token(11, 'T_NAMESPACE', true),
                            12 =>
new \Railt\Compiler\Parser\Rule\Token(12, 'T_EXTENDS', true),
                            13 =>
new \Railt\Compiler\Parser\Rule\Token(13, 'T_IMPLEMENTS', true),
                            14 =>
new \Railt\Compiler\Parser\Rule\Token(14, 'T_ON', true),
                            15 =>
new \Railt\Compiler\Parser\Rule\Token(15, 'T_TYPE', true),
                            16 =>
new \Railt\Compiler\Parser\Rule\Token(16, 'T_ENUM', true),
                            17 =>
new \Railt\Compiler\Parser\Rule\Token(17, 'T_UNION', true),
                            18 =>
new \Railt\Compiler\Parser\Rule\Token(18, 'T_INPUT_UNION', true),
                            19 =>
new \Railt\Compiler\Parser\Rule\Token(19, 'T_INTERFACE', true),
                            20 =>
new \Railt\Compiler\Parser\Rule\Token(20, 'T_SCHEMA', true),
                            21 =>
new \Railt\Compiler\Parser\Rule\Token(21, 'T_SCALAR', true),
                            22 =>
new \Railt\Compiler\Parser\Rule\Token(22, 'T_DIRECTIVE', true),
                            23 =>
new \Railt\Compiler\Parser\Rule\Token(23, 'T_INPUT', true),
                            24 =>
new \Railt\Compiler\Parser\Rule\Token(24, 'T_EXTEND', true),
                            25 =>
new \Railt\Compiler\Parser\Rule\Token(25, 'T_FRAGMENT', true),
                            'NameExceptValues' =>
new \Railt\Compiler\Parser\Rule\Alternation('NameExceptValues', ['NameWithoutReserved',11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,], null),
                            27 =>
new \Railt\Compiler\Parser\Rule\Token(27, 'T_VARIABLE', true),
                            'Variable' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Variable', [27,], '#Variable'),
                            29 =>
new \Railt\Compiler\Parser\Rule\Repetition(29, 0, 1, ['GlobalTypeNamespace',], null),
                            30 =>
new \Railt\Compiler\Parser\Rule\Token(30, 'T_NAMESPACE_SEPARATOR', false),
                            31 =>
new \Railt\Compiler\Parser\Rule\Concatenation(31, ['NameWithReserved',30,], '#TypeName'),
                            32 =>
new \Railt\Compiler\Parser\Rule\Repetition(32, 0, -1, [31,], null),
                            'TypeName' =>
new \Railt\Compiler\Parser\Rule\Concatenation('TypeName', [29,32,'NameWithReserved',], null),
                            34 =>
new \Railt\Compiler\Parser\Rule\Token(34, 'T_NAMESPACE_SEPARATOR', false),
                            'GlobalTypeNamespace' =>
new \Railt\Compiler\Parser\Rule\Concatenation('GlobalTypeNamespace', [34,], '#GlobalTypeNamespace'),
                            36 =>
new \Railt\Compiler\Parser\Rule\Token(36, 'T_FALSE', true),
                            37 =>
new \Railt\Compiler\Parser\Rule\Concatenation(37, [36,], '#Boolean'),
                            38 =>
new \Railt\Compiler\Parser\Rule\Token(38, 'T_TRUE', true),
                            39 =>
new \Railt\Compiler\Parser\Rule\Concatenation(39, [38,], '#Boolean'),
                            'Boolean' =>
new \Railt\Compiler\Parser\Rule\Alternation('Boolean', [37,39,], null),
                            41 =>
new \Railt\Compiler\Parser\Rule\Token(41, 'T_NUMBER', true),
                            'Number' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Number', [41,], '#Number'),
                            43 =>
new \Railt\Compiler\Parser\Rule\Token(43, 'T_BLOCK_STRING', true),
                            44 =>
new \Railt\Compiler\Parser\Rule\Concatenation(44, [43,], '#String'),
                            45 =>
new \Railt\Compiler\Parser\Rule\Token(45, 'T_STRING', true),
                            46 =>
new \Railt\Compiler\Parser\Rule\Concatenation(46, [45,], '#String'),
                            'String' =>
new \Railt\Compiler\Parser\Rule\Alternation('String', [44,46,], null),
                            48 =>
new \Railt\Compiler\Parser\Rule\Token(48, 'T_NULL', true),
                            'Null' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Null', [48,], '#Null'),
                            50 =>
new \Railt\Compiler\Parser\Rule\Token(50, 'T_BRACE_OPEN', false),
                            51 =>
new \Railt\Compiler\Parser\Rule\Repetition(51, 0, -1, ['__inputPair',], null),
                            52 =>
new \Railt\Compiler\Parser\Rule\Token(52, 'T_BRACE_CLOSE', false),
                            'Input' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Input', [50,51,52,], '#Input'),
                            54 =>
new \Railt\Compiler\Parser\Rule\Token(54, 'T_COLON', false),
                            '__inputPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__inputPair', ['NameWithReserved',54,'Value',], '#Pair'),
                            56 =>
new \Railt\Compiler\Parser\Rule\Token(56, 'T_BRACKET_OPEN', false),
                            57 =>
new \Railt\Compiler\Parser\Rule\Repetition(57, 0, -1, ['Value',], null),
                            58 =>
new \Railt\Compiler\Parser\Rule\Token(58, 'T_BRACKET_CLOSE', false),
                            'List' =>
new \Railt\Compiler\Parser\Rule\Concatenation('List', [56,57,58,], '#List'),
                            60 =>
new \Railt\Compiler\Parser\Rule\Concatenation(60, ['NameWithReserved',], '#Value'),
                            61 =>
new \Railt\Compiler\Parser\Rule\Concatenation(61, ['Boolean',], '#Value'),
                            62 =>
new \Railt\Compiler\Parser\Rule\Concatenation(62, ['Number',], '#Value'),
                            63 =>
new \Railt\Compiler\Parser\Rule\Concatenation(63, ['String',], '#Value'),
                            64 =>
new \Railt\Compiler\Parser\Rule\Concatenation(64, ['Input',], '#Value'),
                            65 =>
new \Railt\Compiler\Parser\Rule\Concatenation(65, ['Null',], '#Value'),
                            66 =>
new \Railt\Compiler\Parser\Rule\Concatenation(66, ['List',], '#Value'),
                            'Value' =>
new \Railt\Compiler\Parser\Rule\Alternation('Value', [60,61,62,63,64,65,66,], null),
                            'Documentation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Documentation', ['String',], '#Description'),
                            69 =>
new \Railt\Compiler\Parser\Rule\Concatenation(69, ['__returnListDefinition',], '#ReturnTypeDefinition'),
                            70 =>
new \Railt\Compiler\Parser\Rule\Concatenation(70, ['__returnTypeDefinition',], '#ReturnTypeDefinition'),
                            'ReturnTypeDefinition' =>
new \Railt\Compiler\Parser\Rule\Alternation('ReturnTypeDefinition', [69,70,], null),
                            72 =>
new \Railt\Compiler\Parser\Rule\Token(72, 'T_NON_NULL', true),
                            '__returnTypeNonNullModifier' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__returnTypeNonNullModifier', [72,], '#NonNull'),
                            74 =>
new \Railt\Compiler\Parser\Rule\Token(74, 'T_BRACKET_OPEN', false),
                            75 =>
new \Railt\Compiler\Parser\Rule\Token(75, 'T_BRACKET_CLOSE', false),
                            76 =>
new \Railt\Compiler\Parser\Rule\Repetition(76, 0, 1, ['__returnTypeNonNullModifier',], null),
                            '__returnListDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__returnListDefinition', [74,'__returnTypeDefinition',75,76,], '#List'),
                            78 =>
new \Railt\Compiler\Parser\Rule\Repetition(78, 0, 1, ['__returnTypeDefinitionArguments',], null),
                            79 =>
new \Railt\Compiler\Parser\Rule\Concatenation(79, ['TypeName',78,], null),
                            80 =>
new \Railt\Compiler\Parser\Rule\Alternation(80, [79,'Variable',], null),
                            81 =>
new \Railt\Compiler\Parser\Rule\Repetition(81, 0, 1, ['__returnTypeNonNullModifier',], null),
                            '__returnTypeDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__returnTypeDefinition', [80,81,], '#Type'),
                            83 =>
new \Railt\Compiler\Parser\Rule\Token(83, 'T_PARENTHESIS_OPEN', false),
                            84 =>
new \Railt\Compiler\Parser\Rule\Repetition(84, 0, -1, ['ArgumentDefinition',], null),
                            85 =>
new \Railt\Compiler\Parser\Rule\Token(85, 'T_PARENTHESIS_CLOSE', false),
                            '__returnTypeDefinitionArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__returnTypeDefinitionArguments', [83,84,85,], '#TypeArguments'),
                            87 =>
new \Railt\Compiler\Parser\Rule\Token(87, 'T_IMPLEMENTS', false),
                            88 =>
new \Railt\Compiler\Parser\Rule\Token(88, 'T_AND', false),
                            89 =>
new \Railt\Compiler\Parser\Rule\Concatenation(89, [88,'TypeName',], null),
                            90 =>
new \Railt\Compiler\Parser\Rule\Repetition(90, 0, -1, [89,], null),
                            'TypeDefinitionImplements' =>
new \Railt\Compiler\Parser\Rule\Concatenation('TypeDefinitionImplements', [87,'TypeName',90,], '#Implements'),
                            92 =>
new \Railt\Compiler\Parser\Rule\Token(92, 'T_PARENTHESIS_OPEN', false),
                            93 =>
new \Railt\Compiler\Parser\Rule\Repetition(93, 0, -1, ['__genericArgumentDefinition',], null),
                            94 =>
new \Railt\Compiler\Parser\Rule\Token(94, 'T_PARENTHESIS_CLOSE', false),
                            'GenericArgumentsDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('GenericArgumentsDefinition', [92,93,94,], null),
                            96 =>
new \Railt\Compiler\Parser\Rule\Token(96, 'T_COLON', false),
                            '__genericArgumentDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__genericArgumentDefinition', ['Variable',96,'TypeName',], '#GenericArgument'),
                            98 =>
new \Railt\Compiler\Parser\Rule\Repetition(98, 0, 1, ['Documentation',], null),
                            99 =>
new \Railt\Compiler\Parser\Rule\Token(99, 'T_COLON', false),
                            100 =>
new \Railt\Compiler\Parser\Rule\Repetition(100, 0, 1, ['__argumentDefinitionDefaultValue',], null),
                            'ArgumentDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentDefinition', [98,'NameWithReserved',99,'ReturnTypeDefinition',100,], '#ArgumentDefinition'),
                            102 =>
new \Railt\Compiler\Parser\Rule\Token(102, 'T_EQUAL', false),
                            '__argumentDefinitionDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__argumentDefinitionDefaultValue', [102,'Value',], null),
                            104 =>
new \Railt\Compiler\Parser\Rule\Repetition(104, 0, 1, ['Documentation',], null),
                            105 =>
new \Railt\Compiler\Parser\Rule\Repetition(105, 0, 1, ['__fieldDefinitionArguments',], null),
                            106 =>
new \Railt\Compiler\Parser\Rule\Token(106, 'T_COLON', false),
                            107 =>
new \Railt\Compiler\Parser\Rule\Repetition(107, 0, -1, ['Directive',], null),
                            'FieldDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('FieldDefinition', [104,'NameWithReserved',105,106,'ReturnTypeDefinition',107,], '#FieldDefinition'),
                            109 =>
new \Railt\Compiler\Parser\Rule\Token(109, 'T_PARENTHESIS_OPEN', false),
                            110 =>
new \Railt\Compiler\Parser\Rule\Repetition(110, 0, -1, ['__fieldDefinitionArgument',], null),
                            111 =>
new \Railt\Compiler\Parser\Rule\Token(111, 'T_PARENTHESIS_CLOSE', false),
                            '__fieldDefinitionArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__fieldDefinitionArguments', [109,110,111,], null),
                            113 =>
new \Railt\Compiler\Parser\Rule\Repetition(113, 0, -1, ['Directive',], null),
                            '__fieldDefinitionArgument' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__fieldDefinitionArgument', ['ArgumentDefinition',113,], null),
                            115 =>
new \Railt\Compiler\Parser\Rule\Repetition(115, 0, 1, ['Documentation',], null),
                            'DirectiveDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinition', [115,'DirectiveDefinitionBody',], '#DirectiveDefinition'),
                            117 =>
new \Railt\Compiler\Parser\Rule\Token(117, 'T_DIRECTIVE', false),
                            118 =>
new \Railt\Compiler\Parser\Rule\Token(118, 'T_DIRECTIVE_AT', false),
                            119 =>
new \Railt\Compiler\Parser\Rule\Repetition(119, 0, 1, ['__directiveDefinitionArguments',], null),
                            120 =>
new \Railt\Compiler\Parser\Rule\Token(120, 'T_ON', false),
                            'DirectiveDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionBody', [117,118,'TypeName',119,120,'__directiveDefinitionLocations',], null),
                            122 =>
new \Railt\Compiler\Parser\Rule\Token(122, 'T_PARENTHESIS_OPEN', false),
                            123 =>
new \Railt\Compiler\Parser\Rule\Repetition(123, 0, -1, ['__directiveDefinitionArgument',], null),
                            124 =>
new \Railt\Compiler\Parser\Rule\Token(124, 'T_PARENTHESIS_CLOSE', false),
                            '__directiveDefinitionArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__directiveDefinitionArguments', [122,123,124,], null),
                            '__directiveDefinitionArgument' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__directiveDefinitionArgument', ['ArgumentDefinition',], '#DirectiveArgument'),
                            127 =>
new \Railt\Compiler\Parser\Rule\Token(127, 'T_OR', false),
                            128 =>
new \Railt\Compiler\Parser\Rule\Repetition(128, 0, 1, [127,], null),
                            129 =>
new \Railt\Compiler\Parser\Rule\Repetition(129, 1, -1, ['__directiveDefinitionLocation',], null),
                            '__directiveDefinitionLocations' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__directiveDefinitionLocations', [128,129,], '#DirectiveLocations'),
                            131 =>
new \Railt\Compiler\Parser\Rule\Token(131, 'T_OR', false),
                            132 =>
new \Railt\Compiler\Parser\Rule\Concatenation(132, [131,'NameWithReserved',], null),
                            133 =>
new \Railt\Compiler\Parser\Rule\Repetition(133, 0, -1, [132,], null),
                            '__directiveDefinitionLocation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__directiveDefinitionLocation', ['NameWithReserved',133,], null),
                            135 =>
new \Railt\Compiler\Parser\Rule\Repetition(135, 0, 1, ['Documentation',], null),
                            'EnumDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumDefinition', [135,'EnumDefinitionHead','EnumDefinitionBody',], '#EnumDefinition'),
                            137 =>
new \Railt\Compiler\Parser\Rule\Token(137, 'T_ENUM', false),
                            138 =>
new \Railt\Compiler\Parser\Rule\Repetition(138, 0, -1, ['Directive',], null),
                            'EnumDefinitionHead' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumDefinitionHead', [137,'TypeName',138,], null),
                            140 =>
new \Railt\Compiler\Parser\Rule\Token(140, 'T_BRACE_OPEN', false),
                            141 =>
new \Railt\Compiler\Parser\Rule\Repetition(141, 1, -1, ['__enumDefinitionValue',], null),
                            142 =>
new \Railt\Compiler\Parser\Rule\Token(142, 'T_BRACE_CLOSE', false),
                            'EnumDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumDefinitionBody', [140,141,142,], null),
                            144 =>
new \Railt\Compiler\Parser\Rule\Repetition(144, 0, 1, ['Documentation',], null),
                            145 =>
new \Railt\Compiler\Parser\Rule\Repetition(145, 0, -1, ['Directive',], null),
                            '__enumDefinitionValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__enumDefinitionValue', [144,'NameExceptValues',145,], '#EnumValue'),
                            147 =>
new \Railt\Compiler\Parser\Rule\Repetition(147, 0, 1, ['Documentation',], null),
                            'InputDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinition', [147,'InputDefinitionHead','InputDefinitionBody',], '#InputDefinition'),
                            149 =>
new \Railt\Compiler\Parser\Rule\Token(149, 'T_INPUT', false),
                            150 =>
new \Railt\Compiler\Parser\Rule\Repetition(150, 0, -1, ['Directive',], null),
                            'InputDefinitionHead' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinitionHead', [149,'TypeName',150,], null),
                            152 =>
new \Railt\Compiler\Parser\Rule\Token(152, 'T_BRACE_OPEN', false),
                            153 =>
new \Railt\Compiler\Parser\Rule\Repetition(153, 0, -1, ['__inputDefinitionField',], null),
                            154 =>
new \Railt\Compiler\Parser\Rule\Token(154, 'T_BRACE_CLOSE', false),
                            'InputDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinitionBody', [152,153,154,], null),
                            156 =>
new \Railt\Compiler\Parser\Rule\Repetition(156, 0, -1, ['Directive',], null),
                            '__inputDefinitionField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__inputDefinitionField', ['ArgumentDefinition',156,], '#InputField'),
                            158 =>
new \Railt\Compiler\Parser\Rule\Repetition(158, 0, 1, ['Documentation',], null),
                            'InterfaceDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinition', [158,'InterfaceDefinitionHead','InterfaceDefinitionBody',], '#InterfaceDefinition'),
                            160 =>
new \Railt\Compiler\Parser\Rule\Token(160, 'T_INTERFACE', false),
                            161 =>
new \Railt\Compiler\Parser\Rule\Repetition(161, 0, 1, ['GenericArgumentsDefinition',], null),
                            162 =>
new \Railt\Compiler\Parser\Rule\Repetition(162, 0, 1, ['TypeDefinitionImplements',], null),
                            163 =>
new \Railt\Compiler\Parser\Rule\Repetition(163, 0, -1, ['Directive',], null),
                            'InterfaceDefinitionHead' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinitionHead', [160,'TypeName',161,162,163,], null),
                            165 =>
new \Railt\Compiler\Parser\Rule\Token(165, 'T_BRACE_OPEN', false),
                            166 =>
new \Railt\Compiler\Parser\Rule\Repetition(166, 0, 1, ['__interfaceFieldDefinitions',], null),
                            167 =>
new \Railt\Compiler\Parser\Rule\Repetition(167, 0, 1, ['ChildrenDefinitions',], null),
                            168 =>
new \Railt\Compiler\Parser\Rule\Token(168, 'T_BRACE_CLOSE', false),
                            'InterfaceDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinitionBody', [165,166,167,168,], null),
                            170 =>
new \Railt\Compiler\Parser\Rule\Repetition(170, 0, -1, ['FieldDefinition',], null),
                            '__interfaceFieldDefinitions' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__interfaceFieldDefinitions', [170,], '#FieldDefinitions'),
                            172 =>
new \Railt\Compiler\Parser\Rule\Repetition(172, 0, 1, ['Documentation',], null),
                            'ObjectDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinition', [172,'ObjectDefinitionHead','ObjectDefinitionBody',], '#ObjectDefinition'),
                            174 =>
new \Railt\Compiler\Parser\Rule\Token(174, 'T_TYPE', false),
                            175 =>
new \Railt\Compiler\Parser\Rule\Repetition(175, 0, 1, ['GenericArgumentsDefinition',], null),
                            176 =>
new \Railt\Compiler\Parser\Rule\Repetition(176, 0, 1, ['TypeDefinitionImplements',], null),
                            177 =>
new \Railt\Compiler\Parser\Rule\Repetition(177, 0, -1, ['Directive',], null),
                            'ObjectDefinitionHead' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionHead', [174,'TypeName',175,176,177,], null),
                            179 =>
new \Railt\Compiler\Parser\Rule\Token(179, 'T_BRACE_OPEN', false),
                            180 =>
new \Railt\Compiler\Parser\Rule\Repetition(180, 0, 1, ['__objectFieldDefinitions',], null),
                            181 =>
new \Railt\Compiler\Parser\Rule\Repetition(181, 0, 1, ['ChildrenDefinitions',], null),
                            182 =>
new \Railt\Compiler\Parser\Rule\Token(182, 'T_BRACE_CLOSE', false),
                            'ObjectDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionBody', [179,180,181,182,], null),
                            184 =>
new \Railt\Compiler\Parser\Rule\Repetition(184, 0, -1, ['FieldDefinition',], null),
                            '__objectFieldDefinitions' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__objectFieldDefinitions', [184,], '#FieldDefinitions'),
                            186 =>
new \Railt\Compiler\Parser\Rule\Repetition(186, 0, 1, ['Documentation',], null),
                            'ScalarDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ScalarDefinition', [186,'ScalarDefinitionBody',], '#ScalarDefinition'),
                            188 =>
new \Railt\Compiler\Parser\Rule\Token(188, 'T_SCALAR', false),
                            189 =>
new \Railt\Compiler\Parser\Rule\Repetition(189, 0, 1, ['__scalarExtends',], null),
                            190 =>
new \Railt\Compiler\Parser\Rule\Repetition(190, 0, -1, ['Directive',], null),
                            'ScalarDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ScalarDefinitionBody', [188,'TypeName',189,190,], null),
                            192 =>
new \Railt\Compiler\Parser\Rule\Token(192, 'T_EXTENDS', false),
                            '__scalarExtends' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__scalarExtends', [192,'TypeName',], '#Extends'),
                            194 =>
new \Railt\Compiler\Parser\Rule\Repetition(194, 0, 1, ['Documentation',], null),
                            'SchemaDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinition', [194,'SchemaDefinitionBody',], '#SchemaDefinition'),
                            196 =>
new \Railt\Compiler\Parser\Rule\Token(196, 'T_SCHEMA', false),
                            197 =>
new \Railt\Compiler\Parser\Rule\Repetition(197, 0, 1, ['TypeName',], null),
                            198 =>
new \Railt\Compiler\Parser\Rule\Token(198, 'T_BRACE_OPEN', false),
                            199 =>
new \Railt\Compiler\Parser\Rule\Repetition(199, 0, -1, ['__schemaField',], null),
                            200 =>
new \Railt\Compiler\Parser\Rule\Token(200, 'T_BRACE_CLOSE', false),
                            'SchemaDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionBody', [196,197,198,199,200,], null),
                            202 =>
new \Railt\Compiler\Parser\Rule\Token(202, 'T_COLON', false),
                            '__schemaField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__schemaField', ['NameWithReserved',202,'TypeName',], '#SchemaField'),
                            204 =>
new \Railt\Compiler\Parser\Rule\Repetition(204, 0, 1, ['Documentation',], null),
                            'UnionDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionDefinition', [204,'UnionDefinitionBody',], '#UnionDefinition'),
                            206 =>
new \Railt\Compiler\Parser\Rule\Token(206, 'T_UNION', false),
                            207 =>
new \Railt\Compiler\Parser\Rule\Repetition(207, 0, -1, ['Directive',], null),
                            208 =>
new \Railt\Compiler\Parser\Rule\Token(208, 'T_EQUAL', false),
                            209 =>
new \Railt\Compiler\Parser\Rule\Token(209, 'T_OR', false),
                            210 =>
new \Railt\Compiler\Parser\Rule\Repetition(210, 0, 1, [209,], null),
                            211 =>
new \Railt\Compiler\Parser\Rule\Repetition(211, 1, -1, ['__unionDefinitionTargets',], null),
                            'UnionDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionDefinitionBody', [206,'TypeName',207,208,210,211,], null),
                            213 =>
new \Railt\Compiler\Parser\Rule\Token(213, 'T_OR', false),
                            214 =>
new \Railt\Compiler\Parser\Rule\Concatenation(214, [213,'TypeName',], null),
                            215 =>
new \Railt\Compiler\Parser\Rule\Repetition(215, 0, -1, [214,], null),
                            '__unionDefinitionTargets' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__unionDefinitionTargets', ['TypeName',215,], null),
                            'Definition' =>
new \Railt\Compiler\Parser\Rule\Alternation('Definition', ['DirectiveDefinition','SchemaDefinition','__typeDefinitions',], null),
                            218 =>
new \Railt\Compiler\Parser\Rule\Concatenation(218, ['__typeDefinitions',], null),
                            'ChildrenDefinitions' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ChildrenDefinitions', [218,], '#ChildrenDefinitions'),
                            '__typeDefinitions' =>
new \Railt\Compiler\Parser\Rule\Alternation('__typeDefinitions', ['EnumDefinition','InputDefinition','InterfaceDefinition','ObjectDefinition','ScalarDefinition','UnionDefinition',], null),
                            221 =>
new \Railt\Compiler\Parser\Rule\Token(221, 'T_EXTEND', false),
                            'EnumExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumExtension', [221,'__enumExtensionVariants',], '#EnumExtension'),
                            223 =>
new \Railt\Compiler\Parser\Rule\Concatenation(223, ['EnumDefinitionHead','EnumDefinitionBody',], null),
                            '__enumExtensionVariants' =>
new \Railt\Compiler\Parser\Rule\Alternation('__enumExtensionVariants', ['EnumDefinitionHead',223,], null),
                            225 =>
new \Railt\Compiler\Parser\Rule\Token(225, 'T_EXTEND', false),
                            'InputExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputExtension', [225,'__inputExtensionVariants',], '#InputExtension'),
                            227 =>
new \Railt\Compiler\Parser\Rule\Concatenation(227, ['InputDefinitionHead','InputDefinitionBody',], null),
                            '__inputExtensionVariants' =>
new \Railt\Compiler\Parser\Rule\Alternation('__inputExtensionVariants', ['InputDefinitionHead',227,], null),
                            229 =>
new \Railt\Compiler\Parser\Rule\Token(229, 'T_EXTEND', false),
                            'InterfaceExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceExtension', [229,'__interfaceExtensionVariants',], '#InterfaceExtension'),
                            231 =>
new \Railt\Compiler\Parser\Rule\Concatenation(231, ['InterfaceDefinitionHead','InterfaceDefinitionBody',], null),
                            '__interfaceExtensionVariants' =>
new \Railt\Compiler\Parser\Rule\Alternation('__interfaceExtensionVariants', ['InterfaceDefinitionHead',231,], null),
                            233 =>
new \Railt\Compiler\Parser\Rule\Token(233, 'T_EXTEND', false),
                            'ObjectExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectExtension', [233,'__objectExtensionVariants',], '#ObjectExtension'),
                            235 =>
new \Railt\Compiler\Parser\Rule\Concatenation(235, ['ObjectDefinitionHead','ObjectDefinitionBody',], null),
                            '__objectExtensionVariants' =>
new \Railt\Compiler\Parser\Rule\Alternation('__objectExtensionVariants', ['ObjectDefinitionHead',235,], null),
                            237 =>
new \Railt\Compiler\Parser\Rule\Token(237, 'T_EXTEND', false),
                            'ScalarExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ScalarExtension', [237,'ScalarDefinitionBody',], '#ScalarExtension'),
                            239 =>
new \Railt\Compiler\Parser\Rule\Token(239, 'T_EXTEND', false),
                            'SchemaExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaExtension', [239,'SchemaDefinitionBody',], '#SchemaExtension'),
                            241 =>
new \Railt\Compiler\Parser\Rule\Token(241, 'T_EXTEND', false),
                            'UnionExtension' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionExtension', [241,'UnionDefinitionBody',], '#UnionExtension'),
                            'Extension' =>
new \Railt\Compiler\Parser\Rule\Alternation('Extension', ['EnumExtension','InputExtension','InterfaceExtension','ObjectExtension','ScalarExtension','SchemaExtension','UnionExtension',], null),
                            244 =>
new \Railt\Compiler\Parser\Rule\Token(244, 'T_COLON', false),
                            'ArgumentInvocation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentInvocation', ['NameWithReserved',244,'Value',], null),
                            246 =>
new \Railt\Compiler\Parser\Rule\Token(246, 'T_DIRECTIVE_AT', false),
                            247 =>
new \Railt\Compiler\Parser\Rule\Repetition(247, 0, 1, ['__directiveInvocationArguments',], null),
                            'Directive' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Directive', [246,'TypeName',247,], '#Directive'),
                            249 =>
new \Railt\Compiler\Parser\Rule\Token(249, 'T_PARENTHESIS_OPEN', false),
                            250 =>
new \Railt\Compiler\Parser\Rule\Repetition(250, 0, -1, ['__directiveInvocationArgument',], null),
                            251 =>
new \Railt\Compiler\Parser\Rule\Token(251, 'T_PARENTHESIS_CLOSE', false),
                            '__directiveInvocationArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__directiveInvocationArguments', [249,250,251,], null),
                            '__directiveInvocationArgument' =>
new \Railt\Compiler\Parser\Rule\Concatenation('__directiveInvocationArgument', ['ArgumentInvocation',], '#DirectiveArgument'),
                            'Invocation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Invocation', ['Directive',], null),
                    ]);
    }

    /**
     * @return string Returns the lexer compilation date and time in RFC3339 format
     */
    public function getBuiltDate(): string
    {
        return '2018-06-03UTC12:50:15.000+00:00';
    }
}
