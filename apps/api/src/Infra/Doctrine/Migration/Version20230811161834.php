<?php

declare(strict_types=1);

namespace Infra\Doctrine\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230811161834 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE newsfeed (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', title_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', subtitle_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', body_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', provider_id INT NOT NULL, provider_record_id INT NOT NULL, written_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', alert TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D39C3273A9F87BD (title_id), UNIQUE INDEX UNIQ_D39C327310F3A34 (subtitle_id), UNIQUE INDEX UNIQ_D39C32739B621D84 (body_id), UNIQUE INDEX unique_provider_id (provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE newsfeed ADD CONSTRAINT FK_D39C3273A9F87BD FOREIGN KEY (title_id) REFERENCES translation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE newsfeed ADD CONSTRAINT FK_D39C327310F3A34 FOREIGN KEY (subtitle_id) REFERENCES translation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE newsfeed ADD CONSTRAINT FK_D39C32739B621D84 FOREIGN KEY (body_id) REFERENCES translation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE newsfeed DROP FOREIGN KEY FK_D39C3273A9F87BD');
        $this->addSql('ALTER TABLE newsfeed DROP FOREIGN KEY FK_D39C327310F3A34');
        $this->addSql('ALTER TABLE newsfeed DROP FOREIGN KEY FK_D39C32739B621D84');
        $this->addSql('DROP TABLE newsfeed');
    }
}
