<?php
/**
 * User checker.
 */

namespace App\Security;

use App\Entity\User;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
    use Symfony\Component\Security\Core\User\UserCheckerInterface;
    use Symfony\Component\Security\Core\User\UserInterface;

    /**
     * Class UserChecker.
     */
    class UserChecker implements UserCheckerInterface
    {
        /**
         * Check roles before authorization.
         *
         * @return void Query builder
         */
        public function checkPreAuth(UserInterface $user): void
        {
            if (!$user instanceof User) {
                return;
            }

            if (in_array('ROLE_BLOCKED', $user->getRoles())) {
                throw new CustomUserMessageAccountStatusException('message.account_blocked');
            }
        }

        public function checkPostAuth(UserInterface $user): void
        {
//            if (!$user instanceof User) {
//                return;
//            }
//
//            // user account is expired, the user may be notified
//            if ($user->isExpired()) {
//                throw new AccountExpiredException('...');
//            }
        }
    }
