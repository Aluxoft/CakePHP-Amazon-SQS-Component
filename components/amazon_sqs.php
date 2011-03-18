<?php
/**
 * Amazon SQS 1.00 Component
 *
 * @author Mike Bates
 * @version 1.00
 * @category Components
 */

App::import( 'Vendor', 'Amazon_SQS_Interface', array( 'file' => 'amazon_sqs'.DS.'Amazon'.DS.'SQS'.DS.'Interface.php' ) );
App::import( 'Vendor', 'Amazon_SQS_Client', array( 'file' => 'amazon_sqs'.DS.'Amazon'.DS.'SQS'.DS.'Client.php' ) );
App::import( 'Vendor', 'Amazon_SQS_Model', array( 'file' => 'amazon_sqs'.DS.'Amazon'.DS.'SQS'.DS.'Model.php' ) );
App::import( 'Vendor', 'Amazon_SQS_Mock', array( 'file' => 'amazon_sqs'.DS.'Amazon'.DS.'SQS'.DS.'Mock.php' ) );
App::import( 'Vendor', 'Amazon_SQS_Exception', array( 'file' => 'amazon_sqs'.DS.'Amazon'.DS.'SQS'.DS.'Exception.php' ) );

class AmazonSqsComponent extends Object
{
	/**
	 * AWS access key.
	 *
	 * @access public
	 * @var boolean
	 */
	public $accessKey;

	/**
	 * AWS secret key.
	 *
	 * @access public
	 * @var boolean
	 */
	public $secretKey;


	/**
	 * instance of Amazon_SQS_Interface
	 *
	 * @access private
	 * @var Amazon_SQS_Interface
	 */
	private $__service;


	/**
	 * instance of Amazon_SQS_Interface
	 *
	 * @access private
	 * @var Amazon_SQS_Model_CreateQueueRequest
	 */
	private $__request;


	/**
	 * request ID returned from Amazon
	 *
	 * @var string
	 */
	public $requestId;


	/**
	 * sqs folder in Vendor
	 * @var string
	 */
	private $__sqsModelFolder;


	/**
	 * Initialize sqs.
	 *
	 * @access public
	 * @param object $Controller
	 * @return boolean
	 */
	function startup( &$controller )
	{
		if( empty( $this->accessKey ) or empty( $this->secretKey ) )
		{
			trigger_error('Amazon SQS::setup(): You must enter an Amazon access key and secret key.', E_USER_WARNING );
		}
		else
		{
			$this->__sqsModelFolder = $this->__sqsModelFolder;
			$this->requestId = null;
			$this->__service = new Amazon_SQS_Client( $this->accessKey, $this->secretKey );
		}
	}


	/**
	 * Set the Request ID
	 *
	 * @access private
	 * @param object $amazonResponse response from an Amazon SQS request
	 */
	function __setResponseId( $amazonResponse )
	{
		if( $amazonResponse->isSetResponseMetadata() )
		{
			$responseMetadata = $amazonResponse->getResponseMetadata();
			if( $responseMetadata->isSetRequestId() )
			{
				$this->requestId = $responseMetadata->getRequestId();
			}
		}
	}


