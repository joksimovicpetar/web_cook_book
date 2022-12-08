<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207163816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_categories (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, category_id INT DEFAULT NULL, INDEX IDX_738DC00B59D8A214 (recipe_id), INDEX IDX_738DC00B12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_categories ADD CONSTRAINT recipe_fk FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipe_categories ADD CONSTRAINT category_fk FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE recipe DROP category_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe_categories DROP FOREIGN KEY FK_738DC00B59D8A214');
        $this->addSql('ALTER TABLE recipe_categories DROP FOREIGN KEY FK_738DC00B12469DE2');
        $this->addSql('DROP TABLE recipe_categories');
        $this->addSql('ALTER TABLE recipe ADD category_id INT DEFAULT NULL, CHANGE description description TEXT NOT NULL');
        $this->addSql('CREATE INDEX IDX_DA88B13712469DE2 ON recipe (category_id)');
    }
}
