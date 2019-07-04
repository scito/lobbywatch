<?php
// Run: /opt/lampp/bin/php -f ws_uid_fetcher.php -- --uid 107810911 --ssl -t
// Run: php -f ws_uid_fetcher.php -- -a --ssl -v1 -n20 -s

/*
# ./deploy.sh -b -B -p
# ./run_local_db_script.sh lobbywatchtest prod_bak/`cat prod_bak/last_dbdump_data.txt`

./db_prod_to_local.sh lobbywatchtest
export SYNC_FILE=sql/ws_uid_sync_`date +"%Y%m%d"`.sql; php -f ws_uid_fetcher.php -- -a --ssl -v1 -s | tee $SYNC_FILE; less $SYNC_FILE
./run_local_db_script.sh lobbywatchtest $SYNC_FILE
./deploy.sh -r -s $SYNC_FILE
./deploy.sh -p -r -s $SYNC_FILE
*/


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

$show_sql = false;

get_PDO_lobbywatch_DB_connection();

$script = array();
$script[] = "-- SQL script sql_migration " . date("d.m.Y");

$errors = array();
$verbose = 0;

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

  print("-- $env: {$db_connection['database']}\n");

//     var_dump($argc); //number of arguments passed
//     var_dump($argv); //the arguments passed
  $options = getopt('hsv::sn::j::u::',array('help'));

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
      $records_limit = 3;
    }
    print("-- Records limit: $records_limit\n");
  } else {
    $records_limit = null;
  }

  if (isset($options['s'])) {
    print("\n-- SQL:\n");
    print(implode("\n", $script));
    print("\n");
  }
  if (isset($options['h']) || isset($options['help'])) {
    print("ws.parlament.ch Fetcher for Lobbywatch.ch.
Parameters:
-j [tableName]      Migrate parlament_intressenbindungen to JSON (default: parlamentarier)
-u [schema]         Migrate unsued users (default: lobbywatchtest)
-n number           Limit number of records
-s                  Output SQL script
-v[level]           Verbose, optional level, 1 = default
-h, --help          This help
");
  exit(0);
  }

  if (isset($options['j'])) {
    if ($options['j']) {
      $table_name = $options['j'];
    } else {
      $table_name = 'parlamentarier';
    }
    print("-- Table name: $table_name\n");
    migrate_parlament_interessenbindungen_to_Json('parlamentarier', $records_limit);
  }

  if (isset($options['u'])) {
    if ($options['u']) {
      $schema = $options['u'];
    } else {
      $schema = 'lobbywatchtest';
    }
    print("-- Schema: $schema\n");

    migrate_unused_user_visa($schema, $records_limit);

  }

  if (count($errors) > 0) {
    echo "\nErrors:\n", implode("\n", $errors), "\n";
    exit(1);
  }

}

function migrate_parlament_interessenbindungen_to_Json($table_name, $records_limit = false) {
  global $script;
  global $context;
  global $show_sql;
  global $db;
  global $today;
  global $sql_today;
  global $transaction_date;
  global $sql_transaction_date;
  global $verbose;

  $script[] = $comment = "\n-- Migrate parlament_interessenbindungen to parlament_interessenbindungen_json $transaction_date";

  $sql = "SELECT id, nachname, parlament_interessenbindungen FROM $table_name ORDER BY id;";
  $stmt = $db->prepare($sql);

  $stmt->execute ( array() );
//   $organisation_list = $stmt->fetchAll(PDO::FETCH_CLASS);
//   $organisation_list = $stmt->fetchAll(PDO::FETCH_CLASS);

//   var_dump($parlamentarier_list_db);

  echo "\n/*\nMigrate parlament_interessenbindungen to parlament_interessenbindungen_json $transaction_date\n";
  print("rows = " . $stmt->rowCount() . "\n");
  print("*/\n\n");

  for ($i = 0; $row = $stmt->fetch(); $i++) {
    if ($records_limit && $i > $records_limit) {
      break;
    }

    $id = $row['id'];
    $db_ib = $row['parlament_interessenbindungen'];
    $raw = $db_ib;
    $raw = preg_replace('%<table.*<tbody>%s', '', $raw);
    $raw = preg_replace('%</tbody>.*</table>%s', '', $raw);
    $raw = preg_replace('%(<tr><td>|</td></tr>)%s', '', $raw);
    $objects = [];
    foreach(explode("\n", $raw) as $line) {
      if (trim($line) == '') continue;
      $vals = explode('</td><td>', $line);
      $assoc = [];
      $assoc['Name'] = $vals[0];
      $assoc['Rechtsform'] = $vals[1];
      $assoc['Gremium'] = $vals[2];
      $assoc['Funktion'] = $vals[3];

      $objects[] = (object) $assoc;
    }
    $json = json_encode($objects);
    // print("$i, ${row['nachname']}\n$db_ib\n$raw\n");
    print("-- $i, ${row['nachname']}, $id\n");
    //print_r($objects);
    if (count($objects) > 0) {
      print("UPDATE $table_name WHERE id=$id SET parlament_interessenbindungen_json='" . escape_string($json) . "';\n");
    }
    print("\n");
  }

}

function migrate_unused_user_visa($table_schema, $records_limit = false) {
  global $script;
  global $context;
  global $show_sql;
  global $db;
  global $today;
  global $sql_today;
  global $transaction_date;
  global $sql_transaction_date;
  global $verbose;

  $replace_user = "intro2";

  $rename_users = ['Dimitri Zu' => 'dimitri'];

  $script[] = $comment = "\n-- Migrate unused user visa $transaction_date";

  $sql = "SELECT TABLE_NAME, COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME like '%_visa' AND table_schema='$table_schema' AND table_catalog='def' AND TABLE_NAME NOT LIKE 'v_%' AND TABLE_NAME NOT LIKE 'mv_%' order by TABLE_NAME, COLUMN_NAME;";
  $stmt = $db->prepare($sql);
  $stmt->execute ( array() );
  $cols = $stmt->fetchAll();

  $sql = "SELECT id, name , nachname, vorname, last_login, last_access, email FROM $table_schema.user order by id;";
  $stmt = $db->prepare($sql);
  $stmt->execute ( array() );
  $users = $stmt->fetchAll();

  $sql = "SELECT user_id, count(*) FROM $table_schema.user_permission group by user_id;";
  $stmt = $db->prepare($sql);
  $stmt->execute ( array() );
  $user_permissions = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
//   print_r($user_permissions);

  echo "\n/*\nMigrate unused user visa  $transaction_date\n";
  print("\n\n");

  $script[] = "\nSET @disable_table_logging = 1;";
  $script[] = "SET @disable_triggers = 1;";

  $count_delete = 0;
  $count_replace = 0;
  $count_rename = 0;
  $i = 0;
  foreach ($users as $row_user) {
    if ($records_limit && $i++ > $records_limit) {
      break;
    }
    $id = $row_user['id'];
    $name = $row_user['name'];

    $clean_script = [];

    print("User $id, $name, ${row_user['nachname']} ${row_user['vorname']}, ${row_user['last_login']}, ${row_user['last_access']}, ${row_user['email']}\n");

    if (array_key_exists($name, $rename_users)) {
      $new_name = $rename_users[$name];
      print("    Rename user from $name to $new_name\n");
    } else {
      $new_name = $replace_user;
    }

    $count_permissions = isset($user_permissions[$id]) ? $user_permissions[$id] : 0;
    print("    # permissions: $count_permissions\n");

    $user_total = 0;
    $user_total_non_log = 0;
    $user_total_recherche = 0;
    foreach ($cols as $row) {
      $table = $row['TABLE_NAME'];
      $col = $row['COLUMN_NAME'];

      $sql = "SELECT count(*) FROM $table_schema.$table WHERE $col='$name';";
//       print("$sql\n");
      $count = $db->query($sql)->fetch()[0];
      $user_total += $count;
      if (! preg_match("/.*_log$/", $table)) {
        $user_total_non_log += $count;
      }
      if (preg_match("/^(interessenbindung|mandat)$/", $table)) {
        $user_total_recherche += $count;
      }
      if ($count > 0) {
        print("    $table.$col: $count\n");
        $clean_script[] = "UPDATE $table SET $col='$new_name', updated_date=updated_date WHERE $col='$name';";
      }
    }
    print("    # active edits: $user_total_non_log\n");
    print("    # recherche: $user_total_recherche\n");

    if (in_array($id, [1, 7, 46, 65])) {
      print("    *** Keep\n");
    } elseif (array_key_exists($name, $rename_users)) {
      $script[] = "\n-- Rename user $id, '$name' to '$new_name'";
      $script = array_merge($script, $clean_script);
      $script[] = "-- Rename user $id, '$name' to '$new_name'\nUPDATE user SET name='$new_name', updated_visa='roland' WHERE ID=$id;";
      $count_rename++;
    } elseif ($user_total == 0) {
      $script[] = "-- Delete $id, $name\nDELETE FROM user_permission WHERE USER_ID=$id; DELETE FROM user WHERE ID=$id;";
      $count_delete++;
    } elseif ($user_total_recherche < 10 && $user_total_non_log < 50) {
      $script[] = "\n-- Replace intro user $id, $name having only $user_total_recherche recherche";
      $script = array_merge($script, $clean_script);
      $script[] = "-- Delete $id, $name\nDELETE FROM user_permission WHERE USER_ID=$id; DELETE FROM user WHERE ID=$id;";
      $count_replace++;
    }
    print("\n");
  }

  $script[] = "\nSET @disable_table_logging = NULL;";
  $script[] = "SET @disable_triggers = NULL;";

  print("*/\n\n");
  print("-- User count: " . count($users) . "\n");
  print("-- Delete count: $count_delete\n");
  print("-- Replace count: $count_replace\n");
  print("-- Rename count: $count_rename\n");
  print("\n" . implode("\n", $script));
  print("\n\n");
}
