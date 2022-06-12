<?php
/**
 * Category fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Tag;

/**
 * Class CategoryFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class TagFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(20, 'tags', function (int $i) {
            $tag = new Tag();
            $tag->setName($this->faker->unique()->word);
            $tag->setCreatedAt($this->faker->dateTime);
            $tag->setUpdatedAt($this->faker->dateTime);

            return $tag;
        });

        $this->manager->flush();
    }
}
