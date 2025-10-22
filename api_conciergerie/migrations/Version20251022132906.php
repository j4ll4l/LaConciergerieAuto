<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251022132906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointement (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, concierge_id INT NOT NULL, vehicule_id INT DEFAULT NULL, schedule_at DATETIME NOT NULL, type VARCHAR(50) NOT NULL, status VARCHAR(50) NOT NULL, INDEX IDX_BD9991CD19EB6921 (client_id), INDEX IDX_BD9991CDA3DF579D (concierge_id), INDEX IDX_BD9991CD4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1C52F9585E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimation_request (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, concierge_id INT DEFAULT NULL, vehicle_details JSON NOT NULL COMMENT \'(DC2Type:json)\', client_message LONGTEXT DEFAULT NULL, estimated_price INT DEFAULT NULL, status VARCHAR(50) NOT NULL, INDEX IDX_163804C019EB6921 (client_id), INDEX IDX_163804C0A3DF579D (concierge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(200) NOT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, address VARCHAR(200) DEFAULT NULL, post_code VARCHAR(6) NOT NULL, city VARCHAR(80) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, bithdate DATE DEFAULT NULL, identity_rectro_path VARCHAR(255) DEFAULT NULL, identity_verso_path VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_3B5B59DDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, buyer_id INT NOT NULL, vehicle_id INT NOT NULL, transaction_id VARCHAR(50) NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_723705D16C755722 (buyer_id), UNIQUE INDEX UNIQ_723705D1545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(80) NOT NULL, last_name VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, seller_id INT NOT NULL, concierge_id INT NOT NULL, price INT NOT NULL, year INT NOT NULL, mileage INT NOT NULL, description LONGTEXT NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_1B80E4867975B7E7 (model_id), INDEX IDX_1B80E4868DE820D9 (seller_id), INDEX IDX_1B80E486A3DF579D (concierge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_photo (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT NOT NULL, image_path VARCHAR(255) NOT NULL, INDEX IDX_761804F4545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_status_history (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT NOT NULL, status VARCHAR(50) NOT NULL, changed_at DATETIME NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_548CFD3D545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointement ADD CONSTRAINT FK_BD9991CD19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE appointement ADD CONSTRAINT FK_BD9991CDA3DF579D FOREIGN KEY (concierge_id) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE appointement ADD CONSTRAINT FK_BD9991CD4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicle (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE estimation_request ADD CONSTRAINT FK_163804C019EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE estimation_request ADD CONSTRAINT FK_163804C0A3DF579D FOREIGN KEY (concierge_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE profile_user ADD CONSTRAINT FK_3B5B59DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D16C755722 FOREIGN KEY (buyer_id) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4868DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A3DF579D FOREIGN KEY (concierge_id) REFERENCES user (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE vehicle_photo ADD CONSTRAINT FK_761804F4545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_status_history ADD CONSTRAINT FK_548CFD3D545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointement DROP FOREIGN KEY FK_BD9991CD19EB6921');
        $this->addSql('ALTER TABLE appointement DROP FOREIGN KEY FK_BD9991CDA3DF579D');
        $this->addSql('ALTER TABLE appointement DROP FOREIGN KEY FK_BD9991CD4A4A3511');
        $this->addSql('ALTER TABLE estimation_request DROP FOREIGN KEY FK_163804C019EB6921');
        $this->addSql('ALTER TABLE estimation_request DROP FOREIGN KEY FK_163804C0A3DF579D');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE profile_user DROP FOREIGN KEY FK_3B5B59DDA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D16C755722');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1545317D1');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867975B7E7');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4868DE820D9');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486A3DF579D');
        $this->addSql('ALTER TABLE vehicle_photo DROP FOREIGN KEY FK_761804F4545317D1');
        $this->addSql('ALTER TABLE vehicle_status_history DROP FOREIGN KEY FK_548CFD3D545317D1');
        $this->addSql('DROP TABLE appointement');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE estimation_request');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE profile_user');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_photo');
        $this->addSql('DROP TABLE vehicle_status_history');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
