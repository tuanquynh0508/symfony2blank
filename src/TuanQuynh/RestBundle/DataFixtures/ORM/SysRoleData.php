<?php
namespace TuanQuynh\RestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TuanQuynh\RestBundle\Entity\SysRole;

/*
  Fixture data for admin roles
*/
class SysRoleData extends AbstractFixture implements OrderedFixtureInterface
{

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $roles = array(
      array(
        'name' => 'Administrator',
        'description' => 'Role with action Administrator',
        'actions' => array(
          'ADMINISTRATE',
        )
      ),
      array(
        'name' => 'Moderator',
        'description' => 'Role with action Moderator',
        'actions' => array(
          'MODERATOR',
        )
      ),
      array(
        'name' => 'Editor',
        'description' => 'Role with action Editor',
        'actions' => array(
          'EDITOR',
        )
      ),
      array(
        'name' => 'No Action',
        'description' => 'Role without any action',
        'actions' => array()
      ),
    );

    $i = 1;
    foreach ($roles as $role) {
      $oRole = new SysRole();
      $oRole->setName($role['name']);
      $oRole->setDescription($role['description']);
      foreach ($role['actions'] as $action) {
        $oAction = $this->getReference('ACTION_' . $action);
        $oRole->addSysAction($oAction);
      }

      $manager->persist($oRole);

      $this->addReference('role_' . $i, $oRole);
      $i++;
    }

    $manager->flush();
  }

  /**
   * {@inheritDoc}
   */
  public function getOrder()
  {
    return 2;
  }
}
