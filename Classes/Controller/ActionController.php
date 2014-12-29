<?php
namespace MONOGON\AddressCollection\Controller;

// http://nerdcenter.de/extbase-fehlerbehandlung/

abstract class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * @var string
	 */
	protected $entityNotFoundMessage = 'The requested entity could not be found.';

	/**
	 * @var string
	 */
	protected $unknownErrorMessage = 'An unknown error occurred. The wild monkey horde in our basement will try to fix this as soon as possible.';

	/**
	 * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface $request
	 * @param \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response
	 * @return void
	 * @throws \Exception
	 * @override \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
	 */
	public function processRequest(\TYPO3\CMS\Extbase\Mvc\RequestInterface $request, \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response) {
		try {
			parent::processRequest($request, $response);
		}
		// catch (\TYPO3\CMS\Extbase\Mvc\Controller\Exception\RequiredArgumentMissingException $exception){
		// 	return "***";
		// }
		catch(\Exception $exception) {
			// If the property mapper did throw a \TYPO3\CMS\Extbase\Property\Exception, because it was unable to find the requested entity, call the page-not-found handler.
			$previousException = $exception->getPrevious();
			//die(get_class($previousException));
			if (($exception instanceof \TYPO3\CMS\Extbase\Property\Exception) && (($previousException instanceof \TYPO3\CMS\Extbase\Property\Exception\TargetNotFoundException) || ($previousException instanceof \TYPO3\CMS\Extbase\Property\Exception\InvalidSourceException))) {
				$GLOBALS['TSFE']->pageNotFoundAndExit($this->entityNotFoundMessage);
			}
			throw $exception;
		}
	}

	/**
	 * @return void
	 * @override \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
	 */
	// protected function callActionMethod() {
	// 	try {
	// 		parent::callActionMethod();
	// 	}
	// 	catch(\Exception $exception) {
	// 		// This enables you to trigger the call of TYPO3s page-not-found handler by throwing \TYPO3\CMS\Core\Error\Http\PageNotFoundException
	// 		if ($exception instanceof \TYPO3\CMS\Core\Error\Http\PageNotFoundException) {
	// 			$GLOBALS['TSFE']->pageNotFoundAndExit($this->entityNotFoundMessage);
	// 		}

	// 		// $GLOBALS['TSFE']->pageNotFoundAndExit has not been called, so the exception is of unknown type.
	// 		\VendorName\ExtensionName\Logger\ExceptionLogger::log($exception, $this->request->getControllerExtensionKey(), \VendorName\ExtensionName\Logger\ExceptionLogger::SEVERITY_FATAL_ERROR);
	// 		// If the plugin is configured to do so, we call the page-unavailable handler.
	// 		if (isset($this->settings['usePageUnavailableHandler']) && $this->settings['usePageUnavailableHandler']) {
	// 			$GLOBALS['TSFE']->pageUnavailableAndExit($this->unknownErrorMessage, 'HTTP/1.1 500 Internal Server Error');
	// 		}
	// 		// Else we append the error message to the response. This causes the error message to be displayed inside the normal page layout. WARNING: the plugins output may gets cached.
	// 		if ($this->response instanceof \TYPO3\CMS\Extbase\Mvc\Web\Response) {
	// 			$this->response->setStatus(500);
	// 		}
	// 		$this->response->appendContent($this->unknownErrorMessage);
	// 	}
	// }
}