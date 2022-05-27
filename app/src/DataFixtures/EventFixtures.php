<?php
/**
 * Event fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
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
     * @psalm-return array{0: CategoryFixtures::class}
     */
    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}

