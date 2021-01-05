<?php
declare(strict_types=1);

namespace App\Users\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Users\Model
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @var int|null 
     * @ORM\Column(type="integer", length=11, nullable=true)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @var int|null
     * @ORM\Column(type="integer", length=100, nullable=true)
     */
    private $age;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $employ;  
    
    /**
     * @var Privileges
     * @ORM\ManyToOne(targetEntity="App\Users\Model\Privileges", cascade={"persist"})
     * @ORM\JoinColumn(name="privileges_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $privileges;

    private function __construct() {}
    
    public static function signup(string $email, string $password): self
    {
        $user = new self();
        $user->email = $email;
        $user->changePassword($password);

        $prev = Privileges::createFree();
        $user->changePrivileges($prev);

        return $user;
    }

    //Создание пользователя через Админку 
    public static function createFromAdmin(string $email, string $password, array $privileges): self
    {
        $user = new self();
        $user->email = $email;
        $user->changePassword($password);

        $prevs = new Privileges();
        $prevs->fromArray($privileges);
        $user->changePrivileges($prevs);

        return $user;
    }

    public function changePrivileges(Privileges $privileges): void
    {
        $this->privileges = $privileges;

        return;
    }

    public function changeEmploy(?string $employ): void
    {
        $this->employ = $employ;

        return;
    }

    public function changeAge(?int $age): void
    {
        $this->age = $age;

        return;
    }

    public function changeFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;

        return;
    }

    public function changeLastName(?string $lastName): void
    {
        $this->lastName = $lastName;

        return;
    }

    public function changeMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;

        return;
    }

    public function changePhone(?string $phone): void
    {
        $this->phone = $phone;

        return;
    }

    public function changePassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return;
    }

    /**
     * Get the value of id
     *
     * @return  int|null
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of privileges
     *
     * @return  Privileges
     */ 
    public function getPrivileges(): Privileges
    {
        return $this->privileges;
    }

    /**
     * Get the value of lastName
     *
     * @return  string|null
     */ 
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Get the value of firstName
     *
     * @return  string|null
     */ 
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Get the value of middleName
     *
     * @return  string|null
     */ 
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * Get the value of age
     *
     * @return  int|null
     */ 
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the value of phone
     *
     * @return  string|null
     */ 
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Get the value of employ
     *
     * @return  string|null
     */ 
    public function getEmploy(): ?string
    {
        return $this->employ;
    }
}
