<?php
namespace TuanQuynh\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Symfony\Component\Validator\Constraints as Assert;

use TuanQuynh\RestBundle\Entity\SysRole;

/**
 * SysUser
 *
 * @ORM\Table(name="SysUser", uniqueConstraints={@ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *
 * @ExclusionPolicy("all")
 */
class SysUser implements AdvancedUserInterface
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
   * @ORM\Column(name="lastname", type="string", length=20, nullable=false)
   * @Expose
   *
   * @Assert\NotBlank()
   * @Assert\Length(max="20")
   */
  private $lastname;

  /**
   * @var string
   *
   * @ORM\Column(name="firstname", type="string", length=20, nullable=false)
   * @Expose
   *
   * @Assert\NotBlank()
   * @Assert\Length(max="20")
   */
  private $firstname;

  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=100, nullable=false, unique=true)
   * @Expose
   *
   * @Assert\NotBlank()
   * @Assert\Length(max="255")
   * @Assert\Email()
   */
  private $email;

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
   * @var string
   *
   * @ORM\Column(name="password", type="string", length=100, nullable=false)
   *
   * @Assert\Length(min="4", max="20")
   */
  private $password;

  /**
   * @var string
   *
   * @ORM\Column(name="salt", type="string", length=100, nullable=false)
   */
  private $salt;

  /**
   * @var boolean
   *
   * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
   */
  private $isDeleted;

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
   * @var \DateTime
   *
   * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
   */
  private $deletedAt;

  /**
   * @var \Doctrine\Common\Collections\Collection
   *
   * @ORM\ManyToMany(targetEntity="TuanQuynh\RestBundle\Entity\SysRole", inversedBy="SysUser")
   * @ORM\JoinTable(name="SysUserRole",
   *   joinColumns={
   *     @ORM\JoinColumn(name="sys_user_id", referencedColumnName="id")
   *   },
   *   inverseJoinColumns={
   *     @ORM\JoinColumn(name="sys_role_id", referencedColumnName="id")
   *   }
   * )
   * @Expose
   */
  private $sysRole;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->salt = md5(uniqid(null, true));
    $this->isDeleted = 0;
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
   * Set lastname
   *
   * @param string $lastname
   * @return SysUser
   */
  public function setLastname($lastname)
  {
    $this->lastname = $lastname;

    return $this;
  }

  /**
   * Get lastname
   *
   * @return string
   */
  public function getLastname()
  {
    return $this->lastname;
  }

  /**
   * Set firstname
   *
   * @param string $firstname
   * @return SysUser
   */
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get firstname
   *
   * @return string
   */
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
   * Set email
   *
   * @param string $email
   * @return SysUser
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get email
   *
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set description
   *
   * @param string $description
   * @return SysUser
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
   * Set password
   *
   * @param string $password
   * @return SysUser
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get password
   *
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set salt
   *
   * @param string $salt
   * @return SysUser
   */
  public function setSalt($salt)
  {
    $this->salt = $salt;

    return $this;
  }

  /**
   * Get salt
   *
   * @return string
   */
  public function getSalt()
  {
    return $this->salt;
  }

  /**
   * Set isDeleted
   *
   * @param boolean $deleted
   * @return SysUser
   */
  public function setIsDeleted($isDeleted)
  {
    $this->isDeleted = $isDeleted;

    return $this;
  }

  /**
   * Get isDeleted
   *
   * @return boolean
   */
  public function getIsDeleted()
  {
    return $this->isDeleted;
  }

  /**
   * Set createdAt
   *
   * @ORM\PrePersist
   *
   * @return SysUser
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
   * @return SysUser
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
   * Set deletedAt
   *
   * @param \DateTime $deletedAt
   * @return SysUser
   */
  public function setDeletedAt($deletedAt)
  {
    $this->deletedAt = $deletedAt;

    return $this;
  }

  /**
   * Get deletedAt
   *
   * @return \DateTime
   */
  public function getDeletedAt()
  {
    return $this->deletedAt;
  }

  /**
   * Add SysRole
   *
   * @param \TuanQuynh\RestBundle\Entity\SysRole $sysRole
   * @return SysUser
   */
  public function addSysRole(SysRole $sysRole)
  {
    $this->sysRole[] = $sysRole;

    return $this;
  }

  /**
   * Remove SysRole
   *
   * @param \TuanQuynh\RestBundle\Entity\SysRole $sysRole
   */
  public function removeSysRole(SysRole $sysRole)
  {
    $this->sysRole->removeElement($sysRole);
  }

  /**
   * Clear all SysRole
   * @return SysUser
   */
  public function clearSysRole()
  {
    $this->sysRole->clear();

    return $this;
  }

  /**
   * Get SysRole
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getSysRole()
  {
    return $this->sysRole;
  }

  /**
   * @inheritDoc
   */
  public function getUsername()
  {
    return $this->email;
  }

  /**
   * @inheritDoc
   */
  public function getRoles()
  {
    $actions = $this->getSysActions();
    $roles = array(
      'ROLE_USER'
    );
    foreach ($actions as $action) {
      $name = 'ROLE_' . strtoupper($action);
      if (!in_array($name, $roles)) {
        $roles[] = $name;
      }
    }
    return $roles;
  }

  /**
   * @inheritDoc
   */
  public function eraseCredentials()
  {
  }

  public function getSysRoles()
  {
    $roles = array();
    foreach ($this->sysRole as $sysRole) {
      $roles[] = $sysRole->getName();
    }
    return $roles;
  }

  public function getSysActions()
  {
    $actions = array();
    foreach ($this->sysRole as $sysRole) {
      foreach ($sysRole->getSysAction() as $action) {
        $actions[] = $action->getCode();
      }
    }
    return $actions;
  }

  public function isAccountNonExpired()
  {
    return true;
  }

  public function isAccountNonLocked()
  {
    return true;
  }

  public function isCredentialsNonExpired()
  {
    return true;
  }

  public function isEnabled()
  {
    return !$this->isDeleted;
  }
}
