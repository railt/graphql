<?php
/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Parser;

use Railt\Compiler\Lexer\NativeStateful as SchemaParserLexer;
use Railt\Compiler\Parser\Runtime as SchemaParserRuntime;

/**
 * This class has been auto-generated by the Railt\Compiler\Generator
 */
final class SchemaParser extends SchemaParserRuntime
{
    /**#@+
     * List of SchemaParser::class tokens defined as public constants
     */
    public const T_NON_NULL            = 'T_NON_NULL';
    public const T_VAR                 = 'T_VAR';
    public const T_PARENTHESIS_OPEN    = 'T_PARENTHESIS_OPEN';
    public const T_PARENTHESIS_CLOSE   = 'T_PARENTHESIS_CLOSE';
    public const T_THREE_DOTS          = 'T_THREE_DOTS';
    public const T_COLON               = 'T_COLON';
    public const T_EQUAL               = 'T_EQUAL';
    public const T_DIRECTIVE_AT        = 'T_DIRECTIVE_AT';
    public const T_BRACKET_OPEN        = 'T_BRACKET_OPEN';
    public const T_BRACKET_CLOSE       = 'T_BRACKET_CLOSE';
    public const T_BRACE_OPEN          = 'T_BRACE_OPEN';
    public const T_BRACE_CLOSE         = 'T_BRACE_CLOSE';
    public const T_OR                  = 'T_OR';
    public const T_AND                 = 'T_AND';
    public const T_NUMBER_VALUE        = 'T_NUMBER_VALUE';
    public const T_BOOL_TRUE           = 'T_BOOL_TRUE';
    public const T_BOOL_FALSE          = 'T_BOOL_FALSE';
    public const T_NULL                = 'T_NULL';
    public const T_MULTILINE_STRING    = 'T_MULTILINE_STRING';
    public const T_STRING              = 'T_STRING';
    public const T_EXTENDS             = 'T_EXTENDS';
    public const T_TYPE_IMPLEMENTS     = 'T_TYPE_IMPLEMENTS';
    public const T_ON                  = 'T_ON';
    public const T_TYPE                = 'T_TYPE';
    public const T_ENUM                = 'T_ENUM';
    public const T_UNION               = 'T_UNION';
    public const T_INTERFACE           = 'T_INTERFACE';
    public const T_SCHEMA              = 'T_SCHEMA';
    public const T_SCHEMA_QUERY        = 'T_SCHEMA_QUERY';
    public const T_SCHEMA_MUTATION     = 'T_SCHEMA_MUTATION';
    public const T_SCHEMA_SUBSCRIPTION = 'T_SCHEMA_SUBSCRIPTION';
    public const T_SCALAR              = 'T_SCALAR';
    public const T_DIRECTIVE           = 'T_DIRECTIVE';
    public const T_INPUT               = 'T_INPUT';
    public const T_EXTEND              = 'T_EXTEND';
    public const T_NAME                = 'T_NAME';
    public const T_VARIABLE            = 'T_VARIABLE';
    public const T_WHITESPACE          = 'T_WHITESPACE';
    public const T_COMMENT             = 'T_COMMENT';
    public const T_COMMA               = 'T_COMMA';
    /**#@-*/

