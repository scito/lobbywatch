<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . "/../db_export.php";

final class ExportTest extends TestCase {

    public function testCsvExporter(): void {
        $exporter = new CsvExporter();
        $this->assertSame($exporter->getFormat(), 'csv');
        $this->assertSame($exporter->getFileSuffix(), 'csv');
        $this->assertSame($exporter->getQuoteEscape(), '"');
        $this->assertSame($exporter->getFieldSeparator(), "\t");
    }

    public function testNeo4jCsvExporter(): void {
        $exporter = new Neo4jCsvExporter();
        $this->assertSame($exporter->getFormat(), 'neo4j_csv');
        $this->assertSame($exporter->getFileSuffix(), 'csv');
        $this->assertSame($exporter->getQuoteEscape(), '"');
        $this->assertSame($exporter->getFieldSeparator(), "\t");
    }


}
