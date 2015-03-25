<?php
namespace TuanQuynh\RestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TuanQuynh\RestBundle\Entity\SysAction;

/*
  Fixture data for admin actions
*/
class SysActionData extends AbstractFixture implements OrderedFixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $actions = array(
      array(
        'name' => 'Administration',
        'code' => 'ADMINISTRATE'
      ),
      array(
        'name' => 'Moderator',
        'code' => 'MODERATOR'
      ),
      array(
        'name' => 'Editor',
        'code' => 'EDITOR'
      ),
    );

    $i = 1;
    foreach ($actions as $action) {
      $oAction = new SysAction();
      $oAction->setName($action['name']);
      $oAction->setCode($action['code']);
      $manager->persist($oAction);

      $this->addReference('ACTION_' . $action['code'], $oAction);
      $i++;
    }

    $manager->flush();
  }

  /**
   * {@inheritDoc}
   */
  public function getOrder()
  {
    return 1;
  }
}