    public function __construct()
    {
        parent::__construct(new SchemaParserLexer('/\\G(?P<T_NON_NULL>!)|(?P<T_VAR>\\$)|(?P<T_PARENTHESIS_OPEN>\\()|(?P<T_PARENTHESIS_CLOSE>\\))|(?P<T_THREE_DOTS>\\.\\.\\.)|(?P<T_COLON>:)|(?P<T_EQUAL>=)|(?P<T_DIRECTIVE_AT>@)|(?P<T_BRACKET_OPEN>\\[)|(?P<T_BRACKET_CLOSE>\\])|(?P<T_BRACE_OPEN>{)|(?P<T_BRACE_CLOSE>})|(?P<T_OR>\\|)|(?P<T_AND>\\&)|(?P<T_NUMBER_VALUE>\\-?(0|[1-9][0-9]*)(\\.[0-9]+)?([eE][\\+\\-]?[0-9]+)?\\b)|(?P<T_BOOL_TRUE>true\\b)|(?P<T_BOOL_FALSE>false\\b)|(?P<T_NULL>null\\b)|(?P<T_MULTILINE_STRING>"""(?:\\\\"""|(?!""").|\\s)*""")|(?P<T_STRING>"[^"\\\\]*(\\\\.[^"\\\\]*)*")|(?P<T_EXTENDS>extends\\b)|(?P<T_TYPE_IMPLEMENTS>implements\\b)|(?P<T_ON>on\\b)|(?P<T_TYPE>type\\b)|(?P<T_ENUM>enum\\b)|(?P<T_UNION>union\\b)|(?P<T_INTERFACE>interface\\b)|(?P<T_SCHEMA>schema\\b)|(?P<T_SCHEMA_QUERY>query\\b)|(?P<T_SCHEMA_MUTATION>mutation\\b)|(?P<T_SCHEMA_SUBSCRIPTION>subscription\\b)|(?P<T_SCALAR>scalar\\b)|(?P<T_DIRECTIVE>directive\\b)|(?P<T_INPUT>input\\b)|(?P<T_EXTEND>extend\\b)|(?P<T_NAME>([_A-Za-z][_0-9A-Za-z]*))|(?P<T_VARIABLE>(\\$[_A-Za-z][_0-9A-Za-z]*))|(?P<T_WHITESPACE>[\\xfe\\xff|\\x20|\\x09|\\x0a|\\x0d]+)|(?P<T_COMMENT>#[^\\n]*)|(?P<T_COMMA>,)|.*?/usS', ['T_WHITESPACE', 'T_COMMENT', 'T_COMMA']), [
                            0 =>
new \Railt\Compiler\Parser\Rule\Repetition(0, 0, -1, ['Directive'], null),
                            1 =>
new \Railt\Compiler\Parser\Rule\Repetition(1, 0, -1, ['Definition'], null),
                            'Document' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Document', [0, 1], '#Document'),
                            'Definition' =>
new \Railt\Compiler\Parser\Rule\Alternation('Definition', ['ObjectDefinition', 'InterfaceDefinition', 'EnumDefinition', 'UnionDefinition', 'SchemaDefinition', 'ScalarDefinition', 'InputDefinition', 'ExtendDefinition', 'DirectiveDefinition'], null),
                            4 =>
new \Railt\Compiler\Parser\Rule\Token(4, 'T_BOOL_TRUE', true),
                            5 =>
new \Railt\Compiler\Parser\Rule\Token(5, 'T_BOOL_FALSE', true),
                            6 =>
new \Railt\Compiler\Parser\Rule\Token(6, 'T_NULL', true),
                            'ValueKeyword' =>
new \Railt\Compiler\Parser\Rule\Alternation('ValueKeyword', [4, 5, 6], null),
                            8 =>
new \Railt\Compiler\Parser\Rule\Token(8, 'T_ON', true),
                            9 =>
new \Railt\Compiler\Parser\Rule\Token(9, 'T_TYPE', true),
                            10 =>
new \Railt\Compiler\Parser\Rule\Token(10, 'T_TYPE_IMPLEMENTS', true),
                            11 =>
new \Railt\Compiler\Parser\Rule\Token(11, 'T_ENUM', true),
                            12 =>
new \Railt\Compiler\Parser\Rule\Token(12, 'T_UNION', true),
                            13 =>
new \Railt\Compiler\Parser\Rule\Token(13, 'T_INTERFACE', true),
                            14 =>
new \Railt\Compiler\Parser\Rule\Token(14, 'T_SCHEMA', true),
                            15 =>
new \Railt\Compiler\Parser\Rule\Token(15, 'T_SCHEMA_QUERY', true),
                            16 =>
new \Railt\Compiler\Parser\Rule\Token(16, 'T_SCHEMA_MUTATION', true),
                            17 =>
new \Railt\Compiler\Parser\Rule\Token(17, 'T_SCHEMA_SUBSCRIPTION', true),
                            18 =>
new \Railt\Compiler\Parser\Rule\Token(18, 'T_SCALAR', true),
                            19 =>
new \Railt\Compiler\Parser\Rule\Token(19, 'T_DIRECTIVE', true),
                            20 =>
new \Railt\Compiler\Parser\Rule\Token(20, 'T_INPUT', true),
                            21 =>
new \Railt\Compiler\Parser\Rule\Token(21, 'T_EXTEND', true),
                            'Keyword' =>
new \Railt\Compiler\Parser\Rule\Alternation('Keyword', [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21], null),
                            'Number' =>
new \Railt\Compiler\Parser\Rule\Token('Number', 'T_NUMBER_VALUE', true),
                            'Nullable' =>
new \Railt\Compiler\Parser\Rule\Token('Nullable', 'T_NULL', true),
                            25 =>
new \Railt\Compiler\Parser\Rule\Token(25, 'T_BOOL_TRUE', true),
                            26 =>
new \Railt\Compiler\Parser\Rule\Token(26, 'T_BOOL_FALSE', true),
                            'Boolean' =>
new \Railt\Compiler\Parser\Rule\Alternation('Boolean', [25, 26], null),
                            28 =>
new \Railt\Compiler\Parser\Rule\Token(28, 'T_MULTILINE_STRING', true),
                            29 =>
new \Railt\Compiler\Parser\Rule\Token(29, 'T_STRING', true),
                            'String' =>
new \Railt\Compiler\Parser\Rule\Alternation('String', [28, 29], null),
                            31 =>
new \Railt\Compiler\Parser\Rule\Token(31, 'T_NAME', true),
                            'Word' =>
new \Railt\Compiler\Parser\Rule\Alternation('Word', [31, 'ValueKeyword'], null),
                            33 =>
new \Railt\Compiler\Parser\Rule\Token(33, 'T_SCHEMA_QUERY', true),
                            34 =>
new \Railt\Compiler\Parser\Rule\Concatenation(34, [33], '#Name'),
                            35 =>
new \Railt\Compiler\Parser\Rule\Token(35, 'T_SCHEMA_MUTATION', true),
                            36 =>
new \Railt\Compiler\Parser\Rule\Concatenation(36, [35], '#Name'),
                            37 =>
new \Railt\Compiler\Parser\Rule\Token(37, 'T_SCHEMA_SUBSCRIPTION', true),
                            38 =>
new \Railt\Compiler\Parser\Rule\Concatenation(38, [37], '#Name'),
                            39 =>
new \Railt\Compiler\Parser\Rule\Concatenation(39, ['Word'], '#Name'),
                            'Name' =>
new \Railt\Compiler\Parser\Rule\Alternation('Name', [34, 36, 38, 39], null),
                            41 =>
new \Railt\Compiler\Parser\Rule\Alternation(41, ['String', 'Word', 'Keyword'], null),
                            'Key' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Key', [41], '#Name'),
                            43 =>
new \Railt\Compiler\Parser\Rule\Alternation(43, ['String', 'Number', 'Nullable', 'Keyword', 'Object', 'List', 'Word'], null),
                            'Value' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Value', [43], '#Value'),
                            'ValueDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ValueDefinition', ['ValueDefinitionResolver'], null),
                            46 =>
new \Railt\Compiler\Parser\Rule\Token(46, 'T_NON_NULL', true),
                            47 =>
new \Railt\Compiler\Parser\Rule\Repetition(47, 0, 1, [46], null),
                            48 =>
new \Railt\Compiler\Parser\Rule\Concatenation(48, ['ValueListDefinition', 47], '#List'),
                            49 =>
new \Railt\Compiler\Parser\Rule\Token(49, 'T_NON_NULL', true),
                            50 =>
new \Railt\Compiler\Parser\Rule\Repetition(50, 0, 1, [49], null),
                            51 =>
new \Railt\Compiler\Parser\Rule\Concatenation(51, ['ValueScalarDefinition', 50], '#Type'),
                            'ValueDefinitionResolver' =>
new \Railt\Compiler\Parser\Rule\Alternation('ValueDefinitionResolver', [48, 51], null),
                            53 =>
new \Railt\Compiler\Parser\Rule\Token(53, 'T_BRACKET_OPEN', false),
                            54 =>
new \Railt\Compiler\Parser\Rule\Token(54, 'T_NON_NULL', true),
                            55 =>
new \Railt\Compiler\Parser\Rule\Repetition(55, 0, 1, [54], null),
                            56 =>
new \Railt\Compiler\Parser\Rule\Concatenation(56, ['ValueScalarDefinition', 55], '#Type'),
                            57 =>
new \Railt\Compiler\Parser\Rule\Token(57, 'T_BRACKET_CLOSE', false),
                            'ValueListDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ValueListDefinition', [53, 56, 57], null),
                            'ValueScalarDefinition' =>
new \Railt\Compiler\Parser\Rule\Alternation('ValueScalarDefinition', ['Keyword', 'Word'], null),
                            60 =>
new \Railt\Compiler\Parser\Rule\Token(60, 'T_BRACE_OPEN', false),
                            61 =>
new \Railt\Compiler\Parser\Rule\Repetition(61, 0, -1, ['ObjectPair'], null),
                            62 =>
new \Railt\Compiler\Parser\Rule\Token(62, 'T_BRACE_CLOSE', false),
                            'Object' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Object', [60, 61, 62], '#Object'),
                            64 =>
new \Railt\Compiler\Parser\Rule\Token(64, 'T_COLON', false),
                            'ObjectPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectPair', ['Key', 64, 'Value'], '#ObjectPair'),
                            66 =>
new \Railt\Compiler\Parser\Rule\Token(66, 'T_BRACKET_OPEN', false),
                            67 =>
new \Railt\Compiler\Parser\Rule\Repetition(67, 0, -1, ['Value'], null),
                            68 =>
new \Railt\Compiler\Parser\Rule\Token(68, 'T_BRACKET_CLOSE', false),
                            'List' =>
new \Railt\Compiler\Parser\Rule\Concatenation('List', [66, 67, 68], '#List'),
                            70 =>
new \Railt\Compiler\Parser\Rule\Token(70, 'T_MULTILINE_STRING', true),
                            'Documentation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Documentation', [70], '#Description'),
                            72 =>
