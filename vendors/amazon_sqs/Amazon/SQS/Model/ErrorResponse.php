<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     Amazon_SQS
 *  @copyright   Copyright 2008 Amazon Technologies, Inc.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2009-02-01
 */
/******************************************************************************* 
 *    __  _    _  ___ 
 *   (  )( \/\/ )/ __)
 *   /__\ \    / \__ \
 *  (_)(_) \/\/  (___/
 * 
 *  Amazon SQS PHP5 Library
 *  Generated: Wed Apr 08 20:15:38 PDT 2009
 * 
 */

/**
 *  @see Amazon_SQS_Model
 */
  

    

/**
 * Amazon_SQS_Model_ErrorResponse
 * 
 * Properties:
 * <ul>
 * 
 * <li>Error: Amazon_SQS_Model_Error</li>
 * <li>RequestId: string</li>
 *
 * </ul>
 */ 
class Amazon_SQS_Model_ErrorResponse extends Amazon_SQS_Model
{


    /**
     * Construct new Amazon_SQS_Model_ErrorResponse
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>Error: Amazon_SQS_Model_Error</li>
     * <li>RequestId: string</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'Error' => array('FieldValue' => array(), 'FieldType' => array('Amazon_SQS_Model_Error')),
        'RequestId' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
        parent::__construct($data);
    }

       
    /**
     * Construct Amazon_SQS_Model_ErrorResponse from XML string
     * 
     * @param string $xml XML string to construct from
     * @return Amazon_SQS_Model_ErrorResponse 
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
    	$xpath->registerNamespace('a', 'http://queue.amazonaws.com/doc/2009-02-01/');
        $response = $xpath->query('//a:RemovePermissionResponse');
        if ($response->length == 1) {
            return new Amazon_SQS_Model_ErrorResponse(($response->item(0))); 
        } else {
            throw new Exception ("Unable to construct Amazon_SQS_Model_ErrorResponse from provided XML. 
                                  Make sure that RemovePermissionResponse is a root element");
        }
          
    }
    
    /**
     * Gets the value of the Error.
     * 
     * @return array of Error Error
     */
    public function getError() 
    {
        return $this->_fields['Error']['FieldValue'];
    }

    /**
     * Sets the value of the Error.
     * 
     * @param mixed Error or an array of Error Error
     * @return this instance
     */
    public function setError($error) 
    {
        if (!$this->_isNumericArray($error)) {
            $error =  array ($error);    
        }
        $this->_fields['Error']['FieldValue'] = $error;
        return $this;
    }


    /**
     * Sets single or multiple values of Error list via variable number of arguments. 
     * For example, to set the list with two elements, simply pass two values as arguments to this function
     * <code>withError($error1, $error2)</code>
     * 
     * @param Error  $errorArgs one or more Error
     * @return Amazon_SQS_Model_ErrorResponse  instance
     */
    public function withError($errorArgs)
    {
        foreach (func_get_args() as $error) {
            $this->_fields['Error']['FieldValue'][] = $error;
        }
        return $this;
    }   



    /**
     * Checks if Error list is non-empty
     * 
     * @return bool true if Error list is non-empty
     */
    public function isSetError()
    {
        return count ($this->_fields['Error']['FieldValue']) > 0;
    }

    /**
     * Gets the value of the RequestId property.
     * 
     * @return string RequestId
     */
    public function getRequestId() 
    {
        return $this->_fields['RequestId']['FieldValue'];
    }

    /**
     * Sets the value of the RequestId property.
     * 
     * @param string RequestId
     * @return this instance
     */
    public function setRequestId($value) 
    {
        $this->_fields['RequestId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the RequestId and returns this instance
     * 
     * @param string $value RequestId
     * @return Amazon_SQS_Model_ErrorResponse instance
     */
    public function withRequestId($value)
    {
        $this->setRequestId($value);
        return $this;
    }


    /**
     * Checks if RequestId is set
     * 
     * @return bool true if RequestId  is set
     */
    public function isSetRequestId()
    {
        return !is_null($this->_fields['RequestId']['FieldValue']);
    }



    /**
     * XML Representation for this object
     * 
     * @return string XML for this object
     */
    public function toXML() 
    {
        $xml = "";
        $xml .= "<ErrorResponse xmlns=\"http://queue.amazonaws.com/doc/2009-02-01/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</ErrorResponse>";
        return $xml;
    }

}