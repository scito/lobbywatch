<?php
// Run: php -f db_export.php -- -v

/*
# ./deploy.sh -b -B -p
# ./run_local_db_script.sh lobbywatchtest prod_bak/`cat prod_bak/last_dbdump_data.txt`

./db_prod_to_local.sh lobbywatchtest
export SYNC_FILE=sql/ws_uid_sync_`date +"%Y%m%d"`.sql; php -f ws_uid_fetcher.php -- -a --ssl -v1 -s | tee $SYNC_FILE; less $SYNC_FILE
./run_local_db_script.sh lobbywatchtest $SYNC_FILE
./deploy.sh -r -s $SYNC_FILE
./deploy.sh -p -r -s $SYNC_FILE
*/

// DONE Neo4j CSV import
// TODO OrientDB ETL CSV import
// TODO ArangdoDB import
// TODO JanusGraph import
// TODO TigerGraph ETL CSV import
// TODO Check Graph DBs: Amazon Neptune, Oracle PGX, Neo4j Server, SAP HANA Graph, AgensGraph (over PostgreSQL), Azure CosmosDB, Redis Graph, SQL Server 2017 Graph, Cypher for Apache Spark, Cypher for Gremlin, SQL Property Graph Querying, TigerGraph, Memgraph, JanusGraph, DSE Graph
// TODO Graphson (low prio)
// TODO GraphML (http://graphml.graphdrawing.org/primer/graphml-primer.html)
// TODO csv raw and csv relations replaced, use abbreviation for party, kanton, rat, ...
// TODO XML (Excel 2003, SpreadsheetML): https://github.com/PHPOffice/PhpSpreadsheet, https://en.wikipedia.org/wiki/Microsoft_Office_XML_formats, https://phpspreadsheet.readthedocs.io/en/latest/
// TODO unify exported field names
// TODO MySQL Export PHP https://github.com/ifsnop/mysqldump-php/blob/master/src/Ifsnop/Mysqldump/Mysqldump.php
// TODO add verbose mode -v



require_once dirname(__FILE__) . '/public_html/settings/settings.php';
require_once dirname(__FILE__) . '/public_html/common/utils.php';
// Change to forms root in order satisfy relative imports
$oldDir = getcwd();
chdir(dirname(__FILE__) . '/public_html/bearbeitung');
require_once dirname(__FILE__) . '/public_html/bearbeitung/database_engine/mysql_engine.php';
chdir($oldDir);

global $script;
global $context;
global $show_sql;
global $db;
global $verbose;
global $download_images;
global $convert_images;
global $lobbywatch_is_forms;
global $intern_fields;

$show_sql = false;

$script = array();
$script[] = "-- SQL script db_export " . date("d.m.Y");

$errors = array();
$verbose = 0;

$intern_fields = ['notizen', 'freigabe_visa', 'created_date', 'created_date_unix', 'created_visa', 'updated_date', 'updated_date_unix', 'updated_visa', 'autorisiert_datum',  'autorisiert_datum_unix', 'autorisierung_verschickt_visa', 'autorisierung_verschickt_datum', 'eingabe_abgeschlossen_datum', 'kontrolliert_datum', 'autorisierung_verschickt_datum_unix', 'eingabe_abgeschlossen_datum_unix', 'kontrolliert_datum_unix', 'autorisiert_visa', 'freigabe_visa', 'eingabe_abgeschlossen_visa', 'kontrolliert_visa', 'symbol_abs', 'photo', 'ALT_kommission', 'ALT_parlam_verbindung', 'email', 'telephon_1', 'telephon_2', 'erfasst', 'adresse_strasse', 'adresse_zusatz', 'parlamentarier_id', 'anzahl_interessenbindungen', 'anzahl_hauptberufliche_interessenbindungen', 'anzahl_nicht_hauptberufliche_interessenbindungen', 'anzahl_abgelaufene_interessenbindungen', 'anzahl_interessenbindungen_alle', 'anzahl_erfasste_verguetungen', 'anzahl_erfasste_hauptberufliche_verguetungen', 'anzahl_erfasste_nicht_hauptberufliche_verguetungen', 'verguetungstransparenz_berechnet', 'verguetungstransparenz_berechnet_nicht_beruflich', 'verguetungstransparenz_berechnet_alle'];

// TODO a hack!
$table_schema = 'lobbywatchtest';
$interessenbindung_join_hist_filter = "JOIN $table_schema.parlamentarier ON interessenbindung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())";
$mandat_join_hist_filter = "JOIN $table_schema.person ON mandat.person_id = person.id JOIN $table_schema.zutrittsberechtigung ON zutrittsberechtigung.person_id = person.id AND (zutrittsberechtigung.bis IS NULL OR zutrittsberechtigung.bis > NOW()) JOIN $table_schema.parlamentarier ON zutrittsberechtigung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())";
  // TODO use YAML for config https://symfony.com/doc/current/components/yaml.html
  $aggregated_tables = [
  // 'partei' => ['view' => 'v_partei', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'branche' => ['view' => 'v_branche_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => ['farbcode', 'symbol_abs', 'symbol_rel', 'symbol_klein_rel', 'symbol_dateiname_wo_ext', 'symbol_dateierweiterung', 'symbol_dateiname', 'symbol_mime_type']],
  // TODO 'interessengruppe' => ['view' => 'v_interessengruppe_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'interessenraum' => ['view' => 'v_interessenraum', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'kommission' => ['view' => 'v_kommission', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // TODO 'organisation' => ['view' => 'v_organisation_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'organisation_jahr' => ['view' => 'v_organisation_jahr', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // TODO add CDATA fields for xml
  // TODO use table as view name
  'parlamentarier' => ['display_name' => 'Parlamentarier', 'view' => 'v_parlamentarier_medium_raw', 'hist_field' => 'im_rat_bis', 'id' => 'id', 'remove_cols' => [], 'aggregated_tables' => [
    'in_kommission' => ['view' => 'v_in_kommission_liste', 'where_id' => "v_in_kommission_liste.parlamentarier_id = :id", 'order_by' => '', 'hist_field' => 'bis', 'id' => 'id', 'remove_cols' => []],
  ]],
  // 'fraktion' => ['view' => 'v_fraktion', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'rat' => ['view' => 'v_rat', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'kanton' => ['view' => 'v_kanton_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'kanton_jahr' => ['view' => 'v_kanton_jahr', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  // 'person' => ['view' => 'v_person_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],

  // 'interessenbindung' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => $interessenbindung_join_hist_filter],
  // 'interessenbindung_jahr' => ['hist_field' => null, 'id' => 'id', 'remove_cols' => array_map(function($val) { return "interessenbindung.$val"; }, array_merge($intern_fields, ['id', 'beschreibung', 'quelle_url_gueltig', 'quelle_url', 'quelle'])), 'hist_filter_join' => "JOIN $table_schema.interessenbindung ON interessenbindung_jahr.interessenbindung_id = interessenbindung.id $interessenbindung_join_hist_filter"],
  // 'in_kommission' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON in_kommission.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())"],
  // 'mandat' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => $mandat_join_hist_filter],
  // 'mandat_jahr' => ['hist_field' => null, 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.mandat ON mandat_jahr.mandat_id = mandat.id $mandat_join_hist_filter"],
  // 'zutrittsberechtigung' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON zutrittsberechtigung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())"],
  // 'organisation_jahr' => ['hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'id' => 'id', 'remove_cols' => []],
  // 'kanton_jahr' => ['hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'id' => 'id', 'remove_cols' => []],
];

