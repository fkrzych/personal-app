<?php
/**
 * Event fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Contact;

/**
 * Class EventFixtures.
 */
class ContactFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        if (null === $this->manager || null === $this->faker) {
            return;
        }

        $this->createMany(100, 'contacts', function (int $i) {
            $contact = new Contact();
            $contact->setName($this->faker->firstName);
            $contact->setPhone($this->faker->phoneNumber);

            return $contact;
        });

        $this->manager->flush();
    }
}
