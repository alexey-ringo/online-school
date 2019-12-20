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
     * @var int 
     * @ORM\Column(type="integer", length=11)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $middleName;

    /**
     * @var int
     * @ORM\Column(type="integer", length=100)
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
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $employ;  
    
    /**
     * @var Privileges
     * @ORM\ManyToOne(targetEntity="App\Users\Model\Privileges")
     * @ORM\JoinColumn(name="privileges_id", referencedColumnName="id")
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

        return $user;
    }

    public function changePrivileges(Privileges $privileges): void
    {
        $this->privileges = $privileges;

        return;
    }

    public function changeEmploy(string $employ): void
    {
        $this->employ = $employ;

        return;
    }

    public function changeAge(int $age): void
    {
        $this->age = $age;

        return;
    }

    public function changeFirstName(string $firstName): void
    {
        $this->firstName = $firstName;

        return;
    }

    public function changeLastName(string $lastName): void
    {
        $this->lastName = $lastName;

        return;
    }

    public function changeMiddleName(string $middleName): void
    {
        $this->middleName = $middleName;

        return;
    }

    public function changePhone(string $phone): void
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
     * @return  int
     */ 
    public function getId(): int
    {
        return $this->id;
    }
}
