<?php
namespace TuanQuynh\RestBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;

/**
 * JWTDecodedListener
 *
 */
class JWTDecodedListener
{

  /**
   * On JWT Decoded
   *
   * @param JWTDecodedEvent $event
   * @return void
   */
  public function onJWTDecoded(JWTDecodedEvent $event)
  {
    if (!($request = $event->getRequest())) {
      return;
    }

    $payload = $event->getPayload();
    $request = $event->getRequest();

    if (!isset($payload['ip']) || $payload['ip'] !== $request->getClientIp()) {
      $event->markAsInvalid();
    }
  }
}
