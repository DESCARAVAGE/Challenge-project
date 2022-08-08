<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802150239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, level_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_D7098951C54C8C93 (type_id), INDEX IDX_D70989515FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_language (challenge_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_49E5965598A21AC6 (challenge_id), INDEX IDX_49E5965582F1BAF4 (language_id), PRIMARY KEY(challenge_id, language_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D70989515FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE challenge_language ADD CONSTRAINT FK_49E5965598A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE challenge_language ADD CONSTRAINT FK_49E5965582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge_language DROP FOREIGN KEY FK_49E5965598A21AC6');
        $this->addSql('ALTER TABLE challenge_language DROP FOREIGN KEY FK_49E5965582F1BAF4');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D70989515FB14BA7');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951C54C8C93');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE challenge_language');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
