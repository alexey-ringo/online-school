<?php
declare(strict_types=1);

namespace App\Users\Model;

use Doctrine\ORM\Mapping as ORM;

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
    private $login_to_dashboard = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $call_bid = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $reject_bid = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $accept_bid = false;

    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $postpone_bid = false;
    
    /** 
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $confirm_bid = false;

    public static function createFree(): self
    {
        $prev = new self();

        //$prev->confirm_bid = true;

        return $prev;
    }

    public function fromArray(array $prevs): void
    {
        foreach($prevs as $prop => $prev) {
            $this->changePrivileges($prop, $prev);
        }

        return;
    }

    public function getPrivilegesList(): array
    {
        $refl = new \ReflectionObject($this);

        $props = $refl->getProperties();

        $list = [];

        foreach($props as $prop) {
            $list[] = $prop->getName();
        }

        return $list;
    }

    public function changePrivileges(string $prop, bool $state): void
    {
        //Если свойство существует
        if(!property_exists($this, $prop)) {
            $this->$prop = $state;
        }        

        return;
    }    

    /**
     * canLoginToDashboard
     *
     * @return bool
     */
    private function canLoginToDashboard(): bool
    {
        return $this->login_to_dashboard;
    }

    /**
     * canCallBid
     *
     * @return bool
     */
    private function canCallBid(): bool
    {
        return $this->call_bid;
    }

    /**
     * canRejectBid
     *
     * @return bool
     */
    private function canRejectBid(): bool
    {
        return $this->reject_bid;
    }

    /**
     * canAcceptBid
     *
     * @return bool
     */
    private function canAcceptBid(): bool
    {
        return $this->accept_bid;
    }

    /**
     * canPostponeBid
     *
     * @return bool
     */
    private function canPostponeBid(): bool
    {
        return $this->postpone_bid;
    }

    /**
     * canConfirmBid
     *
     * @return bool
     */
    private function canConfirmBid(): bool
    {
        return $this->confirm_bid;
    }
}
