<?php
namespace TuanQuynh\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Symfony\Component\Validator\Constraints as Assert;

use TuanQuynh\RestBundle\Entity\SysAction;
use TuanQuynh\RestBundle\Entity\SysUser;

/**
 * SysRole
 *
 * @ORM\Table(name="SysRole", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *
 * @ExclusionPolicy("all")
 */
class SysRole
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
   * @ORM\Column(name="name", type="string", length=20, nullable=false)
   * @Expose
   *
   * @Assert\NotBlank()
   * @Assert\Length(max="20")
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="description", type="string", length=50, nullable=true)
   * @Expose
   *
   * @Assert\Length(max="50")
   */
  private $description;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   * @Expose
   */
  private $createdAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   * @Expose
   */
  private $updatedAt;

  /**
   * @var \Doctrine\Common\Collections\Collection
   *
   * @ORM\ManyToMany(targetEntity="TuanQuynh\RestBundle\Entity\SysAction", inversedBy="sysRole")
   * @ORM\JoinTable(name="SysRoleAction",
   *   joinColumns={
   *     @ORM\JoinColumn(name="sys_role_id", referencedColumnName="id")
   *   },
   *   inverseJoinColumns={
   *     @ORM\JoinColumn(name="sys_action_id", referencedColumnName="id")
   *   }
   * )
   * @Expose
   */
  private $sysAction;

  /**
   * @var \Doctrine\Common\Collections\Collection
   *
   * @ORM\ManyToMany(targetEntity="TuanQuynh\RestBundle\Entity\SysUser", mappedBy="sysRole")
   */
  private $sysUser;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->sysAction = new \Doctrine\Common\Collections\ArrayCollection();
    $this->sysUser = new \Doctrine\Common\Collections\ArrayCollection();
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
   * @return SysRole
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
   * Set description
   *
   * @param string $description
   * @return SysRole
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get description
   *
   * @return string
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set createdAt
   *
   * @ORM\PrePersist
   *
   * @return SysRole
   */
  public function setCreatedAt()
  {
    $this->createdAt = new \DateTime();

    return $this;
  }

  /**
   * Get createdAt
   *
   * @return \DateTime
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set updatedAt
   *
   * @ORM\PreUpdate
   *
   * @return SysRole
   */
  public function setUpdatedAt()
  {
    $this->updatedAt = new \DateTime();

    return $this;
  }

  /**
   * Get updatedAt
   *
   * @return \DateTime
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * Add SysAction
   *
   * @param \TuanQuynh\RestBundle\Entity\SysAction $sysAction
   * @return SysRole
   */
  public function addSysAction(SysAction $sysAction)
  {
    $this->sysAction[] = $sysAction;

    return $this;
  }

  /**
   * Remove SysAction
   *
   * @param \TuanQuynh\RestBundle\Entity\SysAction $sysAction
   */
  public function removeSysAction(SysAction $sysAction)
  {
    $this->sysAction->removeElement($sysAction);
  }

  /**
   * Clear all SysAction
   * @return SysRole
   */
  public function clearSysAction()
  {
    $this->sysAction->clear();

    return $this;
  }

  /**
   * Get SysAction
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getSysAction()
  {
    return $this->sysAction;
  }

  /**
   * Add SysUser
   *
   * @param \TuanQuynh\RestBundle\Entity\SysUser $sysUser
   * @return SysRole
   */
  public function addSysUser(SysUser $sysUser)
  {
    $this->sysUser[] = $sysUser;

    return $this;
  }

  /**
   * Remove SysUser
   *
   * @param \TuanQuynh\RestBundle\Entity\SysUser $sysUser
   */
  public function removeSysUser(SysUser $sysUser)
  {
    $this->sysUser->removeElement($sysUser);
  }

  /**
   * Clear all SysUser
   * @return SysRole
   */
  public function clearSysUser()
  {
    $this->sysUser->clear();

    return $this;
  }

  /**
   * Get SysUser
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getSysUser()
  {
    return $this->sysUser;
  }
}
