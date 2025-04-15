<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414173913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_CBE5A331F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE issue (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, reader_id INT NOT NULL, issued_at DATETIME NOT NULL, INDEX IDX_12AD233E16A2B381 (book_id), INDEX IDX_12AD233E1717D737 (reader_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reader (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE return_entry (id INT AUTO_INCREMENT NOT NULL, issue_id INT NOT NULL, returned_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_F296311C5E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE issue ADD CONSTRAINT FK_12AD233E16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE issue ADD CONSTRAINT FK_12AD233E1717D737 FOREIGN KEY (reader_id) REFERENCES reader (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE return_entry ADD CONSTRAINT FK_F296311C5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E16A2B381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E1717D737
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE return_entry DROP FOREIGN KEY FK_F296311C5E7AA58C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE author
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE book
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE issue
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reader
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE return_entry
        SQL);
    }
}
