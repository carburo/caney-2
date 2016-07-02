<?php
/**
 * Created by PhpStorm.
 * User: rmartinez
 * Date: 11/06/16
 * Time: 21:41
 */

namespace AppBundle\Security;


use AppBundle\Entity\Hostel;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class HostelVoter extends Voter {

    const VIEW = "view";
    const EDIT = "edit";
    const CREATE = "create";

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::CREATE))) {
            return false;
        }

        // only vote on Hostel objects inside this voter
        if (!$subject instanceof Hostel) {
            return false;
        }
        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // you know $subject is a Hostel object, thanks to supports
        /** @var Hostel $hostel */
        $hostel = $subject;

        $user = $token->getUser();

        if(!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        switch($attribute) {
            case self::VIEW:
                return $this->canView($hostel, $user);
            case self::EDIT:
                return $this->canEdit($hostel, $user);
            case self::CREATE:
                return $this->canCreate($hostel, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Hostel $hostel, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($hostel, $user)) {
            return true;
        }
        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return !$hostel->isPrivate();
    }

    private function canEdit(Hostel $hostel, User $user)
    {
        return $user === $hostel->getOwner();
    }

    private function canCreate(Hostel $hostel, User $user)
    {
        return true;
    }
}