<?php
/**
 * Event fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class EventFixtures.
 */
class ContactFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
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
            /** @var Tag $tag */
            for($i=0; $i<5; $i++) {
                $tag = $this->getRandomReference('tags');
                $contact->addTag($tag);
            }

            return $contact;
        });

        $this->manager->flush();
    }

    public function getDependencies(): array
    {
        return [TagFixtures::class];
    }
}
