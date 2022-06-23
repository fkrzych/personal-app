<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623213004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE slug slug VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE tags CHANGE slug slug VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(380) NOT NULL, CHANGE password password VARCHAR(180) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE slug slug VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE tags CHANGE slug slug VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
    }
}
