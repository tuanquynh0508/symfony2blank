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

    $expiration = new \DateTime('+1 day');
    $expiration->setTime(2, 0, 0);

    $payload = $event->getData();
    $payload['ip'] = $request->getClientIp();
    $payload['exp'] = $expiration->getTimestamp();

    $event->setData($payload);
  }
}