new \Railt\Compiler\Parser\Rule\Repetition(72, 0, 1, ['Documentation'], null),
                            73 =>
new \Railt\Compiler\Parser\Rule\Token(73, 'T_SCHEMA', true),
                            74 =>
new \Railt\Compiler\Parser\Rule\Repetition(74, 0, 1, ['Name'], null),
                            75 =>
new \Railt\Compiler\Parser\Rule\Repetition(75, 0, -1, ['Directive'], null),
                            76 =>
new \Railt\Compiler\Parser\Rule\Token(76, 'T_BRACE_OPEN', false),
                            77 =>
new \Railt\Compiler\Parser\Rule\Token(77, 'T_BRACE_CLOSE', false),
                            'SchemaDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinition', [72, 73, 74, 75, 76, 'SchemaDefinitionBody', 77], '#SchemaDefinition'),
                            79 =>
new \Railt\Compiler\Parser\Rule\Alternation(79, ['SchemaDefinitionQuery', 'SchemaDefinitionMutation', 'SchemaDefinitionSubscription'], null),
                            'SchemaDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Repetition('SchemaDefinitionBody', 0, -1, [79], null),
                            81 =>
new \Railt\Compiler\Parser\Rule\Repetition(81, 0, 1, ['Documentation'], null),
                            82 =>
