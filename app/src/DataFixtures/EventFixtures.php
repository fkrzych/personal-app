<?php
/**
 * Event fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class EventFixtures.
 */
class EventFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
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

        $this->createMany(100, 'events', function (int $i) {
            $event = new Event();
            $event->setName($this->faker->sentence);
            $event->setDate($this->faker->dateTime);
            /** @var Category $category */
            $category = $this->getRandomReference('categories');
            $event->setCategory($category);
            /** @var Tag $tag */
            for($i=0; $i<5; $i++) {
                $tag = $this->getRandomReference('tags');
                $event->addTag($tag);
            }

            /** @var User $author */
            $author = $this->getRandomReference('users');
            $event->setAuthor($author);

            return $event;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: CategoryFixtures::class, 1: TagFixtures::class, 2: UserFixtures::class}
     */
    public function getDependencies(): array
    {
        return [CategoryFixtures::class, TagFixtures::class, UserFixtures::class];
    }
}

