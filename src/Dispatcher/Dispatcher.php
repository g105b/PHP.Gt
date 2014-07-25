<?php
/**
 * 
 * PHP.Gt (http://php.gt)
 * @copyright Copyright Ⓒ 2014 Bright Flair Ltd. (http://brightflair.com)
 * @license Apache Version 2.0, January 2004. http://www.apache.org/licenses
 */
namespace Gt\Dispatcher;
use \Gt\Request\Request;
use \Gt\Response\Response;
use \Gt\Api\ApiFactory;
use \Gt\Database\DatabaseFactory;

abstract class Dispatcher {

private $request;
private $response;
private $apiFactory;
private $dbFactory;

public function __construct(Request $request, Response $response, 
ApiFactory $apiFactory, DatabaseFactory $dbFactory) {
	$this->request = $request;
	$this->response = $response;
	$this->apiFactory = $apiFactory;
	$this->dbFactory = $dbFactory;
}

/**
 * Creates a suitable ResponseContent object for the type of dispatcher.
 * For a PageDispatcher, the ResponseContent will be a Gt\Response\Dom\Document
 * @return ResponseContent The object to serialise as part of the HTTP response
 */
abstract function createResponseContent();

/**
 * Performs the dispatch cycle.
 */
public function process() {
	// Create and assign the Response content. This object may represent a
	// DOMDocument or ApiObject, depending on request type.
	$content = $this->createResponseContent();

	// Construct and assign ResponseCode object, which is a collection of
	// Code class instantiations in order of execution.
	// $code = ResponseCodeFactory::create(
	// 	$this->request->uri, 
	// 	$this->request->getType(),
	// 	$this->apiFactory,
	// 	$this->dbFactory,
	// 	$content
	// );
	
	// $this->response->setCode($code);
	// $this->response->setContentObject($content);

	// Handle client-side copying and compilation after the response codes have
	// executed.
	// $this->manifest....
	$content->flush();
}

}#