<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127230925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cancion (id INT AUTO_INCREMENT NOT NULL, genero_id INT NOT NULL, nombre VARCHAR(20) NOT NULL, duracion INT NOT NULL, autor VARCHAR(20) NOT NULL, ubicacion VARCHAR(20) DEFAULT NULL, likes INT NOT NULL, album VARCHAR(20) DEFAULT NULL, reproducciones INT NOT NULL, UNIQUE INDEX UNIQ_E4620FA0BCE7B795 (genero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estilo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perfil (id INT AUTO_INCREMENT NOT NULL, foto VARCHAR(255) DEFAULT NULL, edad INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perfil_estilo (id INT AUTO_INCREMENT NOT NULL, perfil_id INT NOT NULL, estilo_id INT NOT NULL, INDEX IDX_8C8A3EBE57291544 (perfil_id), INDEX IDX_8C8A3EBE43798DA7 (estilo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_list (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, likes INT NOT NULL, visibilidad VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_list_cancion (id INT AUTO_INCREMENT NOT NULL, playlist_id INT DEFAULT NULL, cancion_id INT DEFAULT NULL, INDEX IDX_E1C645096BBD148 (playlist_id), INDEX IDX_E1C645099B1D840F (cancion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(20) NOT NULL, password VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_cancion (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, cancion_id INT NOT NULL, fecha DATE NOT NULL, marca_tiempo INT DEFAULT NULL, INDEX IDX_9D44A5E7DB38439E (usuario_id), INDEX IDX_9D44A5E79B1D840F (cancion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_play_list (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, playlist_id INT NOT NULL, reproducida INT NOT NULL, INDEX IDX_C6F6ECDBDB38439E (usuario_id), INDEX IDX_C6F6ECDB6BBD148 (playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cancion ADD CONSTRAINT FK_E4620FA0BCE7B795 FOREIGN KEY (genero_id) REFERENCES estilo (id)');
        $this->addSql('ALTER TABLE perfil_estilo ADD CONSTRAINT FK_8C8A3EBE57291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id)');
        $this->addSql('ALTER TABLE perfil_estilo ADD CONSTRAINT FK_8C8A3EBE43798DA7 FOREIGN KEY (estilo_id) REFERENCES estilo (id)');
        $this->addSql('ALTER TABLE play_list_cancion ADD CONSTRAINT FK_E1C645096BBD148 FOREIGN KEY (playlist_id) REFERENCES play_list (id)');
        $this->addSql('ALTER TABLE play_list_cancion ADD CONSTRAINT FK_E1C645099B1D840F FOREIGN KEY (cancion_id) REFERENCES cancion (id)');
        $this->addSql('ALTER TABLE usuario_cancion ADD CONSTRAINT FK_9D44A5E7DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_cancion ADD CONSTRAINT FK_9D44A5E79B1D840F FOREIGN KEY (cancion_id) REFERENCES cancion (id)');
        $this->addSql('ALTER TABLE usuario_play_list ADD CONSTRAINT FK_C6F6ECDBDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_play_list ADD CONSTRAINT FK_C6F6ECDB6BBD148 FOREIGN KEY (playlist_id) REFERENCES play_list (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cancion DROP FOREIGN KEY FK_E4620FA0BCE7B795');
        $this->addSql('ALTER TABLE perfil_estilo DROP FOREIGN KEY FK_8C8A3EBE57291544');
        $this->addSql('ALTER TABLE perfil_estilo DROP FOREIGN KEY FK_8C8A3EBE43798DA7');
        $this->addSql('ALTER TABLE play_list_cancion DROP FOREIGN KEY FK_E1C645096BBD148');
        $this->addSql('ALTER TABLE play_list_cancion DROP FOREIGN KEY FK_E1C645099B1D840F');
        $this->addSql('ALTER TABLE usuario_cancion DROP FOREIGN KEY FK_9D44A5E7DB38439E');
        $this->addSql('ALTER TABLE usuario_cancion DROP FOREIGN KEY FK_9D44A5E79B1D840F');
        $this->addSql('ALTER TABLE usuario_play_list DROP FOREIGN KEY FK_C6F6ECDBDB38439E');
        $this->addSql('ALTER TABLE usuario_play_list DROP FOREIGN KEY FK_C6F6ECDB6BBD148');
        $this->addSql('DROP TABLE cancion');
        $this->addSql('DROP TABLE estilo');
        $this->addSql('DROP TABLE perfil');
        $this->addSql('DROP TABLE perfil_estilo');
        $this->addSql('DROP TABLE play_list');
        $this->addSql('DROP TABLE play_list_cancion');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_cancion');
        $this->addSql('DROP TABLE usuario_play_list');
    }
}
