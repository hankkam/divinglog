<?php

namespace AppBundle\Controller;

use AppBundle\Service\MapLocationService;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Map location controller.
 */
class MapLocationController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /** @var \Symfony\Component\Form\FormFactoryInterface */
    private $formFactory;

    /** @var \Symfony\Component\HttpFoundation\Session\Session */
    private $session;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    private $router;

    /** @var \AppBundle\Service\MapLocationService */
    private $mapLocationService;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     * @param \AppBundle\Service\MapLocationService
     */
    public function __construct(
        EngineInterface $templating,
        FormFactoryInterface $formFactory,
        Session $session,
        Router $router,
        MapLocationService $mapLocationService
    ) {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->router = $router;
        $this->mapLocationService = $mapLocationService;
    }

    public function getGeoLocation(Request $request)
    {
        $response = new JsonResponse(array('data' => ''));

        $query = $request->query;
        $country = $query->get('country');
        $location = $query->get('location');
        $divesite = $query->get('divesite');

        $geoLocation = $this->mapLocationService->getGeoLocation($country, $location, $divesite);

        return $response->setData(array('data' => $geoLocation));
    }
}