// :ID(partei_id) :LABEL (separated by ;) :IGNORE
// --nodes[:Label1:Label2]=<"headerfile,file1,file2,…​">
// --id-type=<STRING|INTEGER|ACTUAL>
$nodes = [
  'partei' => ['table' => 'partei', 'view' => 'v_partei', 'name' => 'Partei', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'branche' => ['table' => 'branche', 'view' => 'v_branche_simple', 'name' => 'Branche', 'id' => 'id', 'hist_field' => null, 'remove_cols' => ['farbcode', 'symbol_abs', 'symbol_rel', 'symbol_klein_rel', 'symbol_dateiname_wo_ext', 'symbol_dateierweiterung', 'symbol_dateiname', 'symbol_mime_type']],
  'interessengruppe' => ['table' => 'interessengruppe', 'view' => 'v_interessengruppe_simple', 'name' => 'Lobbygruppe', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'interessenraum' => ['table' => 'interessenraum', 'view' => 'v_interessenraum', 'name' => 'Interessenraum', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'kommission' => ['table' => 'kommission', 'view' => 'v_kommission', 'name' => 'Kommission', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'organisation' => ['table' => 'organisation', 'view' => 'v_organisation_simple', 'name' => 'Organisation', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'organisation_jahr' => ['table' => 'organisation_jahr', 'view' => 'v_organisation_jahr', 'name' => 'Organisationsjahr', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'parlamentarier' => ['table' => 'parlamentarier', 'view' => 'v_parlamentarier_simple', 'name' => 'Parlamentarier', 'id' => 'id', 'hist_field' => 'im_rat_bis', 'remove_cols' => []],
  'fraktion' => ['table' => 'fraktion', 'view' => 'v_fraktion', 'name' => 'Fraktion', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'rat' => ['table' => 'rat', 'view' => 'v_rat', 'name' => 'Rat', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'kanton' => ['table' => 'kanton', 'view' => 'v_kanton_simple', 'name' => 'Kanton', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'kanton_jahr' => ['table' => 'kanton_jahr', 'view' => 'v_kanton_jahr', 'name' => 'Kantonjahr', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
  'person' => ['table' => 'person', 'view' => 'v_person_simple', 'name' => 'Person', 'id' => 'id', 'hist_field' => null, 'remove_cols' => []],
];

// TODO 'USE DATABASE' instead of repating table schema in all queries
// :START_ID(parlamentarier_id) :END_ID(partei_id) :TYPE :IGNORE
// --relationships[:RELATIONSHIP_TYPE]=<"headerfile,file1,file2,…​">
$interessenbindung_join_hist_filter = "JOIN $table_schema.parlamentarier ON interessenbindung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())";
$mandat_join_hist_filter = "JOIN $table_schema.person ON mandat.person_id = person.id JOIN $table_schema.zutrittsberechtigung ON zutrittsberechtigung.person_id = person.id AND (zutrittsberechtigung.bis IS NULL OR zutrittsberechtigung.bis > NOW()) JOIN $table_schema.parlamentarier ON zutrittsberechtigung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())";
$relationships = [
  'interessenbindung' => ['table' => 'interessenbindung', 'name' => 'HAT_INTERESSENBINDUNG_MIT', 'id' => 'id', 'start_id' => 'parlamentarier_id', 'end_id' => 'organisation_id', 'hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => $interessenbindung_join_hist_filter],
  'interessenbindung_jahr' => ['table' => 'interessenbindung_jahr', 'join' => "JOIN $table_schema.interessenbindung ON interessenbindung_jahr.interessenbindung_id = interessenbindung.id", 'name' => 'VERGUETED', 'id' => 'id', 'start_id' => 'organisation_id', 'end_id' => 'parlamentarier_id', 'additional_join_cols' => ['interessenbindung.parlamentarier_id', 'interessenbindung.organisation_id'], 'additional_join_csv_header_cols' => ['parlamentarier_id:END_ID(parlamentarier_id)', 'organisation_id:START_ID(organisation_id)'], 'hist_field' => null, 'remove_cols' => array_map(function($val) { return "interessenbindung.$val"; }, array_merge($intern_fields, ['id', 'beschreibung', 'quelle_url_gueltig', 'quelle_url', 'quelle'])), 'hist_filter_join' => $interessenbindung_join_hist_filter],
  'in_kommission' => ['table' => 'in_kommission', 'name' => 'IST_IN_KOMMISSION', 'id' => 'id', 'start_id' => 'parlamentarier_id', 'end_id' => 'kommission_id', 'hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON in_kommission.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())"],
  'mandat' => ['table' => 'mandat', 'name' => 'HAT_MANDAT', 'id' => 'id', 'start_id' => 'person_id', 'end_id' => 'organisation_id', 'hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => $mandat_join_hist_filter],
  'mandat_jahr' => ['table' => 'mandat_jahr', 'join' => "JOIN $table_schema.mandat ON mandat_jahr.mandat_id = mandat.id", 'name' => 'VERGUETED', 'id' => 'id', 'start_id' => 'organisation_id', 'end_id' => 'person_id', 'additional_join_cols' => ['mandat.person_id', 'mandat.organisation_id'], 'additional_join_csv_header_cols' => ['person_id:END_ID(person_id)', 'organisation_id:START_ID(organisation_id)'], 'hist_field' => null, 'remove_cols' => array_map(function($val) { return "mandat.$val"; }, array_merge($intern_fields, ['id', 'beschreibung', 'quelle_url_gueltig', 'quelle_url', 'quelle'])), 'hist_filter_join' => $mandat_join_hist_filter],
  'organisation_beziehung' => ['table' => 'organisation_beziehung', 'name' => 'HAT_BEZIEHUNG', 'type_col' => 'art', 'id' => 'id', 'start_id' => 'organisation_id', 'end_id' => 'ziel_organisation_id', 'end_id_space' => 'organisation_id', 'hist_field' => 'bis', 'remove_cols' => []],
  'zutrittsberechtigung' => ['table' => 'zutrittsberechtigung', 'name' => 'HAT_ZUTRITTSBERECHTIGTER', 'id' => 'id', 'start_id' => 'parlamentarier_id', 'end_id' => 'person_id', 'hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON zutrittsberechtigung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())"],
  'parlamentarier_partei' => ['table' => 'parlamentarier', 'name' => 'IST_PARTEIMITGLIED_VON', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'partei_id', 'hist_field' => 'im_rat_bis', 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'parlamentarier_fraktion' => ['table' => 'parlamentarier', 'name' => 'IST_FRAKTIONMITGLIED_VON', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'fraktion_id', 'hist_field' => 'im_rat_bis', 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'parlamentarier_rat' => ['table' => 'parlamentarier', 'name' => 'IST_IM_RAT', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'rat_id', 'hist_field' => 'im_rat_bis', 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'parlamentarier_kanton' => ['table' => 'parlamentarier', 'name' => 'WOHNT_IM_KANTON', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'kanton_id', 'hist_field' => 'im_rat_bis', 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'organisation_interessengruppe' => ['table' => 'organisation', 'name' => 'GEHOERT_ZU', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'interessengruppe_id', 'end_id_space' => 'interessengruppe_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'organisation_interessengruppe2' => ['table' => 'organisation', 'name' => 'GEHOERT_ZU', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'interessengruppe2_id', 'end_id_space' => 'interessengruppe_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'organisation_interessengruppe3' => ['table' => 'organisation', 'name' => 'GEHOERT_ZU', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'interessengruppe3_id', 'end_id_space' => 'interessengruppe_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'organisation_interessenraum' => ['table' => 'organisation', 'name' => 'HAT_INTERESSENRAUM', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'interessenraum_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'organisation_jahr' => ['table' => 'organisation_jahr', 'name' => 'ORGANISATION_HAT_IM_JAHR', 'id' => 'id', 'start_id' => 'organisation_id', 'end_id' => 'id', 'end_id_space' => 'organisation_jahr_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'kanton_jahr' => ['table' => 'kanton_jahr', 'name' => 'KANTON_HAT_IM_JAHR', 'id' => 'id', 'start_id' => 'kanton_id', 'end_id' => 'id', 'end_id_space' => 'kanton_jahr_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'interessengruppe_branche' => ['table' => 'interessengruppe', 'name' => 'IST_IN_BRANCHE', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'branche_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'branche_kommission' => ['table' => 'branche', 'name' => 'HAT_ZUSTAENDIGE_KOMMISSION', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'kommission_id', 'end_id_space' => 'kommission_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
  'branche_kommission2' => ['table' => 'branche', 'name' => 'HAT_ZUSTAENDIGE_KOMMISSION', 'id' => 'id', 'start_id' => 'id', 'end_id' => 'kommission2_id', 'end_id_space' => 'kommission_id', 'hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'remove_cols' => []],
];

$flat_tables = [
  'partei' => ['view' => 'v_partei', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'branche' => ['view' => 'v_branche_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => ['farbcode', 'symbol_abs', 'symbol_rel', 'symbol_klein_rel', 'symbol_dateiname_wo_ext', 'symbol_dateierweiterung', 'symbol_dateiname', 'symbol_mime_type']],
  'interessengruppe' => ['view' => 'v_interessengruppe_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'interessenraum' => ['view' => 'v_interessenraum', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'kommission' => ['view' => 'v_kommission', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'organisation' => ['view' => 'v_organisation_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'organisation_jahr' => ['view' => 'v_organisation_jahr', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'parlamentarier' => ['view' => 'v_parlamentarier_medium_raw', 'hist_field' => 'im_rat_bis', 'id' => 'id', 'remove_cols' => ['anzeige_name_de','anzeige_name_fr', 'name_de', 'name_fr', 'parlament_interessenbindungen', 'parlament_interessenbindungen_json']],
  'fraktion' => ['view' => 'v_fraktion', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'rat' => ['view' => 'v_rat', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'kanton' => ['view' => 'v_kanton_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'kanton_jahr' => ['view' => 'v_kanton_jahr', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  'person' => ['view' => 'v_person_simple', 'hist_field' => null, 'id' => 'id', 'remove_cols' => []],
  
  'interessenbindung' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => $interessenbindung_join_hist_filter],
  'interessenbindung_jahr' => ['hist_field' => null, 'id' => 'id', 'remove_cols' => array_map(function($val) { return "interessenbindung.$val"; }, array_merge($intern_fields, ['id', 'beschreibung', 'quelle_url_gueltig', 'quelle_url', 'quelle'])), 'hist_filter_join' => "JOIN $table_schema.interessenbindung ON interessenbindung_jahr.interessenbindung_id = interessenbindung.id $interessenbindung_join_hist_filter"],
  'in_kommission' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON in_kommission.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())"],
  'mandat' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => $mandat_join_hist_filter],
  'mandat_jahr' => ['hist_field' => null, 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.mandat ON mandat_jahr.mandat_id = mandat.id $mandat_join_hist_filter"],
  'zutrittsberechtigung' => ['hist_field' => 'bis', 'id' => 'id', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON zutrittsberechtigung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())"],
  'organisation_jahr' => ['hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'id' => 'id', 'remove_cols' => []],
  'kanton_jahr' => ['hist_field' => null, 'select_cols' => ['freigabe_datum', 'freigabe_visa', 'created_date', 'created_visa', 'updated_date', 'updated_visa'], 'id' => 'id', 'remove_cols' => []],
];

$sql_tables = [
  'kanton' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'kanton_jahr' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'interessenraum' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'rat' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'fraktion' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'partei' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'kommission' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'branche' => ['hist_field' => null, 'remove_cols' => ['farbcode', 'symbol_abs', 'symbol_rel', 'symbol_klein_rel', 'symbol_dateiname_wo_ext', 'symbol_dateierweiterung', 'symbol_dateiname', 'symbol_mime_type'], 'id' => 'id'],
  'interessengruppe' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'organisation' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'organisation_jahr' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  'parlamentarier' => ['hist_field' => 'im_rat_bis', 'remove_cols' => [], 'id' => 'id'],
  'person' => ['hist_field' => null, 'remove_cols' => [], 'id' => 'id'],
  
  'interessenbindung' => ['hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => $interessenbindung_join_hist_filter, 'id' => 'id'],
  'interessenbindung_jahr' => ['hist_field' => null, 'remove_cols' => array_map(function($val) { return "interessenbindung.$val"; }, array_merge($intern_fields, ['id', 'beschreibung', 'quelle_url_gueltig', 'quelle_url', 'quelle'])), 'hist_filter_join' => "JOIN $table_schema.interessenbindung ON interessenbindung_jahr.interessenbindung_id = interessenbindung.id $interessenbindung_join_hist_filter", 'id' => 'id'],
  'in_kommission' => ['hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON in_kommission.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())", 'id' => 'id'],
  'mandat' => ['hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => $mandat_join_hist_filter, 'id' => 'id'],
  'mandat_jahr' => ['hist_field' => null, 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.mandat ON mandat_jahr.mandat_id = mandat.id $mandat_join_hist_filter", 'id' => 'id'],
  'zutrittsberechtigung' => ['hist_field' => 'bis', 'remove_cols' => [], 'hist_filter_join' => "JOIN $table_schema.parlamentarier ON zutrittsberechtigung.parlamentarier_id = parlamentarier.id AND (parlamentarier.im_rat_bis IS NULL OR parlamentarier.im_rat_bis > NOW())", 'id' => 'id'],
];

$data_source = [
  'flat' => $flat_tables,
  'node' => $nodes,
  'relationship' => $relationships,
  'aggregated' => $aggregated_tables,
  'sql' => $sql_tables,
];

// TODO add CC-BY-SA license note to exports header
// TODO write PHPunit tests, e.g. for formatRow(), https://blog.dcycle.com/blog/2019-10-16/unit-testing/
interface IExportFormat {
  const FILE_ONE = 'one_file';
  const FILE_MULTI = 'multi_file';
  function supportsOneFile(): bool;
  function prefersOneFile(): bool;
  function isAggregatedFormat(): bool;
  // function hasHeader(): bool;
  
  function getRowSeparator(): string;
  function getFieldSeparator(): ?string;
  function getQuoteEscape(): ?string;
  // function dataTypeMapping();
  function getFormatName(): string;
  function getFormat(): string;
  function getFileSuffix(): string;
  function setFormatParameter(array $parameter);
  function getFormatParameter(): array;
  function getDataSourceKeys(): array;
  function getFileHeader(string $transaction_date): array;
  function getHeaderDeclaration(array $cols): array;
  function getExtraCol(array $tableMeta): ?string;
  /**
   * Returns data for one header column.
   */
  function getHeaderCol(string $col, string $dataType, string $table, array $tableMeta): ?array;
  /**
   * @return array lines
   */
  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array;
  /**
   * @return array lines
   */
  function getTableHeader(string $table, array $tableMeta): array;
  function skipRow(array $row): bool;
  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string;
  function getTableFooter(string $table, array $tableMeta): array;
  /**
   * @return array lines
   */
  function getTableListFooter(string $table, array $tableMeta): array;
  function getFileFooter(): array;
  function getImportHint(): array;
  function getImportHintFromTable(string $filename, string $table, array $tableMeta): ?string;

  function validate($file);
}

abstract class AbstractExporter implements IExportFormat {
  protected $format;
  protected $fileSuffix;
  protected $formatName;
  protected $parameter = [];
  protected $eol = "\n";

  function getFormat(): string {
    return $this->format;
  }

  function getFormatName(): string {
    return $this->formatName;
  }

  function getFormatParameter(): array {
    return $this->parameter;
  }

  // function hasHeader(): bool {
  //   return false;
  // }

  function setFormatParameter(array $parameter): string {
    $this->parameter = $parameter;
  }

  function isAggregatedFormat(): bool {
    return false;
  }
  function getRowSeparator(): string {
    return '';
  }

  protected function setFieldSeparator(string $sep = null): ?string {
    return null;
  }
  protected function setQuoteEscape(string $qe = null): ?string {
    return null;
  }

  function getFieldSeparator(): ?string {
    return null;
  }
  function getQuoteEscape(): ?string {
    return null;
  }

  function getFileSuffix(): string {
    return $this->fileSuffix;
  }

  function getFileHeader(string $transaction_date): array {
    return [];
  }

  function getHeaderDeclaration(array $cols): array {
    return [];
  }

  function getExtraCol(array $tableMeta): ?string {
    return null;
  }

  /**
   * Returns data for one header column.
   */
  function getHeaderCol(string $col, string $dataType, string $table, array $tableMeta): ?array {
    return [$col, false];
  }

  /**
   * @return array lines
   */
  function getTableHeader(string $table, array $tableMeta): array {
    return [];
  }
  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return [];
  }
  function skipRow(array $row): bool {
    return false;
  }
  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    return '';
  }
  function getTableFooter(string $table, array $tableMeta): array {
    return [];
  }
  function getTableListFooter(string $table, array $tableMeta): array {
    return [];
  }
  function getFileFooter(): array {
    return [];
  }
  function getImportHint(): array {
    return [];
  }

  function getImportHintFromTable(string $filename, string $table, array $tableMeta): ?string {
    return null;
  }

  function validate($file) {
    return null;
  }

  function prefersOneFile(): bool {
    return false;
  }


}

abstract class FlatExporter extends AbstractExporter implements IExportFormat {
  
  protected $qe;
  protected $sep;

  function __construct($sep = null, $qe = null) {
    $this->setFieldSeparator($sep);
    $this->setQuoteEscape($qe);
  }

  function getQuoteEscape(): string {
    $this->qe;
  }
  
  function getFieldSeparator(): string {
    $this->sep;
  }

  protected function setFieldSeparator(string $sep = null): ?string {
    if ($sep == null) {
      $this->sep = $this->getSupportedFieldSeparator()[0];
    } elseif (in_array($sep, $this->getSupportedFieldSeparator())) {
      $this->sep = $sep;
    } else {
      throw new Exception("Separator '$sep' not supported for format '$format'. Supported separators: " . implode(', ', $this->getSupportedFieldSeparator()));
    }
    return $this->sep;
  }

  protected function setQuoteEscape(string $qe = null): ?string {
    if ($qe == null) {
      $this->qe = $this->getSupportedQuoteEscape()[0];
    } elseif (in_array($qe, $this->getSupportedQuoteEscape())) {
      $this->qe = $qe;
    } else {
      throw new Exception("Quote escape '$qe' not supported for format '$format'. Supported: " . implode(', ', $this->getSupportedQuoteEscape()));
    }
    return $this->qe;
  }

  function supportsOneFile(): bool {
    return false;
  }
  function isAggregatedFormat(): bool {
    return false;
  }

  function getDataSourceKeys(): array {
    return ['flat'];
  }

  protected abstract function getSupportedQuoteEscape(): array;
  
  protected abstract function getSupportedFieldSeparator(): array;

}

abstract class AggregatedExporter extends AbstractExporter implements IExportFormat {

  function supportsOneFile(): bool {
    return true;
  }
  function isAggregatedFormat(): bool {
    return true;
  }
  function getDataSourceKeys(): array {
    return ['flat', 'aggregated'];
  }

}

class CsvExporter extends FlatExporter {

  protected $qe;
  protected $sep;

  function __construct($sep = null, $qe = null) {
    parent::__construct($sep, $qe);
    $this->format = 'csv';
    $this->formatName = 'CSV';
    $this->fileSuffix = 'csv';
  }

  protected function getSupportedQuoteEscape(): array {
    return ['"', '\\'];
  }
  
  protected function getSupportedFieldSeparator(): array {
    return ["\t", ';', ',', '|', ':'];
  }

  function getQuoteEscape(): string {
    $this->qe;
  }
  
  function getFieldSeparator(): string {
    $this->sep;
  }

  protected function setFieldSeparator(string $sep = null): ?string {
    if ($sep == null) {
      $this->sep = $this->getSupportedFieldSeparator()[0];
    } elseif (in_array($sep, $this->getSupportedFieldSeparator())) {
      $this->sep = $sep;
    } else {
      throw new Exception("Separator '$sep' not supported for format '$format'. Supported separators: " . implode(', ', $this->getSupportedFieldSeparator()));
    }
    return $this->sep;
  }

  protected function setQuoteEscape(string $qe = null): ?string {
    if ($qe == null) {
      $this->qe = $this->getSupportedQuoteEscape()[0];
    } elseif (in_array($qe, $this->getSupportedQuoteEscape())) {
      $this->qe = $qe;
    } else {
      throw new Exception("Quote escape '$qe' not supported for format '$format'. Supported: " . implode(', ', $this->getSupportedQuoteEscape()));
    }
    return $this->qe;
  }

  // function hasHeader(): bool {
  //   return true;
  // }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return [implode($this->sep, $export_header)];
    // print("$export_header_str\n")];
  }

  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    $type_col = $table_meta['type_col'] ?? null;
    $extra_val = $table_meta['name'] ?? null;

    // TODO use USE for $qe
    $qes = array_fill(0, $extra_val ? count($data_types) + 1 : count($data_types), $this->qe);
    $data_types_extra_col = $extra_val ? array_unshift($data_types, 'varchar') : $data_types;

    return ($extra_val ? ($type_col ? str_replace(' ', '_', strtoupper($row[$type_col])) : $extra_val) . "$this->sep" : '') .
    implode($this->sep, array_map(['self', 'escape_csv_field'], $row, $data_types, $qes));
  }

  protected static function escape_csv_field(string $field = null, string $data_type, string $qe): string {
    if (is_null($field)) {
      return '';
    }

    switch ($data_type) {
      case 'timestamp': return str_replace(' ', 'T', $field);
      case 'date': return $field;
    }
    switch ($field) {
      case is_numeric($field): return $field;
      default: return '"' . str_replace('"', "$qe\"", str_replace("\n", '\n', str_replace("\r", '', $field))) . '"';
    }
  }
  

}

class Neo4jCsvExporter extends CsvExporter {

  function __construct($sep = null, $qe = null) {
    parent::__construct($sep, $qe);
    $this->format = 'csv_neo4j';
    $this->formatName = 'Neo4J CSV';
    $this->fileSuffix = 'csv';
  }

  protected function getSupportedQuoteEscape(): array {
    return ['"', '\\'];
  }
  
  protected function getSupportedFieldSeparator(): array {
    return ["\t", ';', ',', '|', ':'];
  }

  private const TYPE_MAPPING = [
    'int' => 'int',
    'tinyint' => 'int',
    'smallint' => 'int',
    'bigint' => 'string',
    'float' => 'float',
    'double' => 'double',
    'boolean' => 'boolean',
    'varchar' => 'string',
    'char' => 'char',
    'enum' => 'string',
    'set' => 'string[]', // TODO fix export, set quotes correctly, use ; as delim
    'mediumtext' => 'string',
    'text' => 'string',
    'json' => 'string',
    'date' => 'date',
    'timestamp' => 'localdatetime',
  ];

  function getDataSourceKeys(): array {
    return ['node', 'relationship'];
  }

  function getExtraCol(array $tableMeta): ?string {
    if (isset($tableMeta['name'])) {
      $type = $tableMeta['source'];
      switch ($type) {
        case 'node': return ':LABEL';
        case 'relationship': return ':TYPE';
        default: throw new Exception("Unknown type" . $type);
      }
    } else {
      return null;
    }
  }

  /**
   * Returns data for one header column.
   */
  function getHeaderCol(string $col, string $dataType, string $table, array $table_meta): array {
    $type = $table_meta['source'];
    $header_field = $col;
    $skip_rows_for_empty_field = false;
    if ($type == 'node') {
      if ($col == $table_meta['id']) {
        $header_field .= ":ID({$table}_id)";
      } else {
        $header_field .= ":" . self::TYPE_MAPPING[$dataType];
      }
      $skip_rows_for_empty_field = false;
    } elseif ($type == 'relationship') {
      if ($col == $table_meta['start_id'] && $table_meta['id'] == $table_meta['start_id']) {
        $header_field .= ":START_ID({$table}_$col)";
        $skip_rows_for_empty_field = false;
      } elseif ($col == $table_meta['start_id']) {
        $id_space = $table_meta['start_id_space'] ?? $col;
        $header_field .= ":START_ID($id_space)";
        $skip_rows_for_empty_field = true;
      } elseif ($col == $table_meta['end_id']) {
        $id_space = $table_meta['end_id_space'] ?? $col;
        $header_field .= ":END_ID($id_space)";
        $skip_rows_for_empty_field = true;
      } else {
        $header_field .= ":" . self::TYPE_MAPPING[$dataType];
        $skip_rows_for_empty_field = false;
      }
    } else {
      throw new Exception('Unknown source type: ' . $type);
    }
    return [$header_field, $skip_rows_for_empty_field];
  }


  function getImportHint(): array {
    $cmd_args = [];
    //     $cmd_args[] = "neo4j-admin";
    $cmd_args[] = "rm -r ~/.config/Neo4j\ Desktop/Application/neo4jDatabases/database-0b42a643-61a0-4b3f-8c54-4dfbe872d200/installation-3.5.6/data/databases/graph.db/; ~/.config/Neo4j\ Desktop/Application/neo4jDatabases/database-0b42a643-61a0-4b3f-8c54-4dfbe872d200/installation-3.5.6/bin/neo4j-admin";
    $cmd_args[] = "import";
    $cmd_args[] = "--database=graph.db";
    $cmd_args[] = "--id-type=INTEGER";
    $cmd_args[] = "--delimiter='\\t'";
    $cmd_args[] = "--array-delimiter=','";
    $cmd_args[] = "--report-file=neo4j_import.log";
  
    return $cmd_args;
  }

  function getImportHintFromTable(string $filename, string $table, array $tableMeta): string {
    $type = $tableMeta['source'];
    return "--{$type}s \"$filename\"";
  }

}

class SqlExporter extends FlatExporter implements IExportFormat {

  // protected $oneline = false;

  function __construct($sep = null, $qe = null) {
    parent::__construct($sep, $qe);
    $this->format = 'sql';
    $this->formatName = 'SQL';
    $this->fileSuffix = 'sql';
  }

  protected function getSupportedQuoteEscape(): array {
    return ['\\', "'"];
  }
  
  protected function getSupportedFieldSeparator(): array {
    return [','];
  }

  function supportsOneFile(): bool {
    return true;
  }
  function prefersOneFile(): bool {
    return true;
  }
  function isAggregatedFormat(): bool {
    return false;
  }

  function getDataSourceKeys(): array {
    return ['sql'];
  }

   function hasHeader(): bool {
    return false;
  }

  function getRowSeparator(): string {
    return ',';
  }

  function getFileHeader($transaction_date): array {
    $header = [];
    $header[] = "-- Lobbywatch.ch SQL export $transaction_date";
    $header[] = '';
    // $header[] = "-- Hist data included: " . !$filter_hist . "$eol");
    // $header[] = "-- Intern data included: " . !$filter_intern_fields . "$eol$eol");
    
    $header[] = "SET NAMES utf8mb4;";
    $header[] = "SET TIME_ZONE='+00:00';";
    $header[] = '';
    $header[] = "SET FOREIGN_KEY_CHECKS=0;";
    $header[] = '';
    $header[] = "-- SET SQL_NOTES=0;";
    $header[] = '';
    
    $header[] = "CREATE DATABASE IF NOT EXISTS lobbywatch_public DEFAULT CHARACTER SET utf8mb4;";
    $header[] = "USE lobbywatch_public;";
    $header[] = '';
    $header[] = '';
  
    return $header;
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    // $table_create_lines = $tableMeta['table_create_lines'];
    // $export_header = $tableMeta['export_header'];
    return [ 
    "DROP TABLE IF EXISTS $table;",
    str_replace('`', '', implode($this->eol, $table_create_lines) . ";"),
    '',
    "INSERT INTO $table (" . implode(", ", $export_header) . ") VALUES"
    ];
  }
  /**
   * @return array lines
   */
  function getTableHeader(string $table, array $tableMeta): array {
    // $table_create_lines = $tableMeta['table_create_lines'];
    // $export_header = $tableMeta['export_header'];
    // return [ 
    // "DROP TABLE IF EXISTS $table;",
    // str_replace('`', '', implode($this->eol, $table_create_lines) . ";"),
    // "INSERT INTO $table (" . implode(", ", $export_header) . ") VALUES"
    // ];
    return [];
  }
  function skipRow(array $row): bool {
    return false;
  }
  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    $qes = array_fill(0, count($data_types), $this->qe);
    return '(' . implode(",", array_map(['self', 'escape_sql_field'], $row, $data_types, $qes)) . ')';
  }
  function getTableFooter(string $table, array $tableMeta): array {
    return [];
  }
  function getTableListFooter(string $table, array $tableMeta): array {
    // return ["$this->eol]"];
    return [';'];
  }
  function getFileFooter(): array {
    return ['SET FOREIGN_KEY_CHECKS=1;'];
  }


  protected static function escape_sql_field(string $field = null, string $data_type, string $qe): string {
    if (is_null($field)) {
      return 'NULL';
    }
    switch ($data_type) {
      case 'int':
      case 'tinyint':
      case 'smallint':
      case 'bigint':
      case 'float':
      case 'double':
      case 'boolean': return $field;
      
      case 'json': return "'" . str_replace('\"', '\\\\"', str_replace("'", $qe . "'", str_replace("\n", '\n', str_replace("\r", '', $field)))) . "'";
      
      case 'timestamp':
      case 'date':
      case 'varchar':
      case 'char':
      case 'enum':
      case 'set':
      case 'mediumtext':
      case 'text':
      default: return "'" . str_replace("'", $qe . "'", str_replace("\n", '\n', str_replace("\r", '', $field))) . "'";
    }
    //     switch ($field) {
      //         case is_numeric($field): return $field;
      //         default: return '"' . str_replace('"', '""', str_replace("\n", '\n', str_replace("\r", '', $field))) . '"';
      //     }
    }
  
}


class JsonExporter extends AggregatedExporter {

  function __construct() {
    $this->format = 'json';
    $this->fileSuffix = 'json';
    $this->formatName = 'JSON';
  }

  function getRowSeparator(): string {
    return ',';
  }

  function getFileHeader($transaction_date): array {
    return ['{'];
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return ["\"$table\":["];
  }
  /**
   * @return array lines
   */
  function getTableHeader(string $table, array $tableMeta): array {
    return [];
  }
  function skipRow(array $row): bool {
    return false;
  }
  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    return json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
  }
  function getTableFooter(string $table, array $tableMeta): array {
    return ['}'];
  }
  function getTableListFooter(string $table, array $tableMeta): array {
    return ["$this->eol]"];
    // return ["]"];
  }
  function getFileFooter(): array {
    return ['}'];
  }

}

class JsonlExporter extends JsonExporter {

  function __construct() {
    $this->format = 'jsonl';
    $this->fileSuffix = 'jsonl';
    $this->formatName = 'JsonL';
  }

  function supportsOneFile(): bool {
    return false;
  }

  function getRowSeparator(): string {
    return '';
  }

  function getFileHeader($transaction_date): array {
    return [];
  }

  function getFileFooter(): array {
    return [];
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return [];
  }

  function getTableListFooter(string $table, array $tableMeta): array {
    return [];
  }


}

class XmlExporter extends AggregatedExporter {

  function __construct() {
    $this->format = 'xml';
    $this->fileSuffix = 'xml';
    $this->formatName = 'XML';
  }

  function getFileHeader($transaction_date): array {
    return ['<?xml version="1.0" encoding="UTF-8"?>'];
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return ["<${table}_liste>"];
  }
  /**
   * @return array lines
   */
  function getTableHeader(string $table, array $tableMeta): array {
    return [];
  }
  function skipRow(array $row): bool {
    return false;
  }
  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    return str_repeat("\t", $level) . $this->array2xml($table, $table, $row);
  }
  function getTableFooter(string $table, array $tableMeta): array {
    return [];
  }
  function getTableListFooter(string $table, array $tableMeta): array {
    return ["$this->eol</${table}_liste>"];
  }
  function getFileFooter(): array {
    return [];
  }

  protected function array2xml(string $outer_name, string $inner_name, array $data, $file = false) {
    $xml_root = new SimpleXMLElement("<root/>");
    $xml_data = $xml_root->addChild("$outer_name");
  
    // function call to convert array to xml
    $this->array2xmlObj($inner_name, $data, $xml_data);
    
    //saving generated xml file;
    $str = '';
    foreach ($xml_root as $elem) {
      if ($file)  {
        $elem->asXML($file);
      } else {
        $str .= $elem->asXML();
      }
    }
    return str_replace("\n", '&#xA;', $str);
  }
  
  // https://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
  protected function array2xmlObj(string $name, array $data, $xml_data) {
    foreach($data as $key => $value) {
      if (is_numeric($key)){
        // $key = "item$key"; //dealing with <0/>..<n/> issues
        $key = $name;
      }
      if (is_array($value)) {
        $subnode = $xml_data->addChild(isset($value[0]) && is_array($value[0]) ? "${key}_liste" : $key);
        $this->array2xmlObj($key, $value, $subnode);
      } elseif (utils_startsWith($key, '@')) {
        // TODO use attributes
        $xml_data->addAttribute(mb_substr("$key", 1), htmlspecialchars("$value", ENT_XML1));
      } else {
        $xml_data->addChild("$key", htmlspecialchars("$value", ENT_XML1));
      }
     }
  }
  

}

// http://graphml.graphdrawing.org/primer/graphml-primer.html
class GraphMLExporter extends XmlExporter {

  function __construct() {
    $this->format = 'graphml';
    $this->fileSuffix = 'graphml';
    $this->formatName = 'GraphML';
  }

  function getDataSourceKeys(): array {
    return ['node', 'relationship'];
  }

  function prefersOneFile(): bool {
    return true;
  }

  function getFileHeader($transaction_date): array {
    return ['<?xml version="1.0" encoding="UTF-8"?>', '<graphml xmlns="http://graphml.graphdrawing.org/xmlns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://graphml.graphdrawing.org/xmlns http://graphml.graphdrawing.org/xmlns/1.0/graphml.xsd">'];
  }

  function getFileFooter(): array {
    return ['</graph>', '</graphml>'];
  }

  function getHeaderDeclaration(array $cols): array {
    $attributes = [];
    $xml = [];
    $forMapping = [
      'node' => 'node',
      'relationship' => 'edge',
      'edge' => 'edge'
    ];
    // boolean, int, long, float, double, or string
    $typeMapping = [
      'int' => 'int',
      'tinyint' => 'int',
      'smallint' => 'int',
      'bigint' => 'string',
      'float' => 'float',
      'decimal' => 'double',
      'double' => 'double',
      'boolean' => 'boolean',
      'varchar' => 'string',
      'string' => 'string',
      'char' => 'string',
      'enum' => 'string',
      'set' => 'string',
      'mediumtext' => 'string',
      'text' => 'string',
      'json' => 'string',
      'date' => 'string',
      'timestamp' => 'string',
    ];

    $cols[] = ['col' => 'table', 'source' => 'node', 'type' => 'string'];
    $cols[] = ['col' => 'table', 'source' => 'edge', 'type' => 'string'];
  
    $names = [];
    foreach($cols as $col) {
      if (!in_array($col['col'], $names)) {
        $names[] = $col['col'];
      } else {
        continue;
      }
      // $attributes[] = ['@id' => $col['col'], '@for' => $forMapping[$col['source']], '@attr.name' => $col['col'], '@attr.type' => $typeMapping[$col['type']]];
      $xml[] = "<key id=\"${col['col']}\" for=\"${forMapping[$col['source']]}\" attr.name=\"${col['col']}\" attr.type=\"${typeMapping[$col['type']]}\" />";
    }
    $xml[] = "<graph id=\"Lobbywatch Graph\" edgedefault=\"directed\">";
    // $this->array2xml('key', $attributes);
    return $xml;
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return [];
  }

  function getTableListFooter(string $table, array $tableMeta): array {
    return [];
  }

  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    $source = $table_meta['source'];
    $type = $source == 'node' ? $source : 'edge';
    $xml_root = new SimpleXMLElement("<root/>");
    $xml_data = $xml_root->addChild($type);
    if ($type == 'node') {
      $xml_data->addAttribute("id", htmlspecialchars("$table_key${row['id']}", ENT_XML1));
      $xml_data->addAttribute("labels", htmlspecialchars(":$table", ENT_XML1));
    } elseif ($type == 'edge') {
      $xml_data->addAttribute("id", htmlspecialchars("edge_$table_key${row['id']}", ENT_XML1));

      $type_col = $table_meta['type_col'] ?? null;
      $extra_val = $table_meta['name'] ?? null;

      $label = ($extra_val ? ($type_col ? str_replace(' ', '_', strtoupper($row[$type_col])) : $extra_val) : '');
      $xml_data->addAttribute("label", htmlspecialchars($label, ENT_XML1));

      $xml_data->addChild("data", htmlspecialchars($label, ENT_XML1))
        ->addAttribute("key", htmlspecialchars('label', ENT_XML1));
    }

    foreach ($row as $col => $value) {
      $xml_data->addChild("data", htmlspecialchars(is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK) : $value, ENT_XML1))
        ->addAttribute("key", htmlspecialchars($col, ENT_XML1));

      if ($type == 'edge') {
        if ($col == $table_meta['start_id'] && $table_meta['id'] == $table_meta['start_id']) {
          $xml_data->addAttribute("source", htmlspecialchars("$table${row[$table_meta['id']]}", ENT_XML1));
          // $header_field .= ":START_ID({$table}_$col)";
          // $skip_rows_for_empty_field = false;
        } elseif ($col == $table_meta['start_id']) {
          // TODO avoid preg_replace here, fix config data
          $id_space_raw = $table_meta['start_id_space'] ?? $col;
          $id_space = preg_replace('/_id$/', '', $id_space_raw);
          $xml_data->addAttribute("source", htmlspecialchars("$id_space${row[$table_meta['start_id']]}", ENT_XML1));
          // $header_field .= ":START_ID($id_space)";
          // $skip_rows_for_empty_field = true;
        } elseif ($col == $table_meta['end_id']) {
          $id_space_raw = $table_meta['end_id_space'] ?? $col;
          $id_space = preg_replace('/_id$/', '', $id_space_raw);
          $xml_data->addAttribute("target", htmlspecialchars("$id_space${row[$table_meta['end_id']]}", ENT_XML1));
          // $header_field .= ":END_ID($id_space)";
          // $skip_rows_for_empty_field = true;
        }
      }
  
    }
    // return $this->array2xml($type, 'data', $outer);
    $str = '';
    foreach ($xml_root as $elem) {
      $str .= $elem->asXML();
    }
    return str_replace("\n", '&#xA;', $str);
  }

}

abstract class AggregatedTextExporter extends AggregatedExporter {

  protected $list_prefix;
  protected $property_prefix;
  protected $indent;

  function formatRow(array $row, array $data_types, int $level, string $table_key, string $table, array $table_meta): string {
    $levels = array_fill(0, count($row), $level);
    $name = $row['anzeige_name'] ?? $row['name'] ?? $row['id'] ?? 'Item';
    $tableName = $table_meta['display_name'] ?? $table;
    $str = $this->list_prefix . "$name:\n" . implode('', array_map([$this, 'serialize_field'], $row, array_keys($row), $levels));
    return preg_replace('/\n+$/', '', $str);
  }

  protected function cleanField(string $str): string {
    return $str;
  }

  abstract protected function getFieldStr(array $lines, array $indented): string;

  protected function serialize_field($field, string $key, int $level): string {
    $str = '';
    if (is_array($field)) {
      $str .= str_repeat(' ', $level * $this->indent) . $this->property_prefix . "$key:$this->eol";
      foreach ($field as $row) {
        $levels = array_fill(0, count($row), $level + 2);
        $name = $row['anzeige_name'] ?? $row['name'] ?? $row['id'] ?? 'Item';
        // if (isset($row['anzeige_name'])) {
        //   $name = $row['anzeige_name'];
        // } elseif (isset($row['name'])) {
        //   $name = $row['name'];
        // } elseif (isset($row['id'])) {
        //   $name = 'ID ' . $row['id'];
        // }
        $str .= str_repeat(' ', ($level + 1) * $this->indent) . $this->list_prefix . "$name:$this->eol";
        $str .= implode('', array_map([$this, 'serialize_field'], $row, array_keys($row), $levels));
      }
    } else {
      $lines = explode("\n", $this->cleanField(str_replace("\r", '', $field)));
      $indented = array_map(function($line) use ($level) { return str_repeat(' ', ($level + 1) * $this->indent) . $line; }, $lines);
      $str .= str_repeat(' ', $level * $this->indent) . $this->property_prefix . "$key: " . $this->getFieldStr($lines, $indented) . $this->eol;
    }
    return $str;
  }

}

// TODO YAML ids & references
// TODO YAML null
class YamlExporter extends AggregatedTextExporter {
  function __construct() {
    $this->format = 'yaml';
    $this->fileSuffix = 'yaml';
    $this->formatName = 'YAML';
    $this->list_prefix = '- ';
    $this->property_prefix = '';
    $this->indent = 2;
  }

  function getFileHeader(string $transaction_date): array {
    return ['%YAML: 1.1', '---', "# $transaction_date"];
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return ['', ucfirst($table) . ':'];
  }

  protected function getFieldStr(array $lines, array $indented): string {
    switch (count($lines)) {
      case 0: return '';
      case 1: return $lines[0];
      default: return "|" . $this->eol . implode($this->eol, $indented);
    }
  }

}

class MarkdownExporter extends AggregatedTextExporter {
  function __construct() {
    $this->format = 'md';
    $this->fileSuffix = 'md';
    $this->formatName = 'Markdown';
    $this->list_prefix = '* ';
    $this->property_prefix = '* ';
    $this->indent = 4;
 }

  function getFileHeader($transaction_date): array {
    return ['Lobbywatch',
            '=========='];
  }

    /**
   * @return array lines
   */
  function getTableHeader(string $table, array $tableMeta): array {
    return [];
  }

  function getTableListHeader(string $table, array $export_header, array $table_create_lines, array $tableMeta): array {
    return ['', str_repeat('#', 2) . " " . ucfirst($table), ''];
  }

  protected function cleanField(string $str): string {
    return preg_replace('/\n+/', "\n", $str);
  }

  protected function getFieldStr(array $lines, array $indented): string {
    array_shift($indented);
    return $lines[0] . (!empty($indented) ? $this->eol . implode($this->eol, $indented) : '');
  }

}

main();

function main() {
  global $script;
  global $context;
  global $show_sql;
  global $db;
  global $db_connection;
  global $today;
  global $transaction_date;
  global $errors;
  global $verbose;
  global $env;

  print("-- Default $env: {$db_connection['database']}\n");

//     var_dump($argc); //number of arguments passed
//     var_dump($argv); //the arguments passed
  // :  -> mandatory parameter
  // :: -> optional parameter
  $options = getopt('hv::En::c::j::a::x::g::s::p:f::1', ['help','user-prefix:', 'db:', 'sep:', 'eol:', 'qe:']);

//    var_dump($options);

  if (isset($options['v'])) {
    if ($options['v']) {
      $verbose = $options['v'];
    } else {
      $verbose = 1;
    }
     print("-- Verbose level: $verbose\n");
  }

  if (isset($options['n'])) {
    if ($options['n']) {
      $records_limit = $options['n'];
    } else {
      $records_limit = 10;
    }
    print("-- Records limit: $records_limit\n");
  } else {
    $records_limit = null;
  }

  if (isset($options['user-prefix'])) {
    if ($options['user-prefix']) {
      $user_prefix = $options['user-prefix'];
    } else {
      $user_prefix = '';
    }
    print("-- User prefix: $user_prefix\n");
  } else {
    $user_prefix = '';
  }

  if (isset($options['db'])) {
    $db_name = $options['db'];
    print("-- DB index: $db_name\n");
  } else {
    $db_name = null;
  }

  $one_file = $options['1'] ?? false ? 'one_file': 'multi_file';

  if (isset($options['sep'])) {
    $sep = $options['sep'];
  } else {
    $sep = null;
  }

  if (isset($options['eol'])) {
    $eol = $options['eol'];
  } else {
    $eol = "\n";
  }

  if (isset($options['qe'])) {
    $qe = $options['qe'];
  } else {
    $qe = null;
  }

  // if (isset($options['qe'])) {
  //   $qe = $options['qe'];
  // } elseif (isset($options['g'])) {
  //   $qe = '"';
  // } elseif (isset($options['c'])) {
  //   $qe = '"';
  // } elseif (isset($options['s'])) {
  //   $qe = '\\';
  // } else {
  //   $qe = '\\';
  // }

  if (isset($options['p'])) {
    $path = $options['p'];
    print("Path: $path\n");
  } else {
    $path = 'export';
  }

  if (!file_exists($path) && !is_dir($path)) {
    $ret = mkdir($path, 0777, true);
    if ($ret == true)
      echo "directory '$path' created successfully...";
    else
      echo "directory '$path' is not created successfully...";
  }

  get_PDO_lobbywatch_DB_connection($db_name, $user_prefix);
  utils_set_db_session_parameters_exec($db);
  print("-- $env: {$db_connection['database']}\n");

  // TODO refactor program arguments
  if (isset($options['h']) || isset($options['help'])) {
    print("DB export
Parameters:
-g[=SCHEMA]         Export csv for Neo4j graph DB to PATH (default SCHEMA: lobbywatchtest)
-c[=SCHEMA]         Export plain csv to PATH (default SCHEMA: lobbywatchtest)
-j[=SCHEMA]         Export aggregated JSON to PATH (default SCHEMA: lobbywatchtest)
-t[=SCHEMA]         TEST export aggregated JSON to PATH (default SCHEMA: lobbywatchtest)
-x[=SCHEMA]         Export aggregated XML to PATH (default SCHEMA: lobbywatchtest)
-s[=SCHEMA]         Export SQL to PATH (default SCHEMA: lobbywatchtest)
-a[=SCHEMA]         Export csv, csv_neo4j, json, jsonl, xml, sql to PATH (default SCHEMA: lobbywatchtest)
-f[=FILTER]         Filter csv fields, -f filter everything, -f=hist, -f=intern, -f=hist,intern (default: filter nothing)
-p=PATH             Export path (default: export/)
-1                  Export JSON as one file
--sep=SEP           Separator char for columns (default: \\t)
--eol=EOL           End of line (default: \\n)
--qe=QE             Quote escape (default: \")
-n[=NUMBER]         Limit number of records
--user-prefix=USER  Prefix for db user in settings.php (default: reader_)
--db=DB             DB name for settings.php
-v[=LEVEL]          Verbose, optional level, 1 = default
-h, --help          This help
");
  exit(0);
  }

  $filter_hist = false;
  $filter_intern_fields = false;
  if (isset($options['f'])) {
    $f_options = explode(',', $options['f']);
    if (in_array('hist', $f_options)) {
      print("Filter: hist\n");
      $filter_hist = true;
    }
    if (in_array('intern', $f_options)) {
      $filter_intern_fields = true;
      print("Filter: intern\n");
    }

    if (empty($options['f'])) {
      $filter_hist = true;
      $filter_intern_fields = true;
      print("Filter: hist + intern\n");
    }
  }

  if (isset($options['g'])) {
    if ($options['g']) {
      $schema = $options['g'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    // export_csv_for_neo4j($schema, $path, $filter_hist, $filter_intern_fields, $sep, $eol, $qe, $records_limit);
    export(new Neo4jCsvExporter($sep, $qe), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
  }

  if (isset($options['c'])) {
    if ($options['c']) {
      $schema = $options['c'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    // export_csv_plain($schema, $path, $filter_hist, $filter_intern_fields, $sep, $eol, $qe, $records_limit);
    export(new CsvExporter($sep, $qe), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
  }

  if (isset($options['j'])) {
    if ($options['j']) {
      $schema = $options['j'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    // export_structured_aggregated($schema, $path, $filter_hist, $filter_intern_fields, $eol, $format = 'json', $one_file, $records_limit);
    export(new JsonExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
  }

  if (isset($options['a'])) {
    if ($options['a']) {
      $schema = $options['a'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    export(new GraphMLExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new YamlExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new MarkdownExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new SqlExporter($sep, $qe), $schema, $path, $filter_hist, $filter_intern_fields, $eol, true, $records_limit);
    export(new JsonExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new XmlExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new CsvExporter($sep, $qe), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new Neo4jCsvExporter($sep, $qe), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    export(new JsonlExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
    // export($schema, $path, $filter_hist, $filter_intern_fields, $eol, $format = 'yaml', $one_file, $records_limit);
  }

  if (isset($options['x'])) {
    if ($options['x']) {
      $schema = $options['j'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    // export_structured_aggregated($schema, $path, $filter_hist, $filter_intern_fields, $eol, $format = 'xml', $one_file, $records_limit);
    export(new XmlExporter(), $schema, $path, $filter_hist, $filter_intern_fields, $eol, $one_file, $records_limit);
  }

  if (isset($options['s'])) {
    if ($options['s']) {
      $schema = $options['s'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    // export_sql($schema, $path, $filter_hist, $filter_intern_fields, $sep, $eol, $qe, $records_limit);
    export(new SqlExporter($sep, $qe), $schema, $path, $filter_hist, $filter_intern_fields, $eol, true, $records_limit);
  }

  if (count($errors) > 0) {
    echo "\nErrors:\n", implode("\n", $errors), "\n";
    exit(1);
  }

}

// https://neo4j.com/docs/operations-manual/current/tools/import/file-header-format/
// https://neo4j.com/docs/operations-manual/current/tools/import/
// https://neo4j.com/docs/operations-manual/current/tools/import/options/

// neo4j_home$ ls import
// actors-header.csv  actors.csv.zip  movies-header.csv  movies.csv.gz  roles-header.csv  roles.csv.gz
// neo4j_home$ bin/neo4j-admin import --nodes import/movies-header.csv,import/movies.csv.gz --nodes import/actors-header.csv,import/actors.csv.zip --relationships import/roles-header.csv,import/roles.csv.gz

// https://neo4j-contrib.github.io/neo4j-apoc-procedures/#schema
// CALL apoc.meta.graph

// MATCH (n)
// OPTIONAL MATCH (n)-[r]-()
// WITH n,r LIMIT 50000
// DELETE n,r
// RETURN count(n) as deletedNodesCount


// TODO unified export main loop/function?
// TODO add csv?
// TODO add csv_neo4j
// TODO add sql?
// TODO call format specific rows function?
// TODO one big input table with all definitions?
// TODO one big input table with all definitions: format preferences in table?, restrictions/characteristics
// TODO strategy: 1. keep dedicated export functions, 2. extend/enrich structured export function with dedicated functionality


function export(IExportFormat $exporter, $table_schema, $path, $filter_hist = true, $filter_intern_fields = true, $eol = "\n", $storage_type = false, $records_limit = false) {
  global $script;
  global $context;
  global $show_sql;
  global $db;
  global $today;
  global $sql_today;
  global $transaction_date;
  global $sql_transaction_date;
  global $verbose;
  global $data_source;

  global $intern_fields;

  $cmd_args = $exporter->getImportHint();

  $export_tables = [];
  foreach ($data_source as $source => $tables) {
    if (in_array($source, $exporter->getDataSourceKeys())) {
      $mapped_tables = array_map(function($array) use ($source) {
        $array['source'] = $source;
        return $array;
      }, $tables);
      $export_tables = array_merge($export_tables, $mapped_tables);
    }
  }

  if ($exporter->prefersOneFile()) {
    $storage_type = 'one_file';
  }

  // TODO JSONL only multi file
  // Write file header
  if ($storage_type == 'one_file') {
    $export_file_name = "$path/lobbywatch." . $exporter->getFileSuffix();
    $export_file = fopen($export_file_name, 'w');

    // TODO throw exception on default case
    fwrite($export_file, implode($eol, $exporter->getFileHeader($transaction_date)));
  } elseif ($storage_type == 'multi_file') {
    $export_file = null;
  }

  export_tables($exporter, $export_tables, null, 1, $table_schema, $path, $filter_hist, $filter_intern_fields, $eol, 'file', $storage_type, $export_file, $records_limit, $cmd_args);

  // Write file end
  if ($storage_type == 'one_file') {
    fwrite($export_file, implode($eol, $exporter->getFileFooter()));
    fclose($export_file);

    // TODO validate files
    // TODO check result
    $exporter->validate($export_file);
  }

  print(implode(' ', $cmd_args) . "\n\n");
}

function isColOk(string $col, array $table_meta, string $table_name, array $intern_fields, bool $filter_intern_fields) {
  return (!isset($table_meta['select_cols']) || in_array($col, $table_meta['select_cols'])) &&
      (!isset($table_meta['remove_cols']) || !in_array($col, $table_meta['remove_cols'])) &&
      (!isset($table_meta['remove_cols']) || !in_array("$table_name.$col", $table_meta['remove_cols'])) &&
      (!$filter_intern_fields || !in_array($col, $intern_fields))
      || $col == 'id'
      || preg_match('/_id$/', $col)
      || $col == $table_meta['id']
      || (isset($table_meta['id']) && $col == $table_meta['id'] && $table == $table_name)
      || (isset($table_meta['start_id']) && $col == $table_meta['start_id'])
      || (isset($table_meta['end_id']) && $col == $table_meta['end_id']);
}

function getSqlData(string $table_key, array $table_meta, string $table_schema, $stmt_cols, $stmt_join_cols) {
  $table = $table_meta['table'] ?? $table_key;
  $query_table = $table_meta['view'] ?? $table;
  $join = $table_meta['join'] ?? null;
  $join_table = $join ? explode(' ', $join)[1] : null;
  $source = $table_meta['source'] ?? null;

  $stmt_cols->execute(['table_schema' => $table_schema, 'table' => $query_table]);
  $cols = $table_cols = $stmt_cols->fetchAll();
  
  if ($join) {
    $stmt_join_cols->execute(['table_schema' => $table_schema, 'table' => $join_table, 'cols' => implode(', ', array_map(function($str) { return preg_replace('/^([^.]+\.)/', '', $str); }, $table_meta['additional_join_cols']))]);
    $join_cols = $stmt_cols->fetchAll();

    $cols = array_merge($cols, $join_cols);

    // TODO remove additional_join_csv_header_cols
    // if (isset($table_meta['additional_join_cols'])) {
    //   foreach ($table_meta['additional_join_cols'] as $additional_join_col) {
    //     $select_fields[] = $additional_join_col;
    //   }
    // }
    
  }

  return [$table, $query_table, $join, $join_table, $source, $cols];
}

function export_tables(IExportFormat $exporter, array $tables, $parent_id, $level, string $table_schema, ?string $path, bool $filter_hist = true, bool $filter_intern_fields = true, string $eol = "\n", string $format = 'json', string $storage_type, $file, $records_limit = false, array &$cmd_args) {
  global $script;
  global $context;
  global $show_sql;
  global $db;
  global $today;
  global $sql_today;
  global $transaction_date;
  global $sql_transaction_date;
  global $verbose;
  
  global $intern_fields;
  
  $sql = "SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = :table_schema AND table_catalog='def' AND TABLE_NAME = :table ORDER BY ORDINAL_POSITION;";
  print("$sql\n\n");
  $stmt_cols = $db->prepare($sql);
  
  $sql = "SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = :table_schema AND table_catalog='def' AND TABLE_NAME = :table AND COLUMN_NAME IN (:cols) ORDER BY ORDINAL_POSITION;";
  print("$sql\n\n");
  $stmt_join_cols = $db->prepare($sql);

  // Get all attributes
  $all_cols = [];
  foreach ($tables as $table_key => $table_meta) {
    list($table, $query_table, $join, $join_table, $source, $cols) = getSqlData($table_key, $table_meta, $table_schema, $stmt_cols, $stmt_join_cols);

    foreach ($cols as $row) {
      $table_name = $row['TABLE_NAME'];
      $col = $row['COLUMN_NAME'];
      $data_type = $row['DATA_TYPE'];
      
      if (isColOk($col, $table_meta, $table_name, $intern_fields, $filter_intern_fields)) {
        $data_types[] = $data_type;
        $all_cols[] = ['col' => $col, 'source' => $source, 'type' => $data_type, 'table' => $table_name];
      }
    }
  }

  if ($storage_type == 'one_file') {
    $export_file = $file;
    if (!empty($declaration = $exporter->getHeaderDeclaration($all_cols)))
      fwrite($export_file, implode($eol, $declaration) . $eol);
  }
  

  $aggregated_tables_data = [];
  
  $i = 0;
  foreach ($tables as $table_key => $table_meta) {
    // if ($records_limit && $i++ > $records_limit) {
    //   break;
    // }
    // $table = $table_meta['table'] ?? $table_key;
    // $query_table = $table_meta['view'] ?? $table;
    // $join = $table_meta['join'] ?? null;
    // $join_table = $join ? explode(' ', $join)[1] : null;
    // $source = $table_meta['source'] ?? null;
    list($table, $query_table, $join, $join_table, $source, $cols) = getSqlData($table_key, $table_meta, $table_schema, $stmt_cols, $stmt_join_cols);

    // $stmt_cols->execute(['table_schema' => $table_schema, 'table' => $query_table]);
    // $cols = $table_cols = $stmt_cols->fetchAll();
    
    // if ($join) {
    //   $stmt_join_cols->execute(['table_schema' => $table_schema, 'table' => $join_table, 'cols' => implode(', ', array_map(function($str) { return preg_replace('/^([^.]+\.)/', '', $str); }, $table_meta['additional_join_cols']))]);
    //   $join_cols = $stmt_cols->fetchAll();

    //   $cols = array_merge($cols, $join_cols);

    //   // TODO remove additional_join_csv_header_cols
    //   // if (isset($table_meta['additional_join_cols'])) {
    //   //   foreach ($table_meta['additional_join_cols'] as $additional_join_col) {
    //   //     $select_fields[] = $additional_join_col;
    //   //   }
    //   // }
      
    // }
    
    print("$table_schema.$table" . ($join ? " $join" : '') ."\n");
    
    if ($storage_type == 'multi_file') {
      $export_file_name = "$path/${source}_$table_key." . $exporter->getFileSuffix();
      $export_file = fopen($export_file_name, 'w');
      
      // TODO add metadata: export date, DB, structure version
      // TODO JSON lines JSONL format support (http://jsonlines.org/) like CSV
      // TODO add yaml for markdown
      // TODO export YAML (https://yaml.org/, https://www.php.net/manual/en/book.yaml.php, https://github.com/EvilFreelancer/yaml-php)
      // TODO Generate XML Schema from XML file (reverse engineer) (https://www.dotkam.com/2008/05/28/generate-xsd-from-xml/)
      // DONE export TOML → no export
      /*switch ($format) {
        case 'xml': fwrite($export_file, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"); break;
        case 'json': fwrite($export_file, "{\n"); break;
        case 'jsonl': break;
        case 'yaml': fwrite($export_file, "%YAML: 1.1\n"); break;
        case 'markdown': fwrite($export_file, "# Lobbywatch Export\n"); break;
        default: throw new Exception("Unknown format" . $format);
      }*/
      if (!empty($header = $exporter->getFileHeader($transaction_date)))
        fwrite($export_file, implode($eol, $header) . $eol);
    } elseif ($storage_type == 'one_file') {
      $export_file = $file;
    } else {
      $export_file = null;
    }
    
    /*switch ($format) {
      case 'xml': fwrite($export_file, "<${table}_liste>\n"); break;
      case 'json': fwrite($export_file, "\"$table\":[\n"); break;
    }*/
    // TODO onefile fill array
    // TODO memory efficient onefile?

    // TODO SQL cleanup
    if ($exporter instanceof SqlExporter) {
      $sql = "SHOW CREATE TABLE $table";
      print("$sql\n");
      $table_create = $db->query($sql)->fetchColumn(1);
      $table_create_lines = explode("\n", $table_create);
    } else {
      $table_create_lines = [];
    }
    
    $data_types = [];
    $skip_rows_for_empty_field = [];
    $select_fields = [];
    $has_extra_col = $exporter->getExtraCol($table_meta) !== null;
    $export_header = $has_extra_col ? [$exporter->getExtraCol($table_meta)] : [];
    foreach ($cols as $row) {
      $table_name = $row['TABLE_NAME'];
      $col = $row['COLUMN_NAME'];
      $data_type = $row['DATA_TYPE'];
      
      if (isColOk($col, $table_meta, $table_name, $intern_fields, $filter_intern_fields)) {
        $data_types[] = $data_type;
        $select_fields[] = "$table_name.$col";
        // TODO add @ for attribute

        list($header_field, $skip_row_for_empty_field) = $exporter->getHeaderCol($col, $data_type, $table, $table_meta);
        $export_header[] = $header_field; // TODO needed?
        $skip_rows_for_empty_field[] = $skip_row_for_empty_field;
        // print("$header_field\n");
      } else {
        // TODO clean SQL cols
        // Remove cols from create table statement
        print("Clean create: $col\n");
        $table_create_lines = array_filter($table_create_lines, function ($line) use ($col) {return strpos($line, "`$col`") === false;});
        // print_r($table_create_lines);
      }
    }

    // if (isset($table_meta['additional_join_cols']) && isset($table_meta['additional_join_csv_header_cols']) && count($table_meta['additional_join_cols']) === count($table_meta['additional_join_csv_header_cols'])) {
    //   foreach ($table_meta['additional_join_cols'] as $additional_join_col) {
    //     $select_fields[] = $additional_join_col;
    //   }
    //   foreach ($table_meta['additional_join_csv_header_cols'] as $additional_join_col) {
    //     $export_header[] = $additional_join_col;
    //     $skip_rows_for_empty_field[] = true;
    //   }
    // }
    
    $num_cols = $tables[$table]['result']['export_col_count'] = count($select_fields);
    // TODO fix storing
    $tables[$table]['result']['export_cols_array'] = $select_fields;
    $tables[$table]['result']['export_cols_data_types'] = $data_types;
    $tables[$table]['result']['export_header_array'] = $export_header;
    
    if (!in_array($format, ['array', 'attribute_array']) && !empty($header = $exporter->getTableListHeader($table, $export_header, $table_create_lines, $table_meta)))
    fwrite($export_file, implode($eol, $header) . $eol);

    // if ($exporter->hasHeader()) {
    //   $export_header_str = implode($exporter->getSep(), $export_header); print("$export_header_str\n");
    //   fwrite($export_file, "$export_header_str$eol");
    //   $tables[$table]['result']['export_header_str'] = $export_header_str;
    // }
    
    if (count(array_unique($export_header)) < count($export_header)) {
      print("\nERROR: duplicate col names!\n\n");
      exit(1);
    }
    
    // TODO a hack for SQL
    // $table_meta['table_create_lines'] = $table_create_lines;
    // $table_meta['export_header'] = $export_header;

    // if (!in_array($format, ['array', 'attribute_array'])) {
    //   fwrite($export_file, implode($eol, $exporter->getTableHeader($table, $export_header, $table_create_lines, $table_meta)) . $eol);
    // }

    assert(count($select_fields) === count($data_types));
    $rows_data = export_rows($exporter, $parent_id, $db, $select_fields, $has_extra_col, $table_schema, $table_key, $table, $query_table, $join, $table_meta, $data_types, $skip_rows_for_empty_field, $filter_hist, $filter_intern_fields, $eol, $format, $level, $records_limit, $export_file, $cmd_args);
    if (in_array($format, ['array', 'attribute_array'])) {
      $n = count($rows_data);
      $aggregated_tables_data["${table}"] = $rows_data;
    } else {
      $n = $rows_data;
      fwrite($export_file, implode($eol, $exporter->getTableListFooter($table, $table_meta)) . $eol);
    }
    
    // switch ($format) {
    //   /*case 'xml': fwrite($export_file, "</${table}_liste>"); break;
    //   case 'json': fwrite($export_file, "]"); break;
    //   case 'jsonl': break;*/
    //   // TODO generalize
    //   case 'array':
    //   case 'attribute_array': $aggregated_tables_data["${table}"] = $rows_data; break;
    // }
    
    if ($storage_type == 'multi_file') {
      /*switch ($format) {
        case 'xml': fwrite($export_file, ""); break;
        case 'json': fwrite($export_file, "}"); break;
      }*/
      fwrite($export_file, implode($eol, $exporter->getFileFooter()));
      fclose($export_file);

      if ($cmd_arg = $exporter->getImportHintFromTable($export_file_name, $table, $table_meta))
        $cmd_args[] = $cmd_arg;

      // TODO validate files
      $exporter->validate($export_file);
    }
    // TODO fix storing
    $tables[$table]['result']['export_row_count'] = $n;
    print("Exported $n rows having $num_cols cols\n");
    print("\n");
  }
  
  if (in_array($format, ['array', 'attribute_array'])) {
    return $aggregated_tables_data;
  }
}

// TODO $join not as parameter
function export_rows(IExportFormat $exporter, int $parent_id = null, $db, array $select_fields, bool $has_extra_col, string $table_schema, string $table_key, string $table, string $query_table, $join, array $table_meta, array $data_types, array $skip_rows_for_empty_field, $filter_hist, $filter_intern_fields, string $eol = "\n", string $format = 'json', int $level = 1, $records_limit, $export_file, &$cmd_args) {
  global $show_sql;
  global $db;
  global $today;
  global $transaction_date;
  global $verbose;
  
  $num_indicator = 20;
  $show_limit = 3;
  
  $type_col = $table_meta['type_col'] ?? null;
  $hist_filter_join = $table_meta['hist_filter_join'] ?? '';
  $where_id = $table_meta['where_id'] ?? '1';
  
  // TODO prepare stmt for join
  // TODO replace isset($join) ? " $join" : '' with $join ?? ''
  $sql_from = " FROM $table_schema.$query_table" . (isset($join) ? " $join" : '') . ($filter_hist ? " $hist_filter_join" : '') . " WHERE 1 AND " . str_replace(':id', $parent_id, $where_id) . ($filter_hist && $table_meta['hist_field'] ? " AND ($query_table.${table_meta['hist_field']} IS NULL OR $query_table.${table_meta['hist_field']} > NOW())" : '');
  $sql_order = " ORDER BY $query_table.${table_meta['id']};";
  
  $sql = "SELECT COUNT(*)$sql_from";
  print("$sql\n");
  $total_rows = $stmt_export = $db->query($sql)->fetchColumn();
  print("$total_rows\n");
  
  $sql = "SELECT " . implode(', ', $select_fields) . $sql_from . $sql_order;
  print("$sql\n");
  $stmt_export = $db->query($sql);
  
  $rows_data = [];
  $skip_counter = 0;
  $i = 0;
  // TODO fix records_limit for csv, sql, ... loops
  while (($row = $stmt_export->fetch(PDO::FETCH_BOTH)) && ++$i && (!$records_limit || $i < $records_limit)) {
    for ($j = 0, $skip_row = false; $j < count($skip_rows_for_empty_field); $j++) if ($skip_rows_for_empty_field[$j] && is_null($row[$j])) $skip_row = true;
    
    // DONE remove trailing comma for JSON
    /*switch ($format) {
      case 'json': if ($i > 1) fwrite($export_file, ", $eol"); break;
    }*/
    if ($i > 1 && !in_array($format, ['array', 'attribute_array'])) fwrite($export_file, $exporter->getRowSeparator() . $eol);
    
    $id = $row[$table_meta['id']];
    // $row_str = ($type_val ? ($type_col ? str_replace(' ', '_', strtoupper($row[$type_col])) : $type_val) . "$sep" : '') . implode($sep, array_map('escape_json_field', array_filter($row, function ($key) { return !is_numeric($key); }, ARRAY_FILTER_USE_KEY), $data_types, $qes));
    $vals = array_filter($row, function ($key) { return !is_numeric($key); }, ARRAY_FILTER_USE_KEY);
    
    // TODO do no escape _json fields for json, add them
    // TODO set json_decode params
    // $vals = array_map(function ($key, $el, $type) { if ($type == 'json') return json_decode($el, true); else return $el; }, array_keys($vals), $vals, $data_types);
    if ($exporter->isAggregatedFormat()) {
        $j = 0;
        foreach ($vals as $key => $val) {
            if ($data_types[$j++] == 'json') {
                $vals[$key] = json_decode($val, true);
            }
            if (in_array($format, ['xml', 'attribute_array']) && in_array($key, [$table_meta['id'], 'anzeige_name'])) {
                $vals["@$key"] = $val;
            }
        }
      
        $aggregated_tables = $table_meta['aggregated_tables'] ?? null;
        if ($aggregated_tables) {
            $aggregated_data = export_tables($exporter, $aggregated_tables, $id, $level + 1, $table_schema, null, $filter_hist, $filter_intern_fields, $eol, $format == 'xml' ? 'attribute_array' : 'array', $format == 'xml' ? 'attribute_array' : 'array', null, $records_limit, $cmd_args);
            $vals = array_merge($vals, $aggregated_data);
        }
    
        // TODO array_xml and array_json for attribute annotation?
        // TODO for array return, use $format or $storage_type?
        // TODO export markdown
        switch ($format) {
        /*case 'xml': $row_str = str_repeat("\t", $level) . array_to_xml($table, $vals) . $eol; break;
        case 'json': $row_str = json_encode($vals, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); break;*/
        case 'array': $rows_data[] = $vals; $row_str = print_r($vals, true); break;
        case 'attribute_array': $rows_data[] = $vals; $row_str = print_r($vals, true); break;
      }
    }
    $row_str = $exporter->formatRow($vals, $data_types, $level, $table_key, $table, $table_meta);
    
    // $row_str = json_encode($array_filter($row, function ($key) { return !is_numeric($key); }, ARRAY_FILTER_USE_KEY), [JSON_UNESCAPED_UNICODE, JSON_UNESCAPED_SLASHES, JSON_NUMERIC_CHECK]);
    // TODO check skip_row setting
    if ($skip_row) {
      if ($skip_counter++ < 5) print("SKIP $i) $row_str\n");
      continue;
    }
    if ($i < $show_limit) print("$i) $row_str\n");
    if ($i == $show_limit) print(str_repeat('_', $num_indicator) . "\r");
    if ($total_rows > $num_indicator && $i % round($total_rows / $num_indicator) == 0) print('.');
    
    if (!in_array($format, ['array', 'attribute_array'])) {
      fwrite($export_file, $row_str);
    }
  }
  /*switch ($format) {
    case 'json': fwrite($export_file, $eol); break;
  }*/
  
  print("\n");
  
  // TODO return aggregated array here
  if (in_array($format, ['array', 'attribute_array'])) {
    return $rows_data;
  } else {
    return $i;
  }
}
  
// function array_to_xml($data, $file = false) {
//   return array_to_simplexml($data, $file);
// }

/*function array_to_xml($name, $data, $file = false) {
  $xml_root = new SimpleXMLElement("<root/>");
  $xml_data = $xml_root->addChild("$name");

  // function call to convert array to xml
  array_to_xml_obj($name, $data, $xml_data);
  
  //saving generated xml file;
  $str = '';
  foreach ($xml_root as $elem) 
  // $elem = $xml_data;
  {
    if ($file)  {
      $elem->asXML($file);
    } else {
      $str .= $elem->asXML();
    }
  }
  return str_replace("\n", '&#xA;', $str);
}

// https://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
function array_to_xml_obj($name, $data, $xml_data) {
  foreach($data as $key => $value) {
    if (is_numeric($key)){
      // $key = "item$key"; //dealing with <0/>..<n/> issues
      $key = $name;
    }
    if (is_array($value)) {
      $subnode = $xml_data->addChild(isset($value[0]) && is_array($value[0]) ? "${key}_liste" : $key);
      array_to_xml_obj($key, $value, $subnode);
    } elseif (utils_startsWith($key, '@')) {
      // TODO use attributes
      $xml_data->addAttribute(mb_substr("$key", 1), htmlspecialchars("$value", ENT_XML1));
    } else {
      $xml_data->addChild("$key", htmlspecialchars("$value", ENT_XML1));
    }
   }
}*/
