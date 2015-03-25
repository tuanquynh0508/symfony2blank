<?php
namespace TuanQuynh\RestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TuanQuynh\RestBundle\Entity\SysUser;

/*
  Fixture data for admin roles
*/
class SysUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

  /**
   * @var ContainerInterface
   */
  private $container;

  /**
   * {@inheritDoc}
   */
  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $users = array(
      array(
        'lastname' => 'Nhu Tuan',
        'firstname' => 'Nguyen',
        'email' => 'tuanquynh0508@gmail.com',
        'description' => 'Administration',
        'password' => '123456',
        'roles' => array(
          1
        )
      ),
      array(
        'lastname' => 'Moderator',
        'firstname' => 'Account',
        'email' => 'moderator@i-designer.net',
        'description' => 'Moderator account',
        'password' => '123456',
        'roles' => array(
          2
        )
      ),
      array(
        'lastname' => 'Editor',
        'firstname' => 'Account',
        'email' => 'editor@i-designer.net',
        'description' => 'Editor account',
        'password' => '123456',
        'roles' => array(
          3
        )
      ),
      array(
        'lastname' => 'Action',
        'firstname' => 'No',
        'email' => 'noaction@i-designer.net',
        'description' => 'No Action',
        'password' => '123456',
        'roles' => array(
          4
        )
      ),
      array(
        'lastname' => 'Role',
        'firstname' => 'No',
        'email' => 'norole@i-designer.net',
        'description' => 'No Role',
        'password' => '123456',
        'roles' => array()
      )
    );
    $i = 1;
    foreach ($users as $user) {
      $oUser = new SysUser();
      $oUser->setLastname($user['lastname']);
      $oUser->setFirstname($user['firstname']);
      $oUser->setEmail($user['email']);
      $oUser->setDescription($user['description']);

      foreach ($user['roles'] as $role) {
        $oRole = $this->getReference('role_' . $role);
        $oUser->addSysRole($oRole);
      }

      $encoderService = $this->container->get('security.encoder_factory');
      $encoder = $encoderService->getEncoder($oUser);
      $oUser->setPassword($encoder->encodePassword($user['password'], $oUser->getSalt()));

      $manager->persist($oUser);

      $this->addReference('user_'.$i, $oUser);
      $i++;
    }

    $manager->flush();
  }

  /**
   * {@inheritDoc}
   */
  public function getOrder()
  {
    return 3;
  }
}