new \Railt\Compiler\Parser\Rule\Token(82, 'T_SCHEMA_QUERY', false),
                            83 =>
new \Railt\Compiler\Parser\Rule\Token(83, 'T_COLON', false),
                            'SchemaDefinitionQuery' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionQuery', [81, 82, 83, 'SchemaDefinitionFieldValue'], '#Query'),
                            85 =>
new \Railt\Compiler\Parser\Rule\Repetition(85, 0, 1, ['Documentation'], null),
                            86 =>
new \Railt\Compiler\Parser\Rule\Token(86, 'T_SCHEMA_MUTATION', false),
                            87 =>
new \Railt\Compiler\Parser\Rule\Token(87, 'T_COLON', false),
                            'SchemaDefinitionMutation' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionMutation', [85, 86, 87, 'SchemaDefinitionFieldValue'], '#Mutation'),
                            89 =>
new \Railt\Compiler\Parser\Rule\Repetition(89, 0, 1, ['Documentation'], null),
                            90 =>
new \Railt\Compiler\Parser\Rule\Token(90, 'T_SCHEMA_SUBSCRIPTION', false),
                            91 =>
new \Railt\Compiler\Parser\Rule\Token(91, 'T_COLON', false),
                            'SchemaDefinitionSubscription' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionSubscription', [89, 90, 91, 'SchemaDefinitionFieldValue'], '#Subscription'),
                            93 =>
