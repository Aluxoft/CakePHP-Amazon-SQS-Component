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
 * Amazon_SQS_Model_CreateQueueResponse
 * 
 * Properties:
 * <ul>
 * 
 * <li>CreateQueueResult: Amazon_SQS_Model_CreateQueueResult</li>
 * <li>ResponseMetadata: Amazon_SQS_Model_ResponseMetadata</li>
 *
 * </ul>
 */ 
class Amazon_SQS_Model_CreateQueueResponse extends Amazon_SQS_Model
{


    /**
     * Construct new Amazon_SQS_Model_CreateQueueResponse
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>CreateQueueResult: Amazon_SQS_Model_CreateQueueResult</li>
     * <li>ResponseMetadata: Amazon_SQS_Model_ResponseMetadata</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'CreateQueueResult' => array('FieldValue' => null, 'FieldType' => 'Amazon_SQS_Model_CreateQueueResult'),
        'ResponseMetadata' => array('FieldValue' => null, 'FieldType' => 'Amazon_SQS_Model_ResponseMetadata'),
        );
        parent::__construct($data);
    }

       
    /**
     * Construct Amazon_SQS_Model_CreateQueueResponse from XML string
     * 
     * @param string $xml XML string to construct from
     * @return Amazon_SQS_Model_CreateQueueResponse 
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
    	$xpath->registerNamespace('a', 'http://queue.amazonaws.com/doc/2009-02-01/');
        $response = $xpath->query('//a:CreateQueueResponse');
        if ($response->length == 1) {
            return new Amazon_SQS_Model_CreateQueueResponse(($response->item(0))); 
        } else {
            throw new Exception ("Unable to construct Amazon_SQS_Model_CreateQueueResponse from provided XML. 
                                  Make sure that CreateQueueResponse is a root element");
        }
          
    }
    
    /**
     * Gets the value of the CreateQueueResult.
     * 
     * @return CreateQueueResult CreateQueueResult
     */
    public function getCreateQueueResult() 
    {
        return $this->_fields['CreateQueueResult']['FieldValue'];
    }

    /**
     * Sets the value of the CreateQueueResult.
     * 
     * @param CreateQueueResult CreateQueueResult
     * @return void
     */
    public function setCreateQueueResult($value) 
    {
        $this->_fields['CreateQueueResult']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the CreateQueueResult  and returns this instance
     * 
     * @param CreateQueueResult $value CreateQueueResult
     * @return Amazon_SQS_Model_CreateQueueResponse instance
     */
    public function withCreateQueueResult($value)
    {
        $this->setCreateQueueResult($value);
        return $this;
    }


    /**
     * Checks if CreateQueueResult  is set
     * 
     * @return bool true if CreateQueueResult property is set
     */
    public function isSetCreateQueueResult()
    {
        return !is_null($this->_fields['CreateQueueResult']['FieldValue']);

    }

    /**
     * Gets the value of the ResponseMetadata.
     * 
     * @return ResponseMetadata ResponseMetadata
     */
    public function getResponseMetadata() 
    {
        return $this->_fields['ResponseMetadata']['FieldValue'];
    }

    /**
     * Sets the value of the ResponseMetadata.
     * 
     * @param ResponseMetadata ResponseMetadata
     * @return void
     */
    public function setResponseMetadata($value) 
    {
        $this->_fields['ResponseMetadata']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the ResponseMetadata  and returns this instance
     * 
     * @param ResponseMetadata $value ResponseMetadata
     * @return Amazon_SQS_Model_CreateQueueResponse instance
     */
    public function withResponseMetadata($value)
    {
        $this->setResponseMetadata($value);
        return $this;
    }


    /**
     * Checks if ResponseMetadata  is set
     * 
     * @return bool true if ResponseMetadata property is set
     */
    public function isSetResponseMetadata()
    {
        return !is_null($this->_fields['ResponseMetadata']['FieldValue']);

    }



    /**
     * XML Representation for this object
     * 
     * @return string XML for this object
     */
    public function toXML() 
    {
        $xml = "";
        $xml .= "<CreateQueueResponse xmlns=\"http://queue.amazonaws.com/doc/2009-02-01/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</CreateQueueResponse>";
        return $xml;
    }

}