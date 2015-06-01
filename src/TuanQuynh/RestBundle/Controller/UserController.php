<?php
namespace TuanQuynh\RestBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

//For FOSRestController
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View AS FOSView;
use FOS\RestBundle\Request\ParamFetcherInterface;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;

//For API DOC
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends FOSRestController
{

  /**
   * Get test.
   *
   * @Get("/sys/users")
   *
   * @ApiDoc(
   *   resource = true,
   *   description = "Greet Api",
   *   section="Test API",
   *   requirements={
   *     {
   *       "name"="name",
   *       "dataType"="string",
   *       "description"="Your name"
   *     }
   *   },
   *   statusCodes = {
   *     200 = "Returned when successful",
   *     404 = "Returned when the is not found"
   *   }
   * )
   *
   */
  public function getUsers()
  {
    return array(
      'greet' => 'Hello '.$name.'!'
    );
  }
}
