<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171206105434 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, energy INT NOT NULL, gold INT NOT NULL, level INT NOT NULL, number_of_meals INT NOT NULL, name VARCHAR(255) NOT NULL, life INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_skill (hero_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_C102EBB045B0BCD (hero_id), INDEX IDX_C102EBB05585C142 (skill_id), PRIMARY KEY(hero_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_weapon (hero_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_6CACCFFA45B0BCD (hero_id), INDEX IDX_6CACCFFA95B82273 (weapon_id), PRIMARY KEY(hero_id, weapon_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_consumable_item (hero_id INT NOT NULL, consumable_item_id INT NOT NULL, INDEX IDX_1B26567545B0BCD (hero_id), INDEX IDX_1B26567593A55194 (consumable_item_id), PRIMARY KEY(hero_id, consumable_item_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_special_item (hero_id INT NOT NULL, special_item_id INT NOT NULL, INDEX IDX_A3F2E94045B0BCD (hero_id), INDEX IDX_A3F2E940CA630ECB (special_item_id), PRIMARY KEY(hero_id, special_item_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, text_content LONGTEXT NOT NULL, INDEX IDX_F981B52EAA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_5E3DE477AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, weapon_skill VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_6933A7E6AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, chapter_id INT DEFAULT NULL, target_chapter_id INT DEFAULT NULL, skill_required_id INT DEFAULT NULL, item_required_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, locked TINYINT(1) NOT NULL, gold_required INT NOT NULL, INDEX IDX_C1AB5A92579F4768 (chapter_id), INDEX IDX_C1AB5A9265739FF9 (target_chapter_id), INDEX IDX_C1AB5A92632365F3 (skill_required_id), INDEX IDX_C1AB5A923D55A409 (item_required_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consumable_item (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, bonus_given INT NOT NULL, attribute_targeted VARCHAR(255) NOT NULL, removable TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_1B91CB78AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, saga VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EB5604382B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE special_item (id INT AUTO_INCREMENT NOT NULL, story_id INT DEFAULT NULL, slot VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_9D4C2435AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hero_skill ADD CONSTRAINT FK_C102EBB045B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_skill ADD CONSTRAINT FK_C102EBB05585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_weapon ADD CONSTRAINT FK_6CACCFFA45B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_weapon ADD CONSTRAINT FK_6CACCFFA95B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_consumable_item ADD CONSTRAINT FK_1B26567545B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_consumable_item ADD CONSTRAINT FK_1B26567593A55194 FOREIGN KEY (consumable_item_id) REFERENCES consumable_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_special_item ADD CONSTRAINT FK_A3F2E94045B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_special_item ADD CONSTRAINT FK_A3F2E940CA630ECB FOREIGN KEY (special_item_id) REFERENCES special_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EAA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E6AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A9265739FF9 FOREIGN KEY (target_chapter_id) REFERENCES chapter (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92632365F3 FOREIGN KEY (skill_required_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A923D55A409 FOREIGN KEY (item_required_id) REFERENCES special_item (id)');
        $this->addSql('ALTER TABLE consumable_item ADD CONSTRAINT FK_1B91CB78AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE special_item ADD CONSTRAINT FK_9D4C2435AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hero_skill DROP FOREIGN KEY FK_C102EBB045B0BCD');
        $this->addSql('ALTER TABLE hero_weapon DROP FOREIGN KEY FK_6CACCFFA45B0BCD');
        $this->addSql('ALTER TABLE hero_consumable_item DROP FOREIGN KEY FK_1B26567545B0BCD');
        $this->addSql('ALTER TABLE hero_special_item DROP FOREIGN KEY FK_A3F2E94045B0BCD');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92579F4768');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A9265739FF9');
        $this->addSql('ALTER TABLE hero_skill DROP FOREIGN KEY FK_C102EBB05585C142');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92632365F3');
        $this->addSql('ALTER TABLE hero_weapon DROP FOREIGN KEY FK_6CACCFFA95B82273');
        $this->addSql('ALTER TABLE hero_consumable_item DROP FOREIGN KEY FK_1B26567593A55194');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EAA5D4036');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477AA5D4036');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E6AA5D4036');
        $this->addSql('ALTER TABLE consumable_item DROP FOREIGN KEY FK_1B91CB78AA5D4036');
        $this->addSql('ALTER TABLE special_item DROP FOREIGN KEY FK_9D4C2435AA5D4036');
        $this->addSql('ALTER TABLE hero_special_item DROP FOREIGN KEY FK_A3F2E940CA630ECB');
        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A923D55A409');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE hero_skill');
        $this->addSql('DROP TABLE hero_weapon');
        $this->addSql('DROP TABLE hero_consumable_item');
        $this->addSql('DROP TABLE hero_special_item');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE weapon');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE consumable_item');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE special_item');
    }
}
