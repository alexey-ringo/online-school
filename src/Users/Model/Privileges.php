<?php
declare(strict_types=1);

namespace App\Users\Model;

use Doctrine\ORM\Mapping as ORM;
use ReflectionClass;

/**
 * Class Privileges
 * @package App\Users\Model
 * @ORM\Entity() 
 */
class Privileges
{
    const ENABLE = true;
    const DISABLE = false;

    /**
     * @var int 
     * @ORM\Column(type="integer", length=11)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $loginToDashboard = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $callBid = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $rejectBid = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $acceptBid = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $postponeBid = false;
    
    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $confirmBid = false;

    public static function createFree(): self
    {
        $prev = new self();

        //$prev->confirmBid = true;

        return $prev;
    }

    public function fromArray(array $prevs): void
    {
        foreach($prevs as $prop => $prev) {
            $this->changePrivileges($prop, $prev);
        }

        return;
    }

    public function toArray(): array
    {
        $list = [];

        $refl = new \ReflectionObject($this);

        $props = $refl->getProperties();

        foreach ($props as $prop){
            if($prop->getName() == 'id') continue;
            $prop->setAccessible(true);
            $list[$prop->getName()] = $prop->getValue($this);
        }

        return $list;
    }

    /**
     * @return array
     */
    public static function privilegesList(): array
    {
        try{
            $list = [];

            $refl = new ReflectionClass(self::class);

            $props = $refl->getProperties();

            foreach ($props as $prop){
                if($prop->getName() == 'id') continue;
                $list[] = $prop->getName();
            }

        }catch (\ReflectionException $e){

        }finally{
            return $list;
        }
    }

    public function changePrivileges(string $prop, bool $state): void
    {
        //Если свойство существует
        if(property_exists($this, $prop)) {
            $this->$prop = $state;
        }        

        return;
    }    

    public function can(string $prop): bool
    {
        if(!property_exists($this, $prop)) {
            throw new \InvalidArgumentException("Привилегия ошибочна");
        }

        return $this->{$prop};
    }

    /**
     * @return bool
     */
    public function isLoginToDashboard(): bool
    {
        return $this->loginToDashboard;
    }

    /**
     * @return bool
     */
    public function isCallBid(): bool
    {
        return $this->callBid;
    }

    /**
     * @return bool
     */
    public function isRejectBid(): bool
    {
        return $this->rejectBid;
    }

    /**
     * @return bool
     */
    public function isAcceptBid(): bool
    {
        return $this->acceptBid;
    }

    /**
     * @return bool
     */
    public function isPostponeBid(): bool
    {
        return $this->postponeBid;
    }

    /**
     * @return bool
     */
    public function isConfirmBid(): bool
    {
        return $this->confirmBid;
    }
}