	/**
	 * Create Queue Action
	 *
	 * The CreateQueue action creates a new queue, or returns the URL of an existing
	 * one.  When you request CreateQueue, you provide a name for the queue. To
	 * successfully create a new queue, you must provide a name that is unique within
	 * the scope of your own queues. If you provide the name of an existing queue, a
	 * new queue isn't created and an error isn't returned. Instead, the request
	 * succeeds and the queue URL for the existing queue is returned.
	 *
	 * Exception: if you provide a value for DefaultVisibilityTimeout that is different
	 * from the value for the existing queue, you receive an error.
	 *
	 * @param string $queueName name of the queue to create
	 * @return string $queueUrl Amazon SQS queue url
	 */
	function createQueue( $queueName = null )
	{
		if( empty( $queueName ) )
		{
			$this->_flash( 'Invlaid SQS queue name.', 'flash_error' );

			return false;
		}
		else
		{
			try
			{
				App::import( 'Vendor', 'Amazon_SQS_Model_CreateQueueRequest', array( 'file' => $this->__sqsModelFolder.'CreateQueueRequest.php' ) );
				$this->__request = new Amazon_SQS_Model_CreateQueueRequest();

				$this->__request->setQueueName( $queueName );
				$amazonResponse = $this->__service->createQueue( $this->__request );

				$queueUrl = null;
				if( $amazonResponse->isSetCreateQueueResult() )
				{
					$createQueueResult = $amazonResponse->getCreateQueueResult();
					if( $createQueueResult->isSetQueueUrl() )
					{
						$queueUrl = $createQueueResult->getQueueUrl();
					}
				}

				$this->__setResponseId( $amazonResponse );

				return $queueUrl;
			}
			catch( Amazon_SQS_Exception $ex )
			{
				trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );
				return false;
			}
		}
	}


	/**
	 * Add Permission Action
	 *
	 * Adds the specified permission(s) to a queue for the specified principal(s).
	 * This allows for sharing access to the queue.
	 *
	 * @return bool
	 */
	function TODOaddPermission()
	{
		try
		{
			App::import( 'Vendor', 'Amazon_SQS_Model_AddPermissionRequest', array( 'file' => $this->__sqsModelFolder.'AddPermissionRequest.php' ) );
			$this->__request = new Amazon_SQS_Model_AddPermissionRequest();

			$amazonResponse = $this->service->addPermission( $this->__request );

			$this->__setResponseId( $amazonResponse );

			return true;
		}
		catch( Amazon_SQS_Exception $ex )
		{
			trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

			return false;
		}
	}


	/**
	 * Change Message Visibility Action
	 *
	 * The ChangeMessageVisibility action extends the read lock timeout of the
	 * specified message from the specified queue to the specified value.
	 *
	 * @param mixed $request Amazon_SQS_Model_ChangeMessageVisibility or array of parameters
	 * @return bool
	 */
	function TODOchangeMessageVisibility( $request )
	{
		try
		{
			App::import( 'Vendor', 'Amazon_SQS_Model_ChangeMessageVisibilityRequest', array( 'file' => $this->__sqsModelFolder.'ChangeMessageVisibilityRequest.php' ) );
			$this->__request = new Amazon_SQS_Model_ChangeMessageVisibilityReques();

			$amazonResponse = $this->service->changeMessageVisibility( $this->__request );

			$this->__setResponseId( $amazonResponse );

			return true;
		}
		catch( Amazon_SQS_Exception $ex )
		{
			trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

			return false;
		}
	}


	/**
	 * Delete Message Action
	 *
	 * The DeleteMessage action unconditionally removes the specified message from
	 * the specified queue. Even if the message is locked by another reader due to
	 * the visibility timeout setting, it is still deleted from the queue.
	 *
	 * @param string $queueUrl queue url received from CreateQueue call
	 * @param object $receiptHandle Receipt handle received from ReceiveMessage call
	 * @return bool
	 */
	function deleteMessage( $queueUrl = null, $receiptHandle = null )
	{
		if( empty( $queueUrl ) or empty( $receiptHandle ) )
		{
			$this->_flash( 'Invlaid SQS queue url and receipt handle.', 'flash_error' );

			return false;
		}
		else
		{
			try
			{
				App::import( 'Vendor', 'Amazon_SQS_Model_DeleteMessageRequest', array( 'file' => $this->__sqsModelFolder.'DeleteMessageRequest.php' ) );
				$this->__request = new Amazon_SQS_Model_DeleteMessageRequest();

				$this->__request->setQueueUrl( $queueUrl );
				$this->__request->setReceiptHandle( $receiptHandle );

				$amazonResponse = $this->__service->deleteMessage( $this->__request );

				$this->__setResponseId( $amazonResponse );

				return true;
			}
			catch( Amazon_SQS_Exception $ex )
			{
				trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

				return false;
			}
		}
	}


	/**
	 * Delete Queue Action
	 *
	 * This action unconditionally deletes the queue specified by the queue URL.
	 * Use this operation WITH CARE!  The queue is deleted even if it is NOT empty.
	 *
	 * @param string $queueUrl queue url received from CreateQueue call
	 * @return bool
	 */
	function deleteQueue( $queueUrl = null )
	{
		if( empty( $queueUrl ) )
		{
			$this->_flash( 'Invlaid SQS queue url.', 'flash_error' );

			return false;
		}
		else
		{
			try
			{
				App::import( 'Vendor', 'Amazon_SQS_Model_DeleteQueueRequest', array( 'file' => $this->__sqsModelFolder.'DeleteQueueRequest.php' ) );
				$this->__request = new Amazon_SQS_Model_DeleteQueueRequest();


				$this->__request->setQueueUrl( $queueUrl );
				$amazonResponse = $this->__service->deleteQueue( $this->__request );

				$this->__setResponseId( $amazonResponse );

				return true;
			}
			catch( Amazon_SQS_Exception $ex )
			{
				trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

				return false;
			}
		}
	}


	/**
	 * Get Queue Attributes Action
	 *
	 * Gets one or all attributes of a queue. Queues currently have two attributes you
	 * can get: ApproximateNumberOfMessages and VisibilityTimeout.
	 *
	 * @return object $attributeList Amazon SQS queue attribute list
	 */
	function TODOgetQueueAttributes()
	{
		try
		{
			App::import( 'Vendor', 'Amazon_SQS_Model_GetQueueAttributesRequest', array( 'file' => $this->__sqsModelFolder.'GetQueueAttributesRequest.php' ) );
			$this->__request = new Amazon_SQS_Model_GetQueueAttributesRequest();

			$amazonResponse = $this->__service->getQueueAttributes( $this->__request );

			$attributeList = null;
			if( $amazonResponse->isSetGetQueueAttributesResult() )
			{
				$getQueueAttributesResult = $amazonResponse->getGetQueueAttributesResult();
				$attributeList = $getQueueAttributesResult->getAttribute();
			}

			$this->__setResponseId( $amazonResponse );

			return $attributeList;
		}
		catch( Amazon_SQS_Exception $ex )
		{
			trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

			return false;
		}
	}


	/**
	 * List Queues Action
	 *
	 * The ListQueues action returns a list of your queues.
	 *
	 * @return array $queueUrlList array of Amazon SQS queue urls
	 */
	function listQueues()
	{
		try
		{
			App::import( 'Vendor', 'Amazon_SQS_Model_ListQueuesRequest', array( 'file' => $this->__sqsModelFolder.'ListQueuesRequest.php' ) );
			$this->__request = new Amazon_SQS_Model_ListQueuesRequest();

			$amazonResponse = $this->__service->listQueues( $this->__request );

			$queueUrlList = null;
			if( $amazonResponse->isSetListQueuesResult() )
			{
				$listQueuesResult = $amazonResponse->getListQueuesResult();
				$queueUrlList = $listQueuesResult->getQueueUrl();
			}

			$this->__setResponseId( $amazonResponse );

			return $queueUrlList;
		}
		catch( Amazon_SQS_Exception $ex )
		{
			trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

			return false;
		}
	}


	/**
	 * Receive Message Action
	 *
	 * Retrieves one or more messages from the specified queue.
	 *
	 * Each message is an object with the following isSet / get methods (e.g. MessageId = $message->isSetMessageId() )
	 * MessageId
	 * ReceiptHandle ( which is the identifier you must provide when deleting the message )
	 * MD5OfBody
	 * Body
	 *
	 * Each mesage also has an array of attributes returned with getAttribute(). Their isSet / get methods
	 * Name
	 * Value
	 *
	 * Messages returned by this action stay in the queue until you delete them.
	 * However, once a message is returned to a ReceiveMessage request, it is not returned on subsequent
	 * ReceiveMessage requests for the duration of the VisibilityTimeout.
	 * If you do not specify a VisibilityTimeout in the request, the overall visibility
	 * timeout for the queue is used for the returned messages.
	 *
	 *
	 * @param string $queueUrl queue url received from CreateQueue call
	 * @return array $messageList array of message objects
	 */
	function receiveMessage( $queueUrl = null )
	{
		if( empty( $queueUrl ) )
		{
			$this->_flash( 'Invlaid SQS url.', 'flash_error' );

			return false;
		}
		else
		{
			try
			{
				App::import( 'Vendor', 'Amazon_SQS_Model_ReceiveMessageRequest', array( 'file' => $this->__sqsModelFolder.'ReceiveMessageRequest.php' ) );
				$this->__request = new Amazon_SQS_Model_ReceiveMessageRequest();

				$this->__request->setQueueUrl( $queueUrl );
				
				$amazonResponse = $this->__service->receiveMessage( $this->__request );

				$messageList = null;
				if( $amazonResponse->isSetReceiveMessageResult() )
				{
					$receiveMessageResult = $amazonResponse->getReceiveMessageResult();
					$messageList = $receiveMessageResult->getMessage();
				}

				$this->__setResponseId( $amazonResponse );

				return $messageList;

			}
			catch( Amazon_SQS_Exception $ex )
			{
				trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

				return false;
			}
		}
	}


	/**
	 * Remove Permission Action
	 *
	 * Removes the permission with the specified statement id from the queue.
	 *
	 * @return bool
	 */
	function TOTOremovePermission()
	{
		try
		{
			App::import( 'Vendor', 'Amazon_SQS_Model_RemovePermissionRequest', array( 'file' => $this->__sqsModelFolder.'RemovePermissionRequest.php' ) );
			$this->__request = new Amazon_SQS_Model_RemovePermissionRequest();

			$amazonResponse = $this->service->removePermission( $this->__request );

			$this->__setResponseId( $amazonResponse );

			return true;

		}
		catch( Amazon_SQS_Exception $ex )
		{
			trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

			return false;
		}
	}


	/**
	 * Send Message Action
	 *
	 * The SendMessage action delivers a message to the specified queue.
	 *
	 * sendMessageResult is an object with the following isSet / get methods (e.g. MessageId = $message->isSetMessageId() )
	 * MessageId
	 * MD5OfMessageBody
	 *
	 * @param string $queueUrl queue url received from CreateQueue call
	 * @param string $message message text
	 * @return object $sendMessageResult Amazon SQS sendMessage result
	 */
	function sendMessage( $queueUrl = null, $message = null )
	{
		if( empty( $queueUrl ) or empty( $message ) )
		{
			$this->_flash( 'Invlaid SQS url and message.', 'flash_error' );

			return false;
		}
		else
		{
			try
			{
				App::import( 'Vendor', 'Amazon_SQS_Model_SendMessageRequest', array( 'file' => $this->__sqsModelFolder.'SendMessageRequest.php' ) );
				$this->__request = new Amazon_SQS_Model_SendMessageRequest();

				$this->__request->setQueueUrl( $queueUrl );
				$this->__request->setMessageBody( $message );
				$amazonResponse = $this->__service->sendMessage( $this->__request );

				$sendMessageResult = null;
				if( $amazonResponse->isSetSendMessageResult() )
				{
					$sendMessageResult = $amazonResponse->getSendMessageResult();
				}

				$this->__setResponseId( $amazonResponse );

				return $sendMessageResult;
			}
			catch( Amazon_SQS_Exception $ex )
			{
				trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

				return false;
			}
		}
	}


	/**
	 * Set Queue Attributes Action
	 *
	 * Sets an attribute of a queue. Currently, you can set only the VisibilityTimeout attribute for a queue.
	 *
	 * @return bool
	 */
	function TODOsetQueueAttributes()
	{
		try
		{
			App::import( 'Vendor', 'Amazon_SQS_Model_SetQueueAttributesRequest', array( 'file' => $this->__sqsModelFolder.'SetQueueAttributesRequest.php' ) );
			$this->__request = new Amazon_SQS_Model_SetQueueAttributesRequest();

			$amazonResponse = $this->__service->setQueueAttributes( $this->__request );

			$this->__setResponseId( $amazonResponse );

			return true;
		}
		catch( Amazon_SQS_Exception $ex )
		{
			trigger_error('Amazon SQS::' . $ex->getMessage(), E_USER_WARNING );

			return false;
		}
	}
}
?>