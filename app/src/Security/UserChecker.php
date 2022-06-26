<?php
/**
 * User checker.
 */

namespace App\Security;

    use App\Entity\User;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
    use Symfony\Component\Security\Core\User\UserCheckerInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Contracts\Translation\TranslatorInterface;

    /**
     * Class UserChecker.
     */
    class UserChecker implements UserCheckerInterface
    {
        private TranslatorInterface $translator;

        public function __construct(TranslatorInterface $translator)
        {
            $this->translator = $translator;
        }

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
                throw new CustomUserMessageAccountStatusException($this->translator->trans('message.account_blocked'));
            }
        }

        /**
         * Check roles after authorization.
         *
         * @return void Query builder
         */
        public function checkPostAuth(UserInterface $user): void
        {
        }
    }
