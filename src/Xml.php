<?php
/** @noinspection PhpComposerExtensionStubsInspection */

namespace fize\xml;

/**
 * Class Xml
 * @package fize\xml
 */
class Xml
{

    /**
     * 当前的XML解析器
     * @var resource
     */
    private $parser = null;


    /**
     * 用 UTF-8 方式编码的 ISO-8859-1 字符串转换成单字节的 ISO-8859-1 字符串。
     * @param string $data 待转化字符串
     * @return string
     */
    public static function utf8Decode($data)
    {
        return utf8_decode($data);
    }

    /**
     * 将 ISO-8859-1 编码的字符串转换为 UTF-8 编码
     * @param string $data 待转化字符串
     * @return string
     */
    public static function utf8Encode($data)
    {
        return utf8_encode($data);
    }

    /**
     * 根据给定的 code 获得 XML 解析器错误字符串。
     * @param int $code 由 xml_get_error_code() 返回的错误代码。
     * @return string
     */
    public static function errorString($code)
    {
        return xml_error_string($code);
    }

    /**
     * 获取 XML 解析器的当前字节索引
     * @return int
     */
    public function getCurrentByteIndex()
    {
        return xml_get_current_byte_index($this->parser);
    }

    /**
     * 获取 XML 解析器的当前列号
     * @return int
     */
    public function getCurrentColumnNumber()
    {
        return xml_get_current_column_number($this->parser);
    }

    /**
     * 获取 XML 解析器的当前行号
     * @return int
     */
    public function getCurrentLineNumber()
    {
        return xml_get_current_line_number($this->parser);
    }

    /**
     * 获取 XML 解析器错误代码
     * @return int
     */
    public function getErrorCode()
    {
        return xml_get_error_code($this->parser);
    }

    /**
     * 将 XML 数据解析到数组中
     * @param string $data 待解析数据
     * @param array $values 指向 values 数组
     * @param array $index 含有指向 values 数组中对应值的指针
     * @return int 失败返回 0，成功返回 1
     */
    public function parseIntoStruct($data, array &$values, array &$index = null)
    {
        return xml_parse_into_struct($this->parser, $data, $values, $index);
    }

    /**
     * 开始解析一个 XML 文档
     * @param string $data 需要解析的数据集
     * @param bool $is_final 如果被设置为 TRUE，则 data 为当前解析中最后一段数据。
     * @return int 成功时返回1，失败时返回0
     */
    public function parse($data, $is_final = false)
    {
        return xml_parse($this->parser, $data, $is_final);
    }

    /**
     * 生成一个支持命名空间的 XML 解析器
     * @param string $encoding 指定解析后输出数据的编码
     * @param string $separator 命名空间和标签名的分隔符
     * @return resource
     */
    public static function parserCreateNs($encoding = null, $separator = ":")
    {
        return xml_parser_create_ns($encoding, $separator);
    }

    /**
     * 建立一个 XML 解析器
     * @param string $encoding 指定解析后输出数据的编码
     * @return resource
     */
    public static function parserCreate($encoding = null)
    {
        return xml_parser_create($encoding);
    }

    /**
     * 释放当前的 XML 解析器
     * @return bool 成功返回true，失败返回false
     */
    public function parserFree()
    {
        return xml_parser_free($this->parser);
    }

    /**
     * 从 XML 解析器获取选项设置信息
     * @param int $option 要获取的设置选项名称。可以使用 XML_OPTION_CASE_FOLDING 和 XML_OPTION_TARGET_ENCODING 常量
     * @return mixed 如果失败返回false，同时产生E_WARNING警告
     */
    public function parserGetOption($option)
    {
        return xml_parser_get_option($this->parser, $option);
    }

    /**
     * 为指定 XML 解析进行选项设置
     * @param int $option 要设置的选项名称。可以使用 XML_OPTION_CASE_FOLDING、XML_OPTION_SKIP_TAGSTART、XML_OPTION_SKIP_WHITE、XML_OPTION_TARGET_ENCODING常量
     * @param mixed $value 要给选项设置的新值。
     * @return bool 成功返回true，失败返回false
     */
    public function parserSetOption($option, $value)
    {
        return xml_parser_set_option($this->parser, $option, $value);
    }

    /**
     * 建立字符数据处理器
     * @param callable $handler 处理函数的定义必须为handler( resource $parser , string $data )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setCharacterDataHandler(callable $handler)
    {
        return xml_set_character_data_handler($this->parser, $handler);
    }

    /**
     * 建立默认处理器
     * @param callable $handler 处理函数的定义必须为handler( resource $parser , string $data )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setDefaultHandler(callable $handler)
    {
        return xml_set_default_handler($this->parser, $handler);
    }

    /**
     * 建立起始和终止元素处理器
     * @param callable $start_element_handler 起始元素处理器，定义必须为start_element_handler ( resource $parser , string $name , array $attribs )
     * @param callable $end_element_handler 终止元素处理器，定义必须为end_element_handler ( resource $parser , string $name )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setElementHandler(callable $start_element_handler, callable $end_element_handler)
    {
        return xml_set_element_handler($this->parser, $start_element_handler, $end_element_handler);
    }

    /**
     * 建立终止命名空间声明处理器
     * @param callable $handler 处理器函数必须为handler ( resource $parser , string $prefix )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setEndNamespaceDeclHandler(callable $handler)
    {
        return xml_set_end_namespace_decl_handler($this->parser, $handler);
    }

    /**
     * 建立外部实体指向处理器
     * @param callable $handler 处理器函数必须为handler ( resource $parser , string $open_entity_names , string $base , string $system_id , string $public_id )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setExternalEntityRefHandler(callable $handler)
    {
        return xml_set_external_entity_ref_handler($this->parser, $handler);
    }

    /**
     * 建立注释声明处理器
     * @param callable $handler 处理器函数必须为handler ( resource $parser , string $notation_name , string $base , string $system_id , string $public_id )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setNotationDeclHandler(callable $handler)
    {
        return xml_set_notation_decl_handler($this->parser, $handler);
    }

    /**
     * 在对象中使用 XML 解析器
     * @param object $object 使得 parser 指定的解析器可以被用在 object 对象中
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setObject(&$object)
    {
        return xml_set_object($this->parser, $object);
    }

    /**
     * 建立处理指令（PI）处理器
     * @param callable $handler 处理器函数必须为handler( resource $parser , string $target , string $data )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setProcessingInstructionHandler(callable $handler)
    {
        return xml_set_processing_instruction_handler($this->parser, $handler);
    }

    /**
     * 建立起始命名空间声明处理器
     * @param callable $handler 处理器函数必须为handler( resource $parser , string $prefix , string $uri )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setStartNamespaceDeclHandler(callable $handler)
    {
        return xml_set_start_namespace_decl_handler($this->parser, $handler);
    }

    /**
     * 建立未解析实体定义声明处理器
     * @param callable $handler 处理器函数必须为handler( resource $parser , string $entity_name , string $base , string $system_id , string $public_id , string $notation_name )
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function setUnparsedEntityDeclHandler(callable $handler)
    {
        return xml_set_unparsed_entity_decl_handler($this->parser, $handler);
    }
}