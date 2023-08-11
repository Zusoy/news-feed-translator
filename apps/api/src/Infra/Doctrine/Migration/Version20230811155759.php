<?php

declare(strict_types=1);

namespace Infra\Doctrine\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230811155759 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE translation (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', original_text LONGTEXT NOT NULL, original_locale VARCHAR(255) NOT NULL, translated_text LONGTEXT NOT NULL, translated_locale VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE translation');
    }
}