new \Railt\Compiler\Parser\Rule\Repetition(93, 0, -1, ['Directive'], null),
                            'SchemaDefinitionFieldValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('SchemaDefinitionFieldValue', ['ValueDefinition', 93], null),
                            95 =>
new \Railt\Compiler\Parser\Rule\Repetition(95, 0, 1, ['Documentation'], null),
                            96 =>
new \Railt\Compiler\Parser\Rule\Token(96, 'T_SCALAR', false),
                            97 =>
new \Railt\Compiler\Parser\Rule\Repetition(97, 0, -1, ['Directive'], null),
                            'ScalarDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ScalarDefinition', [95, 96, 'Name', 97], '#ScalarDefinition'),
                            99 =>
new \Railt\Compiler\Parser\Rule\Repetition(99, 0, 1, ['Documentation'], null),
                            100 =>
new \Railt\Compiler\Parser\Rule\Token(100, 'T_INPUT', false),
                            101 =>
new \Railt\Compiler\Parser\Rule\Repetition(101, 0, -1, ['Directive'], null),
                            102 =>
new \Railt\Compiler\Parser\Rule\Token(102, 'T_BRACE_OPEN', false),
                            103 =>
new \Railt\Compiler\Parser\Rule\Repetition(103, 0, -1, ['InputDefinitionField'], null),
                            104 =>
new \Railt\Compiler\Parser\Rule\Token(104, 'T_BRACE_CLOSE', false),
                            'InputDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinition', [99, 100, 'Name', 101, 102, 103, 104], '#InputDefinition'),
                            106 =>
new \Railt\Compiler\Parser\Rule\Repetition(106, 0, 1, ['Documentation'], null),
                            107 =>
new \Railt\Compiler\Parser\Rule\Token(107, 'T_COLON', false),
                            108 =>
new \Railt\Compiler\Parser\Rule\Repetition(108, 0, 1, ['InputDefinitionDefaultValue'], null),
                            109 =>
new \Railt\Compiler\Parser\Rule\Repetition(109, 0, -1, ['Directive'], null),
                            110 =>
new \Railt\Compiler\Parser\Rule\Concatenation(110, ['Key', 107, 'ValueDefinition', 108, 109], null),
                            'InputDefinitionField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinitionField', [106, 110], '#Argument'),
                            112 =>
new \Railt\Compiler\Parser\Rule\Token(112, 'T_EQUAL', false),
                            'InputDefinitionDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InputDefinitionDefaultValue', [112, 'Value'], null),
                            114 =>
new \Railt\Compiler\Parser\Rule\Repetition(114, 0, 1, ['Documentation'], null),
                            115 =>
new \Railt\Compiler\Parser\Rule\Token(115, 'T_EXTEND', false),
                            116 =>
new \Railt\Compiler\Parser\Rule\Concatenation(116, ['ObjectDefinition'], '#ExtendDefinition'),
                            117 =>
new \Railt\Compiler\Parser\Rule\Concatenation(117, ['InterfaceDefinition'], '#ExtendDefinition'),
                            118 =>
new \Railt\Compiler\Parser\Rule\Concatenation(118, ['EnumDefinition'], '#ExtendDefinition'),
                            119 =>
new \Railt\Compiler\Parser\Rule\Concatenation(119, ['UnionDefinition'], '#ExtendDefinition'),
                            120 =>
new \Railt\Compiler\Parser\Rule\Concatenation(120, ['SchemaDefinition'], '#ExtendDefinition'),
                            121 =>
new \Railt\Compiler\Parser\Rule\Concatenation(121, ['ScalarDefinition'], '#ExtendDefinition'),
                            122 =>
new \Railt\Compiler\Parser\Rule\Concatenation(122, ['InputDefinition'], '#ExtendDefinition'),
                            123 =>
new \Railt\Compiler\Parser\Rule\Concatenation(123, ['DirectiveDefinition'], '#ExtendDefinition'),
                            124 =>
new \Railt\Compiler\Parser\Rule\Alternation(124, [116, 117, 118, 119, 120, 121, 122, 123], null),
                            'ExtendDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ExtendDefinition', [114, 115, 124], null),
                            126 =>
new \Railt\Compiler\Parser\Rule\Repetition(126, 0, 1, ['Documentation'], null),
                            127 =>
