<?php
namespace TuanQuynh\RestBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

/**
 * JWTCreatedListener
 *
 */
class JWTCreatedListener
{

  /**
   * On JWT Created
   *
   * @param JWTCreatedEvent $event
   * @return void
   */
  public function onJWTCreated(JWTCreatedEvent $event)
  {
    if (!($request = $event->getRequest())) {
      return;
    }

    $payload = $event->getData();
    $payload['ip'] = $request->getClientIp();

    $event->setData($payload);
  }
}
