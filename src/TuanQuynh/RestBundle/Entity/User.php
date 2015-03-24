<?php
namespace TuanQuynh\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Symfony\Component\Validator\Constraints as Assert;

use TuanQuynh\RestBundle\Entity\Role;

/**
 * AdminUser
 *
 * @ORM\Table(name="AdminUser", uniqueConstraints={@ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *
 * @ExclusionPolicy("all")
 */
class AdminUser implements AdvancedUserInterface
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
   * @ORM\ManyToMany(targetEntity="Nordnet\AdminBundle\Entity\AdminRole", inversedBy="adminUser")
   * @ORM\JoinTable(name="AdminUserRole",
   *   joinColumns={
   *     @ORM\JoinColumn(name="admin_user_id", referencedColumnName="id")
   *   },
   *   inverseJoinColumns={
   *     @ORM\JoinColumn(name="admin_role_id", referencedColumnName="id")
   *   }
   * )
   * @Expose
   */
  private $adminRole;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->salt = md5(uniqid(null, true));
    $this->isDeleted = 0;
    $this->adminRole = new \Doctrine\Common\Collections\ArrayCollection();
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * @return AdminUser
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
   * Add adminRole
   *
   * @param \Nordnet\AdminBundle\Entity\AdminRole $adminRole
   * @return AdminUser
   */
  public function addAdminRole(AdminRole $adminRole)
  {
    $this->adminRole[] = $adminRole;

    return $this;
  }

  /**
   * Remove adminRole
   *
   * @param \Nordnet\AdminBundle\Entity\AdminRole $adminRole
   */
  public function removeAdminRole(AdminRole $adminRole)
  {
    $this->adminRole->removeElement($adminRole);
  }

  /**
   * Clear all adminRole
   * @return AdminUser
   */
  public function clearAdminRole()
  {
    $this->adminRole->clear();

    return $this;
  }

  /**
   * Get adminRole
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getAdminRole()
  {
    return $this->adminRole;
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
    $actions = $this->getAdminActions();
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

  public function getAdminRoles()
  {
    $roles = array();
    foreach ($this->adminRole as $adminRole) {
      $roles[] = $adminRole->getName();
    }
    return $roles;
  }

  public function getAdminActions()
  {
    $actions = array();
    foreach ($this->adminRole as $adminRole) {
      foreach ($adminRole->getAdminAction() as $action) {
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
