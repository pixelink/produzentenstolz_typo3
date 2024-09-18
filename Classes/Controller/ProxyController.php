<?php

namespace Produzentenstolz\Produzentenstolz\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Http\ResponseFactory;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Http\StreamFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ProxyController extends ActionController
{
    protected $requestFactory;
    protected $responseFactory;
    protected $streamFactory;

    public function __construct(RequestFactory $requestFactory, ResponseFactory $responseFactory, StreamFactory $streamFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    public function proxyAction(ServerRequest $request): ResponseInterface
    {
        // Retrieve parameters from the request
        $manufacturerId = (int)$request->getQueryParams()['manufacturerId'];
        $restaurantId = (int)$request->getQueryParams()['restaurantId'];

        $externalUrl = 'https://produzentenstolz.app/cntr/mfctr/' . $manufacturerId . '/' . $restaurantId;

        $response = $this->requestFactory->request($externalUrl, 'GET', [
            'headers' => ['Accept' => 'application/json'],
            'allow_redirects' => true,
        ]);

        if ($response->getStatusCode() === 200) {
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withBody($this->streamFactory->createStream($response->getBody()->getContents()));
        } else {
            return $this->responseFactory->createResponse()
                ->withStatus(500)
                ->withBody($this->streamFactory->createStream('Failed to fetch data'));
        }
    }
}