new \Railt\Compiler\Parser\Rule\Token(127, 'T_DIRECTIVE', false),
                            128 =>
new \Railt\Compiler\Parser\Rule\Token(128, 'T_DIRECTIVE_AT', false),
                            129 =>
new \Railt\Compiler\Parser\Rule\Repetition(129, 0, -1, ['DirectiveDefinitionArguments'], null),
                            130 =>
new \Railt\Compiler\Parser\Rule\Token(130, 'T_ON', false),
                            131 =>
new \Railt\Compiler\Parser\Rule\Repetition(131, 1, -1, ['DirectiveDefinitionTargets'], null),
                            'DirectiveDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinition', [126, 127, 128, 'Name', 129, 130, 131], '#DirectiveDefinition'),
                            133 =>
new \Railt\Compiler\Parser\Rule\Token(133, 'T_PARENTHESIS_OPEN', false),
                            134 =>
new \Railt\Compiler\Parser\Rule\Repetition(134, 0, -1, ['DirectiveDefinitionArgument'], null),
                            135 =>
new \Railt\Compiler\Parser\Rule\Token(135, 'T_PARENTHESIS_CLOSE', false),
                            'DirectiveDefinitionArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionArguments', [133, 134, 135], null),
                            137 =>
new \Railt\Compiler\Parser\Rule\Repetition(137, 0, 1, ['Documentation'], null),
                            138 =>
new \Railt\Compiler\Parser\Rule\Token(138, 'T_COLON', false),
                            139 =>
new \Railt\Compiler\Parser\Rule\Repetition(139, 0, 1, ['DirectiveDefinitionDefaultValue'], null),
                            140 =>
new \Railt\Compiler\Parser\Rule\Repetition(140, 0, -1, ['Directive'], null),
                            'DirectiveDefinitionArgument' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionArgument', [137, 'Key', 138, 'ValueDefinition', 139, 140], '#Argument'),
                            142 =>
new \Railt\Compiler\Parser\Rule\Token(142, 'T_OR', false),
                            143 =>
new \Railt\Compiler\Parser\Rule\Concatenation(143, [142, 'Key'], null),
                            144 =>
new \Railt\Compiler\Parser\Rule\Repetition(144, 0, -1, [143], null),
                            'DirectiveDefinitionTargets' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionTargets', ['Key', 144], '#Target'),
                            146 =>
new \Railt\Compiler\Parser\Rule\Token(146, 'T_EQUAL', false),
                            'DirectiveDefinitionDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveDefinitionDefaultValue', [146, 'Value'], null),
                            148 =>
new \Railt\Compiler\Parser\Rule\Repetition(148, 0, 1, ['Documentation'], null),
                            149 =>
new \Railt\Compiler\Parser\Rule\Token(149, 'T_TYPE', false),
                            150 =>
new \Railt\Compiler\Parser\Rule\Repetition(150, 0, 1, ['ObjectDefinitionImplements'], null),
                            151 =>
new \Railt\Compiler\Parser\Rule\Repetition(151, 0, -1, ['Directive'], null),
                            152 =>
new \Railt\Compiler\Parser\Rule\Token(152, 'T_BRACE_OPEN', false),
                            153 =>
new \Railt\Compiler\Parser\Rule\Repetition(153, 0, -1, ['ObjectDefinitionField'], null),
                            154 =>
new \Railt\Compiler\Parser\Rule\Token(154, 'T_BRACE_CLOSE', false),
                            'ObjectDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinition', [148, 149, 'Name', 150, 151, 152, 153, 154], '#ObjectDefinition'),
                            156 =>
new \Railt\Compiler\Parser\Rule\Token(156, 'T_TYPE_IMPLEMENTS', false),
                            157 =>
new \Railt\Compiler\Parser\Rule\Repetition(157, 0, -1, ['Key'], null),
                            158 =>
new \Railt\Compiler\Parser\Rule\Token(158, 'T_AND', false),
                            159 =>
new \Railt\Compiler\Parser\Rule\Concatenation(159, [158, 'Key'], null),
                            160 =>
new \Railt\Compiler\Parser\Rule\Repetition(160, 0, 1, [159], null),
                            'ObjectDefinitionImplements' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionImplements', [156, 157, 160], '#Implements'),
                            162 =>
new \Railt\Compiler\Parser\Rule\Repetition(162, 0, 1, ['Documentation'], null),
                            163 =>
new \Railt\Compiler\Parser\Rule\Repetition(163, 0, 1, ['Arguments'], null),
                            164 =>
new \Railt\Compiler\Parser\Rule\Token(164, 'T_COLON', false),
                            165 =>
new \Railt\Compiler\Parser\Rule\Concatenation(165, ['Key', 163, 164, 'ObjectDefinitionFieldValue'], null),
                            'ObjectDefinitionField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionField', [162, 165], '#Field'),
                            167 =>
new \Railt\Compiler\Parser\Rule\Repetition(167, 0, -1, ['Directive'], null),
                            'ObjectDefinitionFieldValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ObjectDefinitionFieldValue', ['ValueDefinition', 167], null),
                            169 =>
new \Railt\Compiler\Parser\Rule\Repetition(169, 0, 1, ['Documentation'], null),
                            170 =>
new \Railt\Compiler\Parser\Rule\Token(170, 'T_INTERFACE', false),
                            171 =>
new \Railt\Compiler\Parser\Rule\Repetition(171, 0, -1, ['Directive'], null),
                            172 =>
new \Railt\Compiler\Parser\Rule\Token(172, 'T_BRACE_OPEN', false),
                            173 =>
new \Railt\Compiler\Parser\Rule\Repetition(173, 0, -1, ['InterfaceDefinitionBody'], null),
                            174 =>
new \Railt\Compiler\Parser\Rule\Token(174, 'T_BRACE_CLOSE', false),
                            'InterfaceDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinition', [169, 170, 'Name', 171, 172, 173, 174], '#InterfaceDefinition'),
                            176 =>
new \Railt\Compiler\Parser\Rule\Token(176, 'T_COLON', false),
                            177 =>
new \Railt\Compiler\Parser\Rule\Repetition(177, 0, -1, ['Directive'], null),
                            178 =>
new \Railt\Compiler\Parser\Rule\Concatenation(178, ['InterfaceDefinitionFieldKey', 176, 'ValueDefinition', 177], null),
                            'InterfaceDefinitionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinitionBody', [178], '#Field'),
                            180 =>
new \Railt\Compiler\Parser\Rule\Repetition(180, 0, 1, ['Documentation'], null),
                            181 =>
new \Railt\Compiler\Parser\Rule\Repetition(181, 0, 1, ['Arguments'], null),
                            'InterfaceDefinitionFieldKey' =>
new \Railt\Compiler\Parser\Rule\Concatenation('InterfaceDefinitionFieldKey', [180, 'Key', 181], null),
                            183 =>
new \Railt\Compiler\Parser\Rule\Repetition(183, 0, 1, ['Documentation'], null),
                            184 =>
new \Railt\Compiler\Parser\Rule\Token(184, 'T_ENUM', false),
                            185 =>
new \Railt\Compiler\Parser\Rule\Repetition(185, 0, -1, ['Directive'], null),
                            186 =>
new \Railt\Compiler\Parser\Rule\Token(186, 'T_BRACE_OPEN', false),
                            187 =>
new \Railt\Compiler\Parser\Rule\Repetition(187, 0, -1, ['EnumField'], null),
                            188 =>
new \Railt\Compiler\Parser\Rule\Token(188, 'T_BRACE_CLOSE', false),
                            'EnumDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumDefinition', [183, 184, 'Name', 185, 186, 187, 188], '#EnumDefinition'),
                            190 =>
new \Railt\Compiler\Parser\Rule\Repetition(190, 0, 1, ['Documentation'], null),
                            191 =>
new \Railt\Compiler\Parser\Rule\Repetition(191, 0, -1, ['Directive'], null),
                            192 =>
new \Railt\Compiler\Parser\Rule\Concatenation(192, ['EnumValue', 191], null),
                            'EnumField' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumField', [190, 192], '#Value'),
                            194 =>
new \Railt\Compiler\Parser\Rule\Token(194, 'T_NAME', true),
                            195 =>
new \Railt\Compiler\Parser\Rule\Alternation(195, [194, 'Keyword'], null),
                            'EnumValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('EnumValue', [195], '#Name'),
                            197 =>
new \Railt\Compiler\Parser\Rule\Repetition(197, 0, 1, ['Documentation'], null),
                            198 =>
new \Railt\Compiler\Parser\Rule\Token(198, 'T_UNION', false),
                            199 =>
new \Railt\Compiler\Parser\Rule\Repetition(199, 0, -1, ['Directive'], null),
                            200 =>
new \Railt\Compiler\Parser\Rule\Token(200, 'T_EQUAL', false),
                            'UnionDefinition' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionDefinition', [197, 198, 'Name', 199, 200, 'UnionBody'], '#UnionDefinition'),
                            202 =>
new \Railt\Compiler\Parser\Rule\Token(202, 'T_OR', false),
                            203 =>
new \Railt\Compiler\Parser\Rule\Repetition(203, 0, 1, [202], null),
                            204 =>
new \Railt\Compiler\Parser\Rule\Repetition(204, 1, -1, ['UnionUnitesList'], null),
                            'UnionBody' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionBody', [203, 204], '#Relations'),
                            206 =>
new \Railt\Compiler\Parser\Rule\Token(206, 'T_OR', false),
                            207 =>
new \Railt\Compiler\Parser\Rule\Concatenation(207, [206, 'Name'], null),
                            208 =>
new \Railt\Compiler\Parser\Rule\Repetition(208, 0, -1, [207], null),
                            'UnionUnitesList' =>
new \Railt\Compiler\Parser\Rule\Concatenation('UnionUnitesList', ['Name', 208], null),
                            210 =>
new \Railt\Compiler\Parser\Rule\Token(210, 'T_PARENTHESIS_OPEN', false),
                            211 =>
new \Railt\Compiler\Parser\Rule\Repetition(211, 0, -1, ['ArgumentPair'], null),
                            212 =>
new \Railt\Compiler\Parser\Rule\Token(212, 'T_PARENTHESIS_CLOSE', false),
                            'Arguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Arguments', [210, 211, 212], null),
                            214 =>
new \Railt\Compiler\Parser\Rule\Repetition(214, 0, 1, ['Documentation'], null),
                            215 =>
new \Railt\Compiler\Parser\Rule\Token(215, 'T_COLON', false),
                            216 =>
new \Railt\Compiler\Parser\Rule\Repetition(216, 0, 1, ['ArgumentDefaultValue'], null),
                            217 =>
new \Railt\Compiler\Parser\Rule\Repetition(217, 0, -1, ['Directive'], null),
                            'ArgumentPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentPair', [214, 'Key', 215, 'ValueDefinition', 216, 217], '#Argument'),
                            'ArgumentValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentValue', ['ValueDefinition'], '#Type'),
                            220 =>
new \Railt\Compiler\Parser\Rule\Token(220, 'T_EQUAL', false),
                            'ArgumentDefaultValue' =>
new \Railt\Compiler\Parser\Rule\Concatenation('ArgumentDefaultValue', [220, 'Value'], null),
                            222 =>
new \Railt\Compiler\Parser\Rule\Token(222, 'T_DIRECTIVE_AT', false),
                            223 =>
new \Railt\Compiler\Parser\Rule\Repetition(223, 0, 1, ['DirectiveArguments'], null),
                            'Directive' =>
new \Railt\Compiler\Parser\Rule\Concatenation('Directive', [222, 'Name', 223], '#Directive'),
                            225 =>
new \Railt\Compiler\Parser\Rule\Token(225, 'T_PARENTHESIS_OPEN', false),
                            226 =>
new \Railt\Compiler\Parser\Rule\Repetition(226, 0, -1, ['DirectiveArgumentPair'], null),
                            227 =>
new \Railt\Compiler\Parser\Rule\Token(227, 'T_PARENTHESIS_CLOSE', false),
                            'DirectiveArguments' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveArguments', [225, 226, 227], null),
                            229 =>
new \Railt\Compiler\Parser\Rule\Token(229, 'T_COLON', false),
                            'DirectiveArgumentPair' =>
new \Railt\Compiler\Parser\Rule\Concatenation('DirectiveArgumentPair', ['Key', 229, 'Value'], '#Argument'),
                    ]);
    }

    /**
     * @return string Returns the lexer compilation date and time in RFC3339 format
     */
    public function getBuiltDate(): string
    {
        return '2018-04-18UTC23:13:26.398+00:00';
    }
}