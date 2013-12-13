<?php
// Processed by afterburner.sh



require_once 'components/page.php';
require_once 'components/security/datasource_security_info.php';
require_once 'components/security/security_info.php';
require_once 'components/security/hardcoded_auth.php';
require_once 'components/security/user_grants_manager.php';

// Custom modification: Use $users form settings.php

$usersIds = array('roland' => -1, 'bane' => -1, 'rebecca' => -1, 'otto' => -1, 'thomas' => -1, 'admin' => -1);

$dataSourceRecordPermissions = array();

$grants = array('guest' => 
        array()
    ,
    'roland' => 
        array('kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.branche' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_auftraggeber_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_arbeitet_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglied_von' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglieder' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.parlamentarier_anhang' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_in_kommission_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission.v_in_kommission_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.v_zugangsberechtigung_mandate' => new DataSourceSecurityInfo(false, false, false, false),
        'mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation_beziehung' => new DataSourceSecurityInfo(false, false, false, false),
        'branche' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'partei' => new DataSourceSecurityInfo(false, false, false, false),
        'partei.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'Parlamentarier_photo_fehlt' => new DataSourceSecurityInfo(false, false, false, false),
        'v_last_updated_tables' => new DataSourceSecurityInfo(false, false, false, false),
        'tabellenstand' => new DataSourceSecurityInfo(false, false, false, false))
    ,
    'bane' => 
        array('kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.branche' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_auftraggeber_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_arbeitet_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglied_von' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglieder' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.parlamentarier_anhang' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_in_kommission_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission.v_in_kommission_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.v_zugangsberechtigung_mandate' => new DataSourceSecurityInfo(false, false, false, false),
        'mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation_beziehung' => new DataSourceSecurityInfo(false, false, false, false),
        'branche' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'partei' => new DataSourceSecurityInfo(false, false, false, false),
        'partei.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'Parlamentarier_photo_fehlt' => new DataSourceSecurityInfo(false, false, false, false),
        'v_last_updated_tables' => new DataSourceSecurityInfo(false, false, false, false),
        'tabellenstand' => new DataSourceSecurityInfo(false, false, false, false))
    ,
    'rebecca' => 
        array('kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.branche' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_auftraggeber_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_arbeitet_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglied_von' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglieder' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.parlamentarier_anhang' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_in_kommission_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission.v_in_kommission_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.v_zugangsberechtigung_mandate' => new DataSourceSecurityInfo(false, false, false, false),
        'mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation_beziehung' => new DataSourceSecurityInfo(false, false, false, false),
        'branche' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'partei' => new DataSourceSecurityInfo(false, false, false, false),
        'partei.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'Parlamentarier_photo_fehlt' => new DataSourceSecurityInfo(false, false, false, false),
        'v_last_updated_tables' => new DataSourceSecurityInfo(false, false, false, false),
        'tabellenstand' => new DataSourceSecurityInfo(false, false, false, false))
    ,
    'otto' => 
        array('kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.branche' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_auftraggeber_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_arbeitet_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglied_von' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglieder' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.parlamentarier_anhang' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_in_kommission_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission.v_in_kommission_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.v_zugangsberechtigung_mandate' => new DataSourceSecurityInfo(false, false, false, false),
        'mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation_beziehung' => new DataSourceSecurityInfo(false, false, false, false),
        'branche' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'partei' => new DataSourceSecurityInfo(false, false, false, false),
        'partei.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'Parlamentarier_photo_fehlt' => new DataSourceSecurityInfo(false, false, false, false),
        'v_last_updated_tables' => new DataSourceSecurityInfo(false, false, false, false),
        'tabellenstand' => new DataSourceSecurityInfo(false, false, false, false))
    ,
    'thomas' => 
        array('kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.branche' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_auftraggeber_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_arbeitet_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglied_von' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglieder' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.parlamentarier_anhang' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_in_kommission_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission.v_in_kommission_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.v_zugangsberechtigung_mandate' => new DataSourceSecurityInfo(false, false, false, false),
        'mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation_beziehung' => new DataSourceSecurityInfo(false, false, false, false),
        'branche' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'partei' => new DataSourceSecurityInfo(false, false, false, false),
        'partei.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'Parlamentarier_photo_fehlt' => new DataSourceSecurityInfo(false, false, false, false),
        'v_last_updated_tables' => new DataSourceSecurityInfo(false, false, false, false),
        'tabellenstand' => new DataSourceSecurityInfo(false, false, false, false))
    ,
    'admin' => 
        array('kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'kommission.branche' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_auftraggeber_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_arbeitet_fuer' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglied_von' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_beziehung_mitglieder' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.v_organisation_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.parlamentarier_anhang' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_in_kommission_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_zugangsberechtigung_mit_mandaten' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.v_interessenbindung_liste' => new DataSourceSecurityInfo(false, false, false, false),
        'parlamentarier.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission' => new DataSourceSecurityInfo(false, false, false, false),
        'in_kommission.v_in_kommission_parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessenbindung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'zugangsberechtigung.v_zugangsberechtigung_mandate' => new DataSourceSecurityInfo(false, false, false, false),
        'mandat' => new DataSourceSecurityInfo(false, false, false, false),
        'organisation_beziehung' => new DataSourceSecurityInfo(false, false, false, false),
        'branche' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'branche.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'partei' => new DataSourceSecurityInfo(false, false, false, false),
        'partei.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.organisation' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.parlamentarier' => new DataSourceSecurityInfo(false, false, false, false),
        'interessengruppe.zugangsberechtigung' => new DataSourceSecurityInfo(false, false, false, false),
        'Parlamentarier_photo_fehlt' => new DataSourceSecurityInfo(false, false, false, false),
        'v_last_updated_tables' => new DataSourceSecurityInfo(false, false, false, false),
        'tabellenstand' => new DataSourceSecurityInfo(false, false, false, false))
    );

$appGrants = array('guest' => new DataSourceSecurityInfo(false, false, false, false),
    'roland' => new AdminDataSourceSecurityInfo(),
    'bane' => new AdminDataSourceSecurityInfo(),
    'rebecca' => new DataSourceSecurityInfo(true, true, true, true),
    'otto' => new DataSourceSecurityInfo(true, true, true, true),
    'thomas' => new DataSourceSecurityInfo(true, true, true, true),
    'admin' => new AdminDataSourceSecurityInfo());

$tableCaptions = array('kommission' => 'Kommission',
'kommission.in_kommission' => 'Kommission.Parlamentarier in Kommission',
'kommission.branche' => 'Kommission.Branche',
'organisation' => 'Organisation',
'organisation.v_organisation_parlamentarier_indirekt' => 'Organisation.V Organisation Parlamentarier Indirekt',
'organisation.v_organisation_beziehung_auftraggeber_fuer' => 'Organisation.V Organisation Beziehung Auftraggeber Fuer',
'organisation.v_organisation_beziehung_arbeitet_fuer' => 'Organisation.V Organisation Beziehung Arbeitet Fuer',
'organisation.v_organisation_beziehung_mitglied_von' => 'Organisation.V Organisation Beziehung Mitglied Von',
'organisation.v_organisation_beziehung_mitglieder' => 'Organisation.V Organisation Beziehung Mitglieder',
'organisation.v_organisation_parlamentarier' => 'Organisation.V Organisation Parlamentarier',
'organisation.interessenbindung' => 'Organisation.Interessenbindung',
'organisation.mandat' => 'Organisation.Mandat',
'parlamentarier' => 'Parlamentarier',
'parlamentarier.parlamentarier_anhang' => 'Parlamentarier.Parlamentarier Anhang',
'parlamentarier.v_interessenbindung_liste_indirekt' => 'Parlamentarier.V Interessenbindung Liste Indirekt',
'parlamentarier.v_zugangsberechtigung_mit_mandaten_indirekt' => 'Parlamentarier.V Zugangsberechtigung Mit Mandaten Indirekt',
'parlamentarier.v_in_kommission_liste' => 'Parlamentarier.V In Kommission Liste',
'parlamentarier.v_zugangsberechtigung_mit_mandaten' => 'Parlamentarier.V Zugangsberechtigung Mit Mandaten',
'parlamentarier.v_interessenbindung_liste' => 'Parlamentarier.V Interessenbindung Liste',
'parlamentarier.zugangsberechtigung' => 'Parlamentarier.Zugangsberechtigung',
'in_kommission' => 'In Kommission',
'in_kommission.v_in_kommission_parlamentarier' => 'In Kommission.V In Kommission Parlamentarier',
'interessenbindung' => 'Interessenbindung',
'zugangsberechtigung' => 'Zugangsberechtigung',
'zugangsberechtigung.mandat' => 'Zugangsberechtigung.Mandat',
'zugangsberechtigung.v_zugangsberechtigung_mandate' => 'Zugangsberechtigung.V Zugangsberechtigung Mandate',
'mandat' => 'Mandat',
'organisation_beziehung' => 'Organisation Beziehung',
'branche' => 'Branche',
'branche.interessengruppe' => 'Branche.Interessengruppe',
'branche.organisation' => 'Branche.Organisation',
'partei' => 'Partei',
'partei.parlamentarier' => 'Partei.Parlamentarier',
'interessengruppe' => 'Interessengruppe',
'interessengruppe.organisation' => 'Interessengruppe.Organisation',
'interessengruppe.parlamentarier' => 'Interessengruppe.Parlamentarier',
'interessengruppe.zugangsberechtigung' => 'Interessengruppe.Zugangsberechtigung',
'Parlamentarier_photo_fehlt' => 'Parlamentarier Photo Fehlt',
'v_last_updated_tables' => 'Tabellenstand',
'tabellenstand' => 'Tabellenstand');

function SetUpUserAuthorization()
{
    global $usersIds;
    global $grants;
    global $appGrants;
    global $dataSourceRecordPermissions;
    $userAuthorizationStrategy = new HardCodedUserAuthorization(new HardCodedUserGrantsManager($grants, $appGrants), $usersIds);
    GetApplication()->SetUserAuthorizationStrategy($userAuthorizationStrategy);

GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(
    new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}

function GetIdentityCheckStrategy()
{
    global $users;
    return new SimpleIdentityCheckStrategy($users, 'md5');
}
