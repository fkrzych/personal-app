<?php
/**
 * Contact fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class ContactFixtures.
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
            $contact->setNote($this->faker->sentence);
            /* @var Tag $tag */
            for ($i = 0; $i < 5; ++$i) {
                $tag = $this->getRandomReference('tags');
                $contact->addTag($tag);
            }

            /** @var User $author */
            $author = $this->getRandomReference('users');
            $contact->setAuthor($author);

            return $contact;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: TagFixtures::class, 1: UserFixtures::class}
     */
    public function getDependencies(): array
    {
        return [TagFixtures::class, UserFixtures::class];
    }
}
