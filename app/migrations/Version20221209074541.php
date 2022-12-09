<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209074541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_cart (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL , INDEX IDX_7122C47EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cart_recipe (id INT AUTO_INCREMENT NOT NULL, user_cart_id INT DEFAULT NULL, recipe_id INT DEFAULT NULL, INDEX IDX_7D171AFD42D8D3B5 (user_cart_id), INDEX IDX_7D171AFD59D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_cart ADD CONSTRAINT user_user_cart_fk FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_cart_recipe ADD CONSTRAINT user_cart_fk FOREIGN KEY (user_cart_id) REFERENCES user_cart (id)');
        $this->addSql('ALTER TABLE user_cart_recipe ADD CONSTRAINT recipe_fk FOREIGN KEY (recipe_id) REFERENCES recipe (id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_cart DROP FOREIGN KEY FK_7122C47EA76ED395');
        $this->addSql('ALTER TABLE user_cart_recipe DROP FOREIGN KEY FK_7D171AFD42D8D3B5');
        $this->addSql('ALTER TABLE user_cart_recipe DROP FOREIGN KEY FK_7D171AFD59D8A214');
        $this->addSql('DROP TABLE user_cart');
        $this->addSql('DROP TABLE user_cart_recipe');
        $this->addSql('ALTER TABLE recipe CHANGE description description TEXT NOT NULL');
    }
}
