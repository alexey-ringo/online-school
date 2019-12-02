<?php
declare(strict_types=1);

namespace App\Bids\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Bid
 * @package App\Bids\Model
 * @ORM\Entity(repositoryClass="App\Bids\Repository\BidRepository")
 */
class Bid
{
    const WAIT_CALL = 1;
    const CALLED = 2;
    const ACCEPTED = 3;
    const REJECTED = 4;
    const POSTPONED = 5;
    const CONFIRMED = 6;

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var int
     * @ORM\Column(type="integer", length=100)
     */
    private $age;

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
     * @var string|null
     * @ORM\Column(type="text")
     */
    private $information;

    /**
     * @var int|null
     * @ORM\Column(type="integer", length=100, nullable=true)
     */
    private $price;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $status;

    public function __construct(string $lastname, string $firstName,
                                string $email, int $age,
                                string $phone, string $employ)
    {
        $this->lastname = $lastname;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->age = $age;
        $this->phone = $phone;        
        $this->employ = $employ;

        $this->status = self::WAIT_CALL;
    }

    public function accept(): void
    {
        if($this->status === self::WAIT_CALL) {
            throw new \LogicException('Нельзя принять непрозвоненную заявку');
        }

        if($this->status === self::REJECTED) {
            throw new \LogicException('Нельзя принять отклоненную заявку');
        }

        if($this->status === self::CONFIRMED) {
            throw new \LogicException('Нельзя принять подтвержденную заявку');
        }

        $this->status = self::ACCEPTED;
    }

    public function reject(): void
    {
        if($this->status === self::ACCEPTED) {
            throw new \LogicException('Нельзя отклонить принятую заявку');
        }

        if($this->status === self::CONFIRMED) {
            throw new \LogicException('Нельзя отклонить подтвержденную заявку');
        }

        $this->status = self::REJECTED;
    }

    /**
     * called
     *
     * @return void
     */
    public function call(): void
    {
        if($this->status !== self::WAIT_CALL) {
            throw new \LogicException('Нельзя отправить в прозвонку');
        }        

        $this->status = self::CALLED;
    }

    /**
     * postponed
     *
     * @return void
     */
    public function postponed(): void
    {
        if($this->status === self::WAIT_CALL) {
            throw new \LogicException('Нельзя отклонить непрозвоненную заявку');
        }

        if($this->status === self::REJECTED) {
            throw new \LogicException('Нельзя отклоненную отклоненную заявку');
        }

        if($this->status === self::CONFIRMED) {
            throw new \LogicException('Нельзя отклонить подтвержденную заявку');
        }

        $this->status = self::POSTPONED;
    }

    /**
     * confirm
     *
     * @return void
     */
    public function confirm(): void
    {
        if($this->status !== self::ACCEPTED) {
            throw new \LogicException('Подтвердить возможно только принятые заявки!');
        }

        $this->status = self::CONFIRMED;
    }

    /**
     * @return mixed
     */
    /**
     * getInformation
     *
     * @return string
     */
    public function getInformation(): ?string
    {
        return $this->information;
    }

    /**
     * @return mixed $information
     */
    public function setInformation(?string $information): void
    {
        $this->information = $information;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname(): string
    {
        return $this->lastname;
    }    

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
     * Set the value of middleName
     *
     * @param  string|null  $middleName     *
     * 
     */ 
    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;        
    }

    /**
     * Get the value of firstName
     *
     * @return  string
     */ 
    public function getFirstName(): string
    {
        return $this->firstName;
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
     * Get the value of age
     *
     * @return  int
     */ 
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Get the value of phone
     *
     * @return  string
     */ 
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Get the value of employ
     *
     * @return  string
     */ 
    public function getEmploy(): string
    {
        return $this->employ;
    }

    /**
     * Get the value of price
     *
     * @return  int|null
     */ 
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  int  $price     
     * 
     */ 
    public function setPrice(int $price): void
    {
        $this->price = $price;
        
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus(): int
    {
        return $this->status;
    }
}