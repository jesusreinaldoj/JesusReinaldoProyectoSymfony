<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250209013905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usuario_play_list (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, playlist_id INT NOT NULL, reproducida INT NOT NULL, INDEX IDX_C6F6ECDBDB38439E (usuario_id), INDEX IDX_C6F6ECDB6BBD148 (playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario_play_list ADD CONSTRAINT FK_C6F6ECDBDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_play_list ADD CONSTRAINT FK_C6F6ECDB6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE cancion ADD archivo VARCHAR(255) DEFAULT NULL, ADD archivo_cancion VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario_play_list DROP FOREIGN KEY FK_C6F6ECDBDB38439E');
        $this->addSql('ALTER TABLE usuario_play_list DROP FOREIGN KEY FK_C6F6ECDB6BBD148');
        $this->addSql('DROP TABLE usuario_play_list');
        $this->addSql('ALTER TABLE cancion DROP archivo, DROP archivo_cancion');
    }
}
