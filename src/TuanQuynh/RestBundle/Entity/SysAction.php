<?php
namespace TuanQuynh\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use TuanQuynh\RestBundle\Entity\SysRole;

/**
 * SysAction
 *
 * @ORM\Table(name="SysAction")
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class SysAction
{

  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   * @Expose
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=50, nullable=false)
   * @Expose
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=50, nullable=false)
   * @Expose
   */
  private $code;

  /**
   * @var \Doctrine\Common\Collections\Collection
   *
   * @ORM\ManyToMany(targetEntity="TuanQuynh\RestBundle\Entity\SysRole", mappedBy="sysAction")
   */
  private $sysRole;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->sysRole = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   * @return SysAction
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set code
   *
   * @param string $code
   * @return SysAction
   */
  public function setCode($code)
  {
    $this->code = $code;

    return $this;
  }

  /**
   * Get code
   *
   * @return string
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * Add sysRole
   *
   * @param \TuanQuynh\RestBundle\Entity\SysRole $sysRole
   * @return SysAction
   */
  public function addSysRole(SysRole $sysRole)
  {
    $this->sysRole[] = $sysRole;

    return $this;
  }

  /**
   * Remove sysRole
   *
   * @param \TuanQuynh\RestBundle\Entity\SysRole $sysRole
   */
  public function removeSysRole(SysRole $sysRole)
  {
    $this->sysRole->removeElement($sysRole);
  }

  /**
   * Get sysRole
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getSysRole()
  {
    return $this->sysRole;
  }
}
