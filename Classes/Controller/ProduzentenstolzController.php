<?php

declare(strict_types=1);

namespace Produzentenstolz\Produzentenstolz\Controller;

use Psr\Http\Message\ResponseInterface;
use Produzentenstolz\Produzentenstolz\Domain\Repository\PsDataRepository;
use TYPO3\CMS\Core\Http\RequestFactory;

class ProduzentenstolzController  extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $psDataRepository = null;
    protected $requestFactory;
    protected $restaurant;

    public function __construct(RequestFactory $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * countRestaurantStat when object is called
     * @return void
     */
    public function initializeAction() {
        $this->restaurant = $this->settings['restaurantId'];
        $this->countRestaurantStat();
    }

    /**
     * @param PsDataRepository $psDataRepository
     * @return void
     */
    public function injectPsDataRepository(
        PsDataRepository $psDataRepository
    )
    {
        $this->psDataRepository = $psDataRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $data = $this->psDataRepository->getPsData($this->restaurant);
        $this->view->assignMultiple([
            'data' => $data,
            'restaurantId' => $this->restaurant
        ]);
        return $this->htmlResponse();
    }

    /**
     * action map
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function mapAction(): ResponseInterface
    {
        $data = $this->psDataRepository->getPsData($this->restaurant);
        $this->view->assignMultiple([
            'data' => $data,
            'restaurantId' => $this->restaurant
        ]);
        return $this->htmlResponse();
    }

    /**
     * @param int $restaurantId
     * @return void
     */
    public function countRestaurantStat(): void
    {
        $externalUrl = 'https://produzentenstolz.app/cntr/rstrt/' . $this->restaurant;

        $response = $this->requestFactory->request($externalUrl, 'GET', [
            'headers' => ['Accept' => 'application/json'],
            'allow_redirects' => true,
        ]);

    }

}
