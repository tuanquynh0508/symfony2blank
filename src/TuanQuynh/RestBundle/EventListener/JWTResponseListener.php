<?php
namespace TuanQuynh\RestBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * JWTResponseListener
 *
 */
class JWTResponseListener
{
  /**
   * @var ContainerInterface
   */
  protected $container;

  /**
   * __construct
   *
   * @param ContainerInterface $container
   */
  public function __construct($container)
  {
    $this->container = $container;
  }

  /**
   * Add public data to the authentication response
   *
   * @param AuthenticationSuccessEvent $event
   */
  public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
  {
    $data = $event->getData();
    $user = $event->getUser();

    if (!$user instanceof UserInterface) {
      return;
    }

    $data['user'] = array(
      'lastname' => $user->getLastname() ,
      'firstname' => $user->getFirstname() ,
      'email' => $user->getUsername() ,
      'roles' => $user->getSysRoles() ,
      'actions' => $user->getSysActions()
    );

    $event->setData($data);
  }
}
