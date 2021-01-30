<?php
// Processed by afterburner.sh


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    // OnGlobalBeforePageExecute event handler
    globalOnBeforePageExecute();
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class interessengruppe_interessengruppe_logPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Interessengruppe Log');
            $this->SetMenuLabel('Interessengruppe Log');
    
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`interessengruppe_log`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date'),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date'),
                    new IntegerField('log_id', true, true, true),
                    new StringField('action', true),
                    new StringField('state'),
                    new DateTimeField('action_date', true),
                    new IntegerField('snapshot_id')
                )
            );
            $this->dataset->AddLookupField('branche_id', 'v_branche_simple', new IntegerField('id'), new StringField('anzeige_name', false, false, false, false, 'branche_id_anzeige_name', 'branche_id_anzeige_name_v_branche_simple'), 'branche_id_anzeige_name_v_branche_simple');
            $this->dataset->AddLookupField('snapshot_id', '`snapshot`', new IntegerField('id'), new StringField('beschreibung', false, false, false, false, 'snapshot_id_beschreibung', 'snapshot_id_beschreibung_snapshot'), 'snapshot_id_beschreibung_snapshot');
        }
    
        protected function DoPrepare() {
            globalOnPreparePage($this);
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(12);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator() {
            return setupRSS($this, $this->dataset); /*afterburner*/ 
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'name', 'name', 'Name'),
                new FilterColumn($this->dataset, 'name_fr', 'name_fr', 'Name Fr'),
                new FilterColumn($this->dataset, 'branche_id', 'branche_id_anzeige_name', 'Branche Id'),
                new FilterColumn($this->dataset, 'beschreibung', 'beschreibung', 'Beschreibung'),
                new FilterColumn($this->dataset, 'beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr'),
                new FilterColumn($this->dataset, 'alias_namen', 'alias_namen', 'Alias Namen'),
                new FilterColumn($this->dataset, 'alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr'),
                new FilterColumn($this->dataset, 'isicv4', 'isicv4', 'Isicv4'),
                new FilterColumn($this->dataset, 'wikipedia', 'wikipedia', 'Wikipedia'),
                new FilterColumn($this->dataset, 'wikidata_qid', 'wikidata_qid', 'Wikidata Qid'),
                new FilterColumn($this->dataset, 'notizen', 'notizen', 'Notizen'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum'),
                new FilterColumn($this->dataset, 'kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa'),
                new FilterColumn($this->dataset, 'kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum'),
                new FilterColumn($this->dataset, 'freigabe_visa', 'freigabe_visa', 'Freigabe Visa'),
                new FilterColumn($this->dataset, 'freigabe_datum', 'freigabe_datum', 'Freigabe Datum'),
                new FilterColumn($this->dataset, 'created_visa', 'created_visa', 'Created Visa'),
                new FilterColumn($this->dataset, 'created_date', 'created_date', 'Created Date'),
                new FilterColumn($this->dataset, 'updated_visa', 'updated_visa', 'Updated Visa'),
                new FilterColumn($this->dataset, 'updated_date', 'updated_date', 'Updated Date'),
                new FilterColumn($this->dataset, 'log_id', 'log_id', 'Log Id'),
                new FilterColumn($this->dataset, 'action', 'action', 'Action'),
                new FilterColumn($this->dataset, 'state', 'state', 'State'),
                new FilterColumn($this->dataset, 'action_date', 'action_date', 'Action Date'),
                new FilterColumn($this->dataset, 'snapshot_id', 'snapshot_id_beschreibung', 'Snapshot Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['name_fr'])
                ->addColumn($columns['branche_id'])
                ->addColumn($columns['beschreibung'])
                ->addColumn($columns['beschreibung_fr'])
                ->addColumn($columns['alias_namen'])
                ->addColumn($columns['alias_namen_fr'])
                ->addColumn($columns['isicv4'])
                ->addColumn($columns['wikipedia'])
                ->addColumn($columns['wikidata_qid'])
                ->addColumn($columns['notizen'])
                ->addColumn($columns['eingabe_abgeschlossen_visa'])
                ->addColumn($columns['eingabe_abgeschlossen_datum'])
                ->addColumn($columns['kontrolliert_visa'])
                ->addColumn($columns['kontrolliert_datum'])
                ->addColumn($columns['freigabe_visa'])
                ->addColumn($columns['freigabe_datum'])
                ->addColumn($columns['created_visa'])
                ->addColumn($columns['created_date'])
                ->addColumn($columns['updated_visa'])
                ->addColumn($columns['updated_date'])
                ->addColumn($columns['log_id'])
                ->addColumn($columns['action'])
                ->addColumn($columns['state'])
                ->addColumn($columns['action_date'])
                ->addColumn($columns['snapshot_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('branche_id')
                ->setOptionsFor('eingabe_abgeschlossen_visa')
                ->setOptionsFor('eingabe_abgeschlossen_datum')
                ->setOptionsFor('kontrolliert_visa')
                ->setOptionsFor('kontrolliert_datum')
                ->setOptionsFor('freigabe_visa')
                ->setOptionsFor('freigabe_datum')
                ->setOptionsFor('created_visa')
                ->setOptionsFor('created_date')
                ->setOptionsFor('updated_visa')
                ->setOptionsFor('updated_date')
                ->setOptionsFor('action')
                ->setOptionsFor('action_date')
                ->setOptionsFor('snapshot_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name');
            
            $filterBuilder->addColumn(
                $columns['name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name_fr');
            
            $filterBuilder->addColumn(
                $columns['name_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('branche_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_interessengruppe_log_branche_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('branche_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_interessengruppe_log_branche_id_search');
            
            $filterBuilder->addColumn(
                $columns['branche_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung');
            
            $filterBuilder->addColumn(
                $columns['beschreibung'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung_fr');
            
            $filterBuilder->addColumn(
                $columns['beschreibung_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen');
            
            $filterBuilder->addColumn(
                $columns['alias_namen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen_fr');
            
            $filterBuilder->addColumn(
                $columns['alias_namen_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('isicv4_edit');
            $main_editor->SetMaxLength(25);
            
            $filterBuilder->addColumn(
                $columns['isicv4'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikipedia');
            
            $filterBuilder->addColumn(
                $columns['wikipedia'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikidata_qid_edit');
            $main_editor->SetMaxLength(12);
            
            $filterBuilder->addColumn(
                $columns['wikidata_qid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('notizen');
            
            $filterBuilder->addColumn(
                $columns['notizen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kontrolliert_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('freigabe_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['freigabe_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['freigabe_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('created_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['created_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['created_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('updated_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['updated_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('log_id_edit');
            
            $filterBuilder->addColumn(
                $columns['log_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('action_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('insert', 'insert');
            $main_editor->addChoice('update', 'update');
            $main_editor->addChoice('delete', 'delete');
            $main_editor->addChoice('snapshot', 'snapshot');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('action');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('action');
            
            $filterBuilder->addColumn(
                $columns['action'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('state_edit');
            $main_editor->SetMaxLength(20);
            
            $filterBuilder->addColumn(
                $columns['state'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('action_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['action_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('snapshot_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_interessengruppe_log_snapshot_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('snapshot_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_interessengruppe_log_snapshot_id_search');
            
            $text_editor = new TextEdit('snapshot_id');
            
            $filterBuilder->addColumn(
                $columns['snapshot_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Technischer Schlüssel der Live-Daten');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Bezeichnung der Interessengruppe');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französische Bezeichnung der Interessengruppe');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name', 'Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Branche');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Eingrenzung und Beschreibung zur Interessengruppe');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Eingrenzung und Beschreibung zur Interessengruppe auf französisch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Strichpunkt-getrennte Aufzählung von alternative Namen für die Lobbygruppe; bei der Suche werden für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Strichpunkt-getrennte Aufzählung von alternativen französischen Namen für die Lobbygruppe; bei der Suche werden für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'Isicv4', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('ISICv4-Codes, getrennt durch Leerzeichen. International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 ist ein Einteilungsstandard der UNO, siehe https://unstats.un.org/unsd/publication/SeriesM/seriesm_4rev4e.pdf');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Link zum Wikipedia-Eintrag');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Wikidata Item Q-ID. Wikidata enthält sprachunabhängige Wikipediadaten und stellt eine global gültige ID dar (semantic Web). Die Q-ID wird aufgrund des Wikipedia-Links automatisch gesetzt.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Interne Notizen zu diesem Eintrag. Einträge am besten mit Datum und Visa versehen.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe abgeschlossen hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Die Eingabe ist für den Ersteller der Einträge abgeschlossen und bereit für die Kontrolle. (Leer/NULL bedeutet, dass die Eingabe noch im Gange ist.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe kontrolliert hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Der Eintrag wurde durch eine zweite Person am angegebenen Datum kontrolliert. (Leer/NULL bedeutet noch nicht kontrolliert.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabe von wem? (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabedatum (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Datensatz erstellt von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for log_id field
            //
            $column = new TextViewColumn('log_id', 'log_id', 'Log Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Technischer Log-Schlüssel');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for action field
            //
            $column = new TextViewColumn('action', 'action', 'Action', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Aktionstyp');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Status der Aktion');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for action_date field
            //
            $column = new DateTimeViewColumn('action_date', 'action_date', 'Action Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Datum der Aktion');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('snapshot_id', 'snapshot_id_beschreibung', 'Snapshot Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel zu einem Snapshot');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name', 'Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'Isicv4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for log_id field
            //
            $column = new TextViewColumn('log_id', 'log_id', 'Log Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for action field
            //
            $column = new TextViewColumn('action', 'action', 'Action', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for action_date field
            //
            $column = new DateTimeViewColumn('action_date', 'action_date', 'Action Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('snapshot_id', 'snapshot_id_beschreibung', 'Snapshot Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
    
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name', 'Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'Isicv4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for log_id field
            //
            $column = new TextViewColumn('log_id', 'log_id', 'Log Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for action field
            //
            $column = new TextViewColumn('action', 'action', 'Action', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for action_date field
            //
            $column = new DateTimeViewColumn('action_date', 'action_date', 'Action Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('snapshot_id', 'snapshot_id_beschreibung', 'Snapshot Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name', 'Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'Isicv4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for log_id field
            //
            $column = new TextViewColumn('log_id', 'log_id', 'Log Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for action field
            //
            $column = new TextViewColumn('action', 'action', 'Action', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for action_date field
            //
            $column = new DateTimeViewColumn('action_date', 'action_date', 'Action Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('snapshot_id', 'snapshot_id_beschreibung', 'Snapshot Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name', 'Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'Isicv4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for action field
            //
            $column = new TextViewColumn('action', 'action', 'Action', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for action_date field
            //
            $column = new DateTimeViewColumn('action_date', 'action_date', 'Action Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('snapshot_id', 'snapshot_id_beschreibung', 'Snapshot Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $defaultSortedColumns = array();
            $defaultSortedColumns[] = new SortColumn('log_id', 'DESC');
            $result->setDefaultOrdering($defaultSortedColumns);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowAddMultipleRecords(false);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setIncludeAllFieldsForMultiEditByDefault(false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setShowFormErrorsOnTop(true);
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_interessengruppe_log_branche_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_interessengruppe_log_branche_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_interessengruppe_log_branche_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_interessengruppe_log_branche_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_interessengruppe_log_branche_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`snapshot`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('beschreibung', true),
                    new StringField('notizen'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa', true),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('beschreibung', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_interessengruppe_log_snapshot_id_search', 'id', 'beschreibung', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
            logTableExtendedDrawRow('interessengruppe_log', $rowData, $rowCellStyles, $rowStyles, $rowClasses, $cellClasses);
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class interessengruppe_organisationPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Organisation');
            $this->SetMenuLabel('Organisation');
    
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`organisation`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new IntegerField('in_handelsregister', true),
                    new IntegerField('inaktiv'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('ALT_branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('facebook_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $this->dataset->AddLookupField('interessengruppe_id', 'v_interessengruppe_simple', new IntegerField('id'), new StringField('anzeige_name', false, false, false, false, 'interessengruppe_id_anzeige_name', 'interessengruppe_id_anzeige_name_v_interessengruppe_simple'), 'interessengruppe_id_anzeige_name_v_interessengruppe_simple');
            $this->dataset->AddLookupField('interessengruppe2_id', 'v_interessengruppe_simple', new IntegerField('id'), new StringField('anzeige_name', false, false, false, false, 'interessengruppe2_id_anzeige_name', 'interessengruppe2_id_anzeige_name_v_interessengruppe_simple'), 'interessengruppe2_id_anzeige_name_v_interessengruppe_simple');
            $this->dataset->AddLookupField('interessengruppe3_id', 'v_interessengruppe_simple', new IntegerField('id'), new StringField('anzeige_name', false, false, false, false, 'interessengruppe3_id_anzeige_name', 'interessengruppe3_id_anzeige_name_v_interessengruppe_simple'), 'interessengruppe3_id_anzeige_name_v_interessengruppe_simple');
            $this->dataset->AddLookupField('land_id', 'country', new IntegerField('id'), new StringField('continent', false, false, false, false, 'land_id_continent', 'land_id_continent_country'), 'land_id_continent_country');
            $this->dataset->AddLookupField('interessenraum_id', 'interessenraum', new IntegerField('id'), new StringField('name', false, false, false, false, 'interessenraum_id_name', 'interessenraum_id_name_interessenraum'), 'interessenraum_id_name_interessenraum');
        }
    
        protected function DoPrepare() {
            globalOnPreparePage($this);
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(100);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator() {
            return setupRSS($this, $this->dataset); /*afterburner*/ 
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'name_de', 'name_de', 'Name De'),
                new FilterColumn($this->dataset, 'name_fr', 'name_fr', 'Name Fr'),
                new FilterColumn($this->dataset, 'name_it', 'name_it', 'Name It'),
                new FilterColumn($this->dataset, 'ort', 'ort', 'Ort'),
                new FilterColumn($this->dataset, 'rechtsform', 'rechtsform', 'Rechtsform'),
                new FilterColumn($this->dataset, 'typ', 'typ', 'Typ'),
                new FilterColumn($this->dataset, 'vernehmlassung', 'vernehmlassung', 'Vernehmlassung'),
                new FilterColumn($this->dataset, 'interessengruppe_id', 'interessengruppe_id_anzeige_name', 'Interessengruppe'),
                new FilterColumn($this->dataset, 'interessengruppe2_id', 'interessengruppe2_id_anzeige_name', '2. Interessengruppe'),
                new FilterColumn($this->dataset, 'interessengruppe3_id', 'interessengruppe3_id_anzeige_name', '3. Interessengruppe'),
                new FilterColumn($this->dataset, 'beschreibung', 'beschreibung', 'Beschreibung'),
                new FilterColumn($this->dataset, 'homepage', 'homepage', 'Homepage'),
                new FilterColumn($this->dataset, 'handelsregister_url', 'handelsregister_url', 'Handelsregister Url'),
                new FilterColumn($this->dataset, 'notizen', 'notizen', 'Notizen'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum'),
                new FilterColumn($this->dataset, 'kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa'),
                new FilterColumn($this->dataset, 'kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum'),
                new FilterColumn($this->dataset, 'freigabe_visa', 'freigabe_visa', 'Freigabe Visa'),
                new FilterColumn($this->dataset, 'freigabe_datum', 'freigabe_datum', 'Freigabe Datum'),
                new FilterColumn($this->dataset, 'created_visa', 'created_visa', 'Created Visa'),
                new FilterColumn($this->dataset, 'created_date', 'created_date', 'Created Date'),
                new FilterColumn($this->dataset, 'updated_visa', 'updated_visa', 'Updated Visa'),
                new FilterColumn($this->dataset, 'updated_date', 'updated_date', 'Updated Date'),
                new FilterColumn($this->dataset, 'land_id', 'land_id_continent', 'Land Id'),
                new FilterColumn($this->dataset, 'interessenraum_id', 'interessenraum_id_name', 'Interessenraum Id'),
                new FilterColumn($this->dataset, 'twitter_name', 'twitter_name', 'Twitter Name'),
                new FilterColumn($this->dataset, 'adresse_strasse', 'adresse_strasse', 'Adresse Strasse'),
                new FilterColumn($this->dataset, 'adresse_zusatz', 'adresse_zusatz', 'Adresse Zusatz'),
                new FilterColumn($this->dataset, 'adresse_plz', 'adresse_plz', 'Adresse Plz'),
                new FilterColumn($this->dataset, 'uid', 'uid', 'Uid'),
                new FilterColumn($this->dataset, 'abkuerzung_de', 'abkuerzung_de', 'Abkuerzung De'),
                new FilterColumn($this->dataset, 'alias_namen_de', 'alias_namen_de', 'Alias Namen De'),
                new FilterColumn($this->dataset, 'abkuerzung_fr', 'abkuerzung_fr', 'Abkuerzung Fr'),
                new FilterColumn($this->dataset, 'alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr'),
                new FilterColumn($this->dataset, 'rechtsform_handelsregister', 'rechtsform_handelsregister', 'Rechtsform Handelsregister'),
                new FilterColumn($this->dataset, 'rechtsform_zefix', 'rechtsform_zefix', 'Rechtsform Zefix'),
                new FilterColumn($this->dataset, 'beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr'),
                new FilterColumn($this->dataset, 'abkuerzung_it', 'abkuerzung_it', 'Abkuerzung It'),
                new FilterColumn($this->dataset, 'alias_namen_it', 'alias_namen_it', 'Alias Namen It'),
                new FilterColumn($this->dataset, 'sekretariat', 'sekretariat', 'Sekretariat'),
                new FilterColumn($this->dataset, 'updated_by_import', 'updated_by_import', 'Updated By Import'),
                new FilterColumn($this->dataset, 'ALT_branche_id', 'ALT_branche_id', 'ALT Branche Id'),
                new FilterColumn($this->dataset, 'in_handelsregister', 'in_handelsregister', 'In Handelsregister'),
                new FilterColumn($this->dataset, 'inaktiv', 'inaktiv', 'Inaktiv'),
                new FilterColumn($this->dataset, 'instagram_profil', 'instagram_profil', 'Instagram Profil'),
                new FilterColumn($this->dataset, 'youtube_user', 'youtube_user', 'Youtube User'),
                new FilterColumn($this->dataset, 'facebook_name', 'facebook_name', 'Facebook Name'),
                new FilterColumn($this->dataset, 'wikipedia', 'wikipedia', 'Wikipedia'),
                new FilterColumn($this->dataset, 'wikidata_qid', 'wikidata_qid', 'Wikidata Qid')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['name_de'])
                ->addColumn($columns['name_fr'])
                ->addColumn($columns['name_it'])
                ->addColumn($columns['ort'])
                ->addColumn($columns['rechtsform'])
                ->addColumn($columns['typ'])
                ->addColumn($columns['vernehmlassung'])
                ->addColumn($columns['interessengruppe_id'])
                ->addColumn($columns['interessengruppe2_id'])
                ->addColumn($columns['interessengruppe3_id'])
                ->addColumn($columns['beschreibung'])
                ->addColumn($columns['homepage'])
                ->addColumn($columns['handelsregister_url'])
                ->addColumn($columns['notizen'])
                ->addColumn($columns['eingabe_abgeschlossen_visa'])
                ->addColumn($columns['eingabe_abgeschlossen_datum'])
                ->addColumn($columns['kontrolliert_visa'])
                ->addColumn($columns['kontrolliert_datum'])
                ->addColumn($columns['freigabe_visa'])
                ->addColumn($columns['freigabe_datum'])
                ->addColumn($columns['created_visa'])
                ->addColumn($columns['created_date'])
                ->addColumn($columns['updated_visa'])
                ->addColumn($columns['updated_date'])
                ->addColumn($columns['uid'])
                ->addColumn($columns['abkuerzung_de'])
                ->addColumn($columns['alias_namen_de'])
                ->addColumn($columns['abkuerzung_fr'])
                ->addColumn($columns['alias_namen_fr'])
                ->addColumn($columns['rechtsform_handelsregister'])
                ->addColumn($columns['rechtsform_zefix'])
                ->addColumn($columns['beschreibung_fr'])
                ->addColumn($columns['abkuerzung_it'])
                ->addColumn($columns['alias_namen_it'])
                ->addColumn($columns['sekretariat'])
                ->addColumn($columns['updated_by_import'])
                ->addColumn($columns['ALT_branche_id'])
                ->addColumn($columns['in_handelsregister'])
                ->addColumn($columns['inaktiv'])
                ->addColumn($columns['instagram_profil'])
                ->addColumn($columns['youtube_user'])
                ->addColumn($columns['facebook_name'])
                ->addColumn($columns['wikipedia'])
                ->addColumn($columns['wikidata_qid']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('rechtsform')
                ->setOptionsFor('vernehmlassung')
                ->setOptionsFor('interessengruppe_id')
                ->setOptionsFor('interessengruppe2_id')
                ->setOptionsFor('interessengruppe3_id')
                ->setOptionsFor('eingabe_abgeschlossen_datum')
                ->setOptionsFor('kontrolliert_datum')
                ->setOptionsFor('freigabe_datum')
                ->setOptionsFor('created_date')
                ->setOptionsFor('updated_date')
                ->setOptionsFor('updated_by_import');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name_de');
            
            $filterBuilder->addColumn(
                $columns['name_de'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name_fr');
            
            $filterBuilder->addColumn(
                $columns['name_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name_it');
            
            $filterBuilder->addColumn(
                $columns['name_it'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ort');
            
            $filterBuilder->addColumn(
                $columns['ort'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('rechtsform_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('AG', 'AG');
            $main_editor->addChoice('GmbH', 'GmbH');
            $main_editor->addChoice('Stiftung', 'Stiftung');
            $main_editor->addChoice('Verein', 'Verein');
            $main_editor->addChoice('Informelle Gruppe', 'Informelle Gruppe');
            $main_editor->addChoice('Parlamentarische Gruppe', 'Parlamentarische Gruppe');
            $main_editor->addChoice('Oeffentlich-rechtlich', 'Oeffentlich-rechtlich');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('rechtsform');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('rechtsform');
            
            $filterBuilder->addColumn(
                $columns['rechtsform'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MultiValueSelect('typ');
            $main_editor->addChoice('EinzelOrganisation', 'EinzelOrganisation');
            $main_editor->addChoice('DachOrganisation', 'DachOrganisation');
            $main_editor->addChoice('MitgliedsOrganisation', 'MitgliedsOrganisation');
            $main_editor->addChoice('LeistungsErbringer', 'LeistungsErbringer');
            $main_editor->addChoice('dezidierteLobby', 'dezidierteLobby');
            
            $text_editor = new TextEdit('typ');
            
            $filterBuilder->addColumn(
                $columns['typ'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('vernehmlassung_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('immer', 'immer');
            $main_editor->addChoice('punktuell', 'punktuell');
            $main_editor->addChoice('nie', 'nie');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('vernehmlassung');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('vernehmlassung');
            
            $filterBuilder->addColumn(
                $columns['vernehmlassung'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('interessengruppe_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_organisation_interessengruppe_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('interessengruppe_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_organisation_interessengruppe_id_search');
            
            $text_editor = new TextEdit('interessengruppe_id');
            
            $filterBuilder->addColumn(
                $columns['interessengruppe_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('interessengruppe2_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_organisation_interessengruppe2_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('interessengruppe2_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_organisation_interessengruppe2_id_search');
            
            $text_editor = new TextEdit('interessengruppe2_id');
            
            $filterBuilder->addColumn(
                $columns['interessengruppe2_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('interessengruppe3_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_organisation_interessengruppe3_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('interessengruppe3_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_organisation_interessengruppe3_id_search');
            
            $text_editor = new TextEdit('interessengruppe3_id');
            
            $filterBuilder->addColumn(
                $columns['interessengruppe3_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung');
            
            $filterBuilder->addColumn(
                $columns['beschreibung'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('homepage');
            
            $filterBuilder->addColumn(
                $columns['homepage'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('handelsregister_url');
            
            $filterBuilder->addColumn(
                $columns['handelsregister_url'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('notizen');
            
            $filterBuilder->addColumn(
                $columns['notizen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kontrolliert_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('freigabe_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['freigabe_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['freigabe_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('created_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['created_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['created_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('updated_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['updated_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('uid_edit');
            $main_editor->SetMaxLength(15);
            
            $filterBuilder->addColumn(
                $columns['uid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('abkuerzung_de_edit');
            $main_editor->SetMaxLength(20);
            
            $filterBuilder->addColumn(
                $columns['abkuerzung_de'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen_de');
            
            $filterBuilder->addColumn(
                $columns['alias_namen_de'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('abkuerzung_fr_edit');
            $main_editor->SetMaxLength(20);
            
            $filterBuilder->addColumn(
                $columns['abkuerzung_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen_fr');
            
            $filterBuilder->addColumn(
                $columns['alias_namen_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rechtsform_handelsregister_edit');
            $main_editor->SetMaxLength(4);
            
            $filterBuilder->addColumn(
                $columns['rechtsform_handelsregister'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('rechtsform_zefix_edit');
            
            $filterBuilder->addColumn(
                $columns['rechtsform_zefix'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung_fr');
            
            $filterBuilder->addColumn(
                $columns['beschreibung_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('abkuerzung_it_edit');
            $main_editor->SetMaxLength(20);
            
            $filterBuilder->addColumn(
                $columns['abkuerzung_it'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen_it');
            
            $filterBuilder->addColumn(
                $columns['alias_namen_it'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sekretariat');
            
            $filterBuilder->addColumn(
                $columns['sekretariat'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_by_import_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated_by_import'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alt_branche_id_edit');
            
            $filterBuilder->addColumn(
                $columns['ALT_branche_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('in_handelsregister_edit');
            
            $filterBuilder->addColumn(
                $columns['in_handelsregister'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('inaktiv_edit');
            
            $filterBuilder->addColumn(
                $columns['inaktiv'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('instagram_profil_edit');
            $main_editor->SetMaxLength(30);
            
            $filterBuilder->addColumn(
                $columns['instagram_profil'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('youtube_user_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['youtube_user'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('facebook_name');
            
            $filterBuilder->addColumn(
                $columns['facebook_name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikipedia');
            
            $filterBuilder->addColumn(
                $columns['wikipedia'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikidata_qid_edit');
            $main_editor->SetMaxLength(12);
            
            $filterBuilder->addColumn(
                $columns['wikidata_qid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Technischer Schlüssel der Lobbyorganisation');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('name_de', 'name_de', 'Name De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Name der Organisation. Sollte nur juristischem Namen entsprechen, ohne Zusätze, wie Adresse.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französischer Name');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_it field
            //
            $column = new TextViewColumn('name_it', 'name_it', 'Name It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Italienischer Name');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ort field
            //
            $column = new TextViewColumn('ort', 'ort', 'Ort', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Ort der Organisation');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rechtsform field
            //
            $column = new TextViewColumn('rechtsform', 'rechtsform', 'Rechtsform', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Rechtsform der Organisation');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for typ field
            //
            $column = new TextViewColumn('typ', 'typ', 'Typ', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Typ der Organisation. Beziehungen können über Organisation_Beziehung eingegeben werden.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for vernehmlassung field
            //
            $column = new TextViewColumn('vernehmlassung', 'vernehmlassung', 'Vernehmlassung', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Häufigkeit der Vernehmlassungsteilnahme');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe_id', 'interessengruppe_id_anzeige_name', 'Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Interessengruppe. Über die Interessengruppe wird eine Branche zugeordnet.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe2_id', 'interessengruppe2_id_anzeige_name', '2. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe2_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Interessengruppe. 2. Interessengruppe der Organisation.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe3_id', 'interessengruppe3_id_anzeige_name', '3. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe3_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Interessengruppe. 3. Interessengruppe der Organisation.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Beschreibung der Lobbyorganisation');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Link zur Webseite');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for handelsregister_url field
            //
            $column = new TextViewColumn('handelsregister_url', 'handelsregister_url', 'Handelsregister Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%handelsregister_url%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Link zum Eintrag im Handelsregister');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Interne Notizen zu diesem Eintrag. Einträge am besten mit Datum und Visa versehen.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe abgeschlossen hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Die Eingabe ist für den Ersteller der Einträge abgeschlossen und bereit für die Kontrolle. (Leer/NULL bedeutet, dass die Eingabe noch im Gange ist.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe kontrolliert hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Der Eintrag wurde durch eine zweite Person am angegebenen Datum kontrolliert. (Leer/NULL bedeutet noch nicht kontrolliert.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabe von wem? (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabedatum (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for uid field
            //
            $column = new TextViewColumn('uid', 'uid', 'Uid', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('UID des Handelsregisters; Schweizweit eindeutige ID (http://www.bfs.admin.ch/bfs/portal/de/index/themen/00/05/blank/03/02.html)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung_de field
            //
            $column = new TextViewColumn('abkuerzung_de', 'abkuerzung_de', 'Abkuerzung De', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abkürzung der Organisation, kann in der Anzeige dem Namen nachgestellt werden, z.B. Schweizer Kaderorganisation (SKO)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen_de field
            //
            $column = new TextViewColumn('alias_namen_de', 'alias_namen_de', 'Alias Namen De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Strichpunkt-getrennte Aufzählung von alternative Namen für die Organisation; bei der Suche werden für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung_fr field
            //
            $column = new TextViewColumn('abkuerzung_fr', 'abkuerzung_fr', 'Abkuerzung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französische Abkürzung der Organisation');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französischer Aliasnamen: Strichpunkt-getrennte Aufzählung von alternative Namen für die Organisation; bei der Suche werden für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rechtsform_handelsregister field
            //
            $column = new TextViewColumn('rechtsform_handelsregister', 'rechtsform_handelsregister', 'Rechtsform Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Code der Rechtsform des Handelsregister, z.B. 0106 für AG. Das Feld kann importiert werden.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for rechtsform_zefix field
            //
            $column = new NumberViewColumn('rechtsform_zefix', 'rechtsform_zefix', 'Rechtsform Zefix', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Numerischer Rechtsformcode von Zefix, z.B. 3 für AG. Das Feld kann importiert werden.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französische Beschreibung');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung_it field
            //
            $column = new TextViewColumn('abkuerzung_it', 'abkuerzung_it', 'Abkuerzung It', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Italienische Abkürzung der Organisation');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen_it field
            //
            $column = new TextViewColumn('alias_namen_it', 'alias_namen_it', 'Alias Namen It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Italienischer Aliasnamen: Strichpunkt-getrennte Aufzählung von alternativen Namen für die Organisation; bei der Suche wird für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sekretariat field
            //
            $column = new TextViewColumn('sekretariat', 'sekretariat', 'Sekretariat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Für parlamentarische Gruppen: Ansprechsperson, Adresse, Telephonnummer, usw. des Sekretariats der parlamentarischen Gruppen (wird importiert)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_by_import field
            //
            $column = new DateTimeViewColumn('updated_by_import', 'updated_by_import', 'Updated By Import', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Datum, wann die Organisation durch einen Import zu letzt aktualisiert wurde. Ein Datum bedeutet, dass die Organisation unter der Kontrolle des Importprozesses.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ALT_branche_id field
            //
            $column = new NumberViewColumn('ALT_branche_id', 'ALT_branche_id', 'ALT Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Branche.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for in_handelsregister field
            //
            $column = new NumberViewColumn('in_handelsregister', 'in_handelsregister', 'In Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Ist die Organisation im Handelsregister (Zefix) eingetragen?');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for inaktiv field
            //
            $column = new NumberViewColumn('inaktiv', 'inaktiv', 'Inaktiv', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Gibt es die Organisation noch?');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Instagram Username (Profil)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Youtube Username');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for facebook_name field
            //
            $column = new TextViewColumn('facebook_name', 'facebook_name', 'Facebook Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Facebookname (letzter Teil von Link), wird mit https://www.facebook.com/ zu einem ganzen Link ergänzt');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Link zum Wikipedia-Eintrag');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Wikidata Item Q-ID. Wikidata enthält sprachunabhängige Wikipediadaten und stellt eine global gültige ID dar (semantic Web). Die Q-ID wird aufgrund des Wikipedia-Links automatisch gesetzt.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('name_de', 'name_de', 'Name De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_it field
            //
            $column = new TextViewColumn('name_it', 'name_it', 'Name It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ort field
            //
            $column = new TextViewColumn('ort', 'ort', 'Ort', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rechtsform field
            //
            $column = new TextViewColumn('rechtsform', 'rechtsform', 'Rechtsform', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for typ field
            //
            $column = new TextViewColumn('typ', 'typ', 'Typ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for vernehmlassung field
            //
            $column = new TextViewColumn('vernehmlassung', 'vernehmlassung', 'Vernehmlassung', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe_id', 'interessengruppe_id_anzeige_name', 'Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe2_id', 'interessengruppe2_id_anzeige_name', '2. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe2_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe3_id', 'interessengruppe3_id_anzeige_name', '3. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe3_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for handelsregister_url field
            //
            $column = new TextViewColumn('handelsregister_url', 'handelsregister_url', 'Handelsregister Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%handelsregister_url%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for uid field
            //
            $column = new TextViewColumn('uid', 'uid', 'Uid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung_de field
            //
            $column = new TextViewColumn('abkuerzung_de', 'abkuerzung_de', 'Abkuerzung De', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen_de field
            //
            $column = new TextViewColumn('alias_namen_de', 'alias_namen_de', 'Alias Namen De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung_fr field
            //
            $column = new TextViewColumn('abkuerzung_fr', 'abkuerzung_fr', 'Abkuerzung Fr', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rechtsform_handelsregister field
            //
            $column = new TextViewColumn('rechtsform_handelsregister', 'rechtsform_handelsregister', 'Rechtsform Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for rechtsform_zefix field
            //
            $column = new NumberViewColumn('rechtsform_zefix', 'rechtsform_zefix', 'Rechtsform Zefix', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung_it field
            //
            $column = new TextViewColumn('abkuerzung_it', 'abkuerzung_it', 'Abkuerzung It', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen_it field
            //
            $column = new TextViewColumn('alias_namen_it', 'alias_namen_it', 'Alias Namen It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sekretariat field
            //
            $column = new TextViewColumn('sekretariat', 'sekretariat', 'Sekretariat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_by_import field
            //
            $column = new DateTimeViewColumn('updated_by_import', 'updated_by_import', 'Updated By Import', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ALT_branche_id field
            //
            $column = new NumberViewColumn('ALT_branche_id', 'ALT_branche_id', 'ALT Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for in_handelsregister field
            //
            $column = new NumberViewColumn('in_handelsregister', 'in_handelsregister', 'In Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for inaktiv field
            //
            $column = new NumberViewColumn('inaktiv', 'inaktiv', 'Inaktiv', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for facebook_name field
            //
            $column = new TextViewColumn('facebook_name', 'facebook_name', 'Facebook Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for name_de field
            //
            $editor = new TextAreaEdit('name_de_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name De', 'name_de', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name_fr field
            //
            $editor = new TextAreaEdit('name_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name Fr', 'name_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name_it field
            //
            $editor = new TextAreaEdit('name_it_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name It', 'name_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ort field
            //
            $editor = new TextAreaEdit('ort_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ort', 'ort', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rechtsform field
            //
            $editor = new ComboBox('rechtsform_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('AG', 'AG');
            $editor->addChoice('GmbH', 'GmbH');
            $editor->addChoice('Stiftung', 'Stiftung');
            $editor->addChoice('Verein', 'Verein');
            $editor->addChoice('Informelle Gruppe', 'Informelle Gruppe');
            $editor->addChoice('Parlamentarische Gruppe', 'Parlamentarische Gruppe');
            $editor->addChoice('Oeffentlich-rechtlich', 'Oeffentlich-rechtlich');
            $editColumn = new CustomEditColumn('Rechtsform', 'rechtsform', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for typ field
            //
            $editor = new CheckBoxGroup('typ_edit');
            $editor->SetDisplayMode(CheckBoxGroup::StackedMode);
            $editor->addChoice('EinzelOrganisation', 'EinzelOrganisation');
            $editor->addChoice('DachOrganisation', 'DachOrganisation');
            $editor->addChoice('MitgliedsOrganisation', 'MitgliedsOrganisation');
            $editor->addChoice('LeistungsErbringer', 'LeistungsErbringer');
            $editor->addChoice('dezidierteLobby', 'dezidierteLobby');
            $editColumn = new CustomEditColumn('Typ', 'typ', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for vernehmlassung field
            //
            $editor = new ComboBox('vernehmlassung_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('immer', 'immer');
            $editor->addChoice('punktuell', 'punktuell');
            $editor->addChoice('nie', 'nie');
            $editColumn = new CustomEditColumn('Vernehmlassung', 'vernehmlassung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for interessengruppe_id field
            //
            $editor = new ComboBox('interessengruppe_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Interessengruppe', 
                'interessengruppe_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for interessengruppe2_id field
            //
            $editor = new ComboBox('interessengruppe2_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                '2. Interessengruppe', 
                'interessengruppe2_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for interessengruppe3_id field
            //
            $editor = new ComboBox('interessengruppe3_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                '3. Interessengruppe', 
                'interessengruppe3_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextAreaEdit('beschreibung_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for homepage field
            //
            $editor = new TextAreaEdit('homepage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage', 'homepage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for handelsregister_url field
            //
            $editor = new TextAreaEdit('handelsregister_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Handelsregister Url', 'handelsregister_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for uid field
            //
            $editor = new TextEdit('uid_edit');
            $editor->SetMaxLength(15);
            $editColumn = new CustomEditColumn('Uid', 'uid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for abkuerzung_de field
            //
            $editor = new TextEdit('abkuerzung_de_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung De', 'abkuerzung_de', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_de field
            //
            $editor = new TextAreaEdit('alias_namen_de_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen De', 'alias_namen_de', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for abkuerzung_fr field
            //
            $editor = new TextEdit('abkuerzung_fr_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung Fr', 'abkuerzung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_fr field
            //
            $editor = new TextAreaEdit('alias_namen_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen Fr', 'alias_namen_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rechtsform_handelsregister field
            //
            $editor = new TextEdit('rechtsform_handelsregister_edit');
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Rechtsform Handelsregister', 'rechtsform_handelsregister', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rechtsform_zefix field
            //
            $editor = new TextEdit('rechtsform_zefix_edit');
            $editColumn = new CustomEditColumn('Rechtsform Zefix', 'rechtsform_zefix', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextAreaEdit('beschreibung_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for abkuerzung_it field
            //
            $editor = new TextEdit('abkuerzung_it_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung It', 'abkuerzung_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_it field
            //
            $editor = new TextAreaEdit('alias_namen_it_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen It', 'alias_namen_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sekretariat field
            //
            $editor = new TextAreaEdit('sekretariat_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sekretariat', 'sekretariat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_by_import field
            //
            $editor = new DateTimeEdit('updated_by_import_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated By Import', 'updated_by_import', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ALT_branche_id field
            //
            $editor = new TextEdit('alt_branche_id_edit');
            $editColumn = new CustomEditColumn('ALT Branche Id', 'ALT_branche_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for in_handelsregister field
            //
            $editor = new TextEdit('in_handelsregister_edit');
            $editColumn = new CustomEditColumn('In Handelsregister', 'in_handelsregister', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for inaktiv field
            //
            $editor = new TextEdit('inaktiv_edit');
            $editColumn = new CustomEditColumn('Inaktiv', 'inaktiv', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for instagram_profil field
            //
            $editor = new TextEdit('instagram_profil_edit');
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Instagram Profil', 'instagram_profil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for youtube_user field
            //
            $editor = new TextEdit('youtube_user_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Youtube User', 'youtube_user', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for facebook_name field
            //
            $editor = new TextAreaEdit('facebook_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Facebook Name', 'facebook_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextAreaEdit('wikipedia_edit', 50, 8);
            $editColumn = new CustomEditColumn('Wikipedia', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata Qid', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for ort field
            //
            $editor = new TextAreaEdit('ort_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ort', 'ort', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rechtsform field
            //
            $editor = new ComboBox('rechtsform_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('AG', 'AG');
            $editor->addChoice('GmbH', 'GmbH');
            $editor->addChoice('Stiftung', 'Stiftung');
            $editor->addChoice('Verein', 'Verein');
            $editor->addChoice('Informelle Gruppe', 'Informelle Gruppe');
            $editor->addChoice('Parlamentarische Gruppe', 'Parlamentarische Gruppe');
            $editor->addChoice('Oeffentlich-rechtlich', 'Oeffentlich-rechtlich');
            $editColumn = new CustomEditColumn('Rechtsform', 'rechtsform', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for typ field
            //
            $editor = new CheckBoxGroup('typ_edit');
            $editor->SetDisplayMode(CheckBoxGroup::StackedMode);
            $editor->addChoice('EinzelOrganisation', 'EinzelOrganisation');
            $editor->addChoice('DachOrganisation', 'DachOrganisation');
            $editor->addChoice('MitgliedsOrganisation', 'MitgliedsOrganisation');
            $editor->addChoice('LeistungsErbringer', 'LeistungsErbringer');
            $editor->addChoice('dezidierteLobby', 'dezidierteLobby');
            $editColumn = new CustomEditColumn('Typ', 'typ', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for vernehmlassung field
            //
            $editor = new ComboBox('vernehmlassung_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('immer', 'immer');
            $editor->addChoice('punktuell', 'punktuell');
            $editor->addChoice('nie', 'nie');
            $editColumn = new CustomEditColumn('Vernehmlassung', 'vernehmlassung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for interessengruppe_id field
            //
            $editor = new ComboBox('interessengruppe_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Interessengruppe', 
                'interessengruppe_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for interessengruppe2_id field
            //
            $editor = new ComboBox('interessengruppe2_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                '2. Interessengruppe', 
                'interessengruppe2_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for interessengruppe3_id field
            //
            $editor = new ComboBox('interessengruppe3_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                '3. Interessengruppe', 
                'interessengruppe3_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextAreaEdit('beschreibung_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for homepage field
            //
            $editor = new TextAreaEdit('homepage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage', 'homepage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for handelsregister_url field
            //
            $editor = new TextAreaEdit('handelsregister_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Handelsregister Url', 'handelsregister_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for land_id field
            //
            $editor = new ComboBox('land_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`country`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('continent', true),
                    new StringField('name_en', true),
                    new StringField('official_name_en', true),
                    new StringField('capital_en', true),
                    new StringField('name_de', true),
                    new StringField('official_name_de', true),
                    new StringField('type', true),
                    new StringField('capital_de', true),
                    new StringField('name_fr'),
                    new StringField('official_name_fr'),
                    new StringField('capital_fr'),
                    new StringField('name_it'),
                    new StringField('official_name_it'),
                    new StringField('capital_it'),
                    new StringField('iso2', true),
                    new StringField('iso3', true),
                    new StringField('vehicle_code'),
                    new StringField('ioc', true),
                    new StringField('tld', true),
                    new StringField('currency', true),
                    new StringField('phone', true),
                    new IntegerField('utc', true),
                    new IntegerField('show_level', true),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('continent', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Land Id', 
                'land_id', 
                $editor, 
                $this->dataset, 'id', 'continent', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for interessenraum_id field
            //
            $editor = new ComboBox('interessenraum_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`interessenraum`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new IntegerField('reihenfolge'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Interessenraum Id', 
                'interessenraum_id', 
                $editor, 
                $this->dataset, 'id', 'name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for twitter_name field
            //
            $editor = new TextEdit('twitter_name_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Twitter Name', 'twitter_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_strasse field
            //
            $editor = new TextEdit('adresse_strasse_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Adresse Strasse', 'adresse_strasse', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_zusatz field
            //
            $editor = new TextEdit('adresse_zusatz_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Adresse Zusatz', 'adresse_zusatz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_plz field
            //
            $editor = new TextEdit('adresse_plz_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Adresse Plz', 'adresse_plz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for abkuerzung_de field
            //
            $editor = new TextEdit('abkuerzung_de_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung De', 'abkuerzung_de', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_de field
            //
            $editor = new TextAreaEdit('alias_namen_de_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen De', 'alias_namen_de', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for abkuerzung_fr field
            //
            $editor = new TextEdit('abkuerzung_fr_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung Fr', 'abkuerzung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_fr field
            //
            $editor = new TextAreaEdit('alias_namen_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen Fr', 'alias_namen_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rechtsform_handelsregister field
            //
            $editor = new TextEdit('rechtsform_handelsregister_edit');
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Rechtsform Handelsregister', 'rechtsform_handelsregister', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rechtsform_zefix field
            //
            $editor = new TextEdit('rechtsform_zefix_edit');
            $editColumn = new CustomEditColumn('Rechtsform Zefix', 'rechtsform_zefix', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextAreaEdit('beschreibung_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for abkuerzung_it field
            //
            $editor = new TextEdit('abkuerzung_it_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung It', 'abkuerzung_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_it field
            //
            $editor = new TextAreaEdit('alias_namen_it_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen It', 'alias_namen_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sekretariat field
            //
            $editor = new TextAreaEdit('sekretariat_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sekretariat', 'sekretariat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_by_import field
            //
            $editor = new DateTimeEdit('updated_by_import_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated By Import', 'updated_by_import', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ALT_branche_id field
            //
            $editor = new TextEdit('alt_branche_id_edit');
            $editColumn = new CustomEditColumn('ALT Branche Id', 'ALT_branche_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for in_handelsregister field
            //
            $editor = new TextEdit('in_handelsregister_edit');
            $editColumn = new CustomEditColumn('In Handelsregister', 'in_handelsregister', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for inaktiv field
            //
            $editor = new TextEdit('inaktiv_edit');
            $editColumn = new CustomEditColumn('Inaktiv', 'inaktiv', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for instagram_profil field
            //
            $editor = new TextEdit('instagram_profil_edit');
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Instagram Profil', 'instagram_profil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for youtube_user field
            //
            $editor = new TextEdit('youtube_user_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Youtube User', 'youtube_user', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for facebook_name field
            //
            $editor = new TextAreaEdit('facebook_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Facebook Name', 'facebook_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextAreaEdit('wikipedia_edit', 50, 8);
            $editColumn = new CustomEditColumn('Wikipedia', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata Qid', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for name_de field
            //
            $editor = new TextAreaEdit('name_de_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name De', 'name_de', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name_fr field
            //
            $editor = new TextAreaEdit('name_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name Fr', 'name_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name_it field
            //
            $editor = new TextAreaEdit('name_it_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name It', 'name_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ort field
            //
            $editor = new TextAreaEdit('ort_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ort', 'ort', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rechtsform field
            //
            $editor = new ComboBox('rechtsform_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('AG', 'AG');
            $editor->addChoice('GmbH', 'GmbH');
            $editor->addChoice('Stiftung', 'Stiftung');
            $editor->addChoice('Verein', 'Verein');
            $editor->addChoice('Informelle Gruppe', 'Informelle Gruppe');
            $editor->addChoice('Parlamentarische Gruppe', 'Parlamentarische Gruppe');
            $editor->addChoice('Oeffentlich-rechtlich', 'Oeffentlich-rechtlich');
            $editColumn = new CustomEditColumn('Rechtsform', 'rechtsform', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for typ field
            //
            $editor = new CheckBoxGroup('typ_edit');
            $editor->SetDisplayMode(CheckBoxGroup::StackedMode);
            $editor->addChoice('EinzelOrganisation', 'EinzelOrganisation');
            $editor->addChoice('DachOrganisation', 'DachOrganisation');
            $editor->addChoice('MitgliedsOrganisation', 'MitgliedsOrganisation');
            $editor->addChoice('LeistungsErbringer', 'LeistungsErbringer');
            $editor->addChoice('dezidierteLobby', 'dezidierteLobby');
            $editColumn = new CustomEditColumn('Typ', 'typ', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for vernehmlassung field
            //
            $editor = new ComboBox('vernehmlassung_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('immer', 'immer');
            $editor->addChoice('punktuell', 'punktuell');
            $editor->addChoice('nie', 'nie');
            $editColumn = new CustomEditColumn('Vernehmlassung', 'vernehmlassung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for interessengruppe_id field
            //
            $editor = new ComboBox('interessengruppe_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Interessengruppe', 
                'interessengruppe_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for interessengruppe2_id field
            //
            $editor = new ComboBox('interessengruppe2_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                '2. Interessengruppe', 
                'interessengruppe2_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for interessengruppe3_id field
            //
            $editor = new ComboBox('interessengruppe3_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                '3. Interessengruppe', 
                'interessengruppe3_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextAreaEdit('beschreibung_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for homepage field
            //
            $editor = new TextAreaEdit('homepage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage', 'homepage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for handelsregister_url field
            //
            $editor = new TextAreaEdit('handelsregister_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Handelsregister Url', 'handelsregister_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for uid field
            //
            $editor = new TextEdit('uid_edit');
            $editor->SetMaxLength(15);
            $editColumn = new CustomEditColumn('Uid', 'uid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for abkuerzung_de field
            //
            $editor = new TextEdit('abkuerzung_de_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung De', 'abkuerzung_de', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for alias_namen_de field
            //
            $editor = new TextAreaEdit('alias_namen_de_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen De', 'alias_namen_de', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for abkuerzung_fr field
            //
            $editor = new TextEdit('abkuerzung_fr_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung Fr', 'abkuerzung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for alias_namen_fr field
            //
            $editor = new TextAreaEdit('alias_namen_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen Fr', 'alias_namen_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rechtsform_handelsregister field
            //
            $editor = new TextEdit('rechtsform_handelsregister_edit');
            $editor->SetMaxLength(4);
            $editColumn = new CustomEditColumn('Rechtsform Handelsregister', 'rechtsform_handelsregister', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rechtsform_zefix field
            //
            $editor = new TextEdit('rechtsform_zefix_edit');
            $editColumn = new CustomEditColumn('Rechtsform Zefix', 'rechtsform_zefix', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextAreaEdit('beschreibung_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for abkuerzung_it field
            //
            $editor = new TextEdit('abkuerzung_it_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Abkuerzung It', 'abkuerzung_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for alias_namen_it field
            //
            $editor = new TextAreaEdit('alias_namen_it_edit', 50, 8);
            $editColumn = new CustomEditColumn('Alias Namen It', 'alias_namen_it', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sekretariat field
            //
            $editor = new TextAreaEdit('sekretariat_edit', 50, 8);
            $editColumn = new CustomEditColumn('Sekretariat', 'sekretariat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_by_import field
            //
            $editor = new DateTimeEdit('updated_by_import_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated By Import', 'updated_by_import', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ALT_branche_id field
            //
            $editor = new TextEdit('alt_branche_id_edit');
            $editColumn = new CustomEditColumn('ALT Branche Id', 'ALT_branche_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for in_handelsregister field
            //
            $editor = new TextEdit('in_handelsregister_edit');
            $editColumn = new CustomEditColumn('In Handelsregister', 'in_handelsregister', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for inaktiv field
            //
            $editor = new TextEdit('inaktiv_edit');
            $editColumn = new CustomEditColumn('Inaktiv', 'inaktiv', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for instagram_profil field
            //
            $editor = new TextEdit('instagram_profil_edit');
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Instagram Profil', 'instagram_profil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for youtube_user field
            //
            $editor = new TextEdit('youtube_user_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Youtube User', 'youtube_user', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for facebook_name field
            //
            $editor = new TextAreaEdit('facebook_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Facebook Name', 'facebook_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextAreaEdit('wikipedia_edit', 50, 8);
            $editColumn = new CustomEditColumn('Wikipedia', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata Qid', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('name_de', 'name_de', 'Name De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_it field
            //
            $column = new TextViewColumn('name_it', 'name_it', 'Name It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ort field
            //
            $column = new TextViewColumn('ort', 'ort', 'Ort', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for rechtsform field
            //
            $column = new TextViewColumn('rechtsform', 'rechtsform', 'Rechtsform', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for typ field
            //
            $column = new TextViewColumn('typ', 'typ', 'Typ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for vernehmlassung field
            //
            $column = new TextViewColumn('vernehmlassung', 'vernehmlassung', 'Vernehmlassung', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe_id', 'interessengruppe_id_anzeige_name', 'Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe2_id', 'interessengruppe2_id_anzeige_name', '2. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe2_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe3_id', 'interessengruppe3_id_anzeige_name', '3. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe3_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for handelsregister_url field
            //
            $column = new TextViewColumn('handelsregister_url', 'handelsregister_url', 'Handelsregister Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%handelsregister_url%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for uid field
            //
            $column = new TextViewColumn('uid', 'uid', 'Uid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung_de field
            //
            $column = new TextViewColumn('abkuerzung_de', 'abkuerzung_de', 'Abkuerzung De', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen_de field
            //
            $column = new TextViewColumn('alias_namen_de', 'alias_namen_de', 'Alias Namen De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung_fr field
            //
            $column = new TextViewColumn('abkuerzung_fr', 'abkuerzung_fr', 'Abkuerzung Fr', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for rechtsform_handelsregister field
            //
            $column = new TextViewColumn('rechtsform_handelsregister', 'rechtsform_handelsregister', 'Rechtsform Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for rechtsform_zefix field
            //
            $column = new NumberViewColumn('rechtsform_zefix', 'rechtsform_zefix', 'Rechtsform Zefix', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung_it field
            //
            $column = new TextViewColumn('abkuerzung_it', 'abkuerzung_it', 'Abkuerzung It', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen_it field
            //
            $column = new TextViewColumn('alias_namen_it', 'alias_namen_it', 'Alias Namen It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sekretariat field
            //
            $column = new TextViewColumn('sekretariat', 'sekretariat', 'Sekretariat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_by_import field
            //
            $column = new DateTimeViewColumn('updated_by_import', 'updated_by_import', 'Updated By Import', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ALT_branche_id field
            //
            $column = new NumberViewColumn('ALT_branche_id', 'ALT_branche_id', 'ALT Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for in_handelsregister field
            //
            $column = new NumberViewColumn('in_handelsregister', 'in_handelsregister', 'In Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for inaktiv field
            //
            $column = new NumberViewColumn('inaktiv', 'inaktiv', 'Inaktiv', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for facebook_name field
            //
            $column = new TextViewColumn('facebook_name', 'facebook_name', 'Facebook Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('name_de', 'name_de', 'Name De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_it field
            //
            $column = new TextViewColumn('name_it', 'name_it', 'Name It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ort field
            //
            $column = new TextViewColumn('ort', 'ort', 'Ort', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for rechtsform field
            //
            $column = new TextViewColumn('rechtsform', 'rechtsform', 'Rechtsform', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for typ field
            //
            $column = new TextViewColumn('typ', 'typ', 'Typ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for vernehmlassung field
            //
            $column = new TextViewColumn('vernehmlassung', 'vernehmlassung', 'Vernehmlassung', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe_id', 'interessengruppe_id_anzeige_name', 'Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe2_id', 'interessengruppe2_id_anzeige_name', '2. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe2_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe3_id', 'interessengruppe3_id_anzeige_name', '3. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe3_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for handelsregister_url field
            //
            $column = new TextViewColumn('handelsregister_url', 'handelsregister_url', 'Handelsregister Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%handelsregister_url%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for uid field
            //
            $column = new TextViewColumn('uid', 'uid', 'Uid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung_de field
            //
            $column = new TextViewColumn('abkuerzung_de', 'abkuerzung_de', 'Abkuerzung De', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen_de field
            //
            $column = new TextViewColumn('alias_namen_de', 'alias_namen_de', 'Alias Namen De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung_fr field
            //
            $column = new TextViewColumn('abkuerzung_fr', 'abkuerzung_fr', 'Abkuerzung Fr', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for rechtsform_handelsregister field
            //
            $column = new TextViewColumn('rechtsform_handelsregister', 'rechtsform_handelsregister', 'Rechtsform Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for rechtsform_zefix field
            //
            $column = new NumberViewColumn('rechtsform_zefix', 'rechtsform_zefix', 'Rechtsform Zefix', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung_it field
            //
            $column = new TextViewColumn('abkuerzung_it', 'abkuerzung_it', 'Abkuerzung It', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen_it field
            //
            $column = new TextViewColumn('alias_namen_it', 'alias_namen_it', 'Alias Namen It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for sekretariat field
            //
            $column = new TextViewColumn('sekretariat', 'sekretariat', 'Sekretariat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_by_import field
            //
            $column = new DateTimeViewColumn('updated_by_import', 'updated_by_import', 'Updated By Import', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for ALT_branche_id field
            //
            $column = new NumberViewColumn('ALT_branche_id', 'ALT_branche_id', 'ALT Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for in_handelsregister field
            //
            $column = new NumberViewColumn('in_handelsregister', 'in_handelsregister', 'In Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for inaktiv field
            //
            $column = new NumberViewColumn('inaktiv', 'inaktiv', 'Inaktiv', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for facebook_name field
            //
            $column = new TextViewColumn('facebook_name', 'facebook_name', 'Facebook Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('name_de', 'name_de', 'Name De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name_it field
            //
            $column = new TextViewColumn('name_it', 'name_it', 'Name It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ort field
            //
            $column = new TextViewColumn('ort', 'ort', 'Ort', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for rechtsform field
            //
            $column = new TextViewColumn('rechtsform', 'rechtsform', 'Rechtsform', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for typ field
            //
            $column = new TextViewColumn('typ', 'typ', 'Typ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for vernehmlassung field
            //
            $column = new TextViewColumn('vernehmlassung', 'vernehmlassung', 'Vernehmlassung', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe_id', 'interessengruppe_id_anzeige_name', 'Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe2_id', 'interessengruppe2_id_anzeige_name', '2. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe2_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('interessengruppe3_id', 'interessengruppe3_id_anzeige_name', '3. Interessengruppe', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%interessengruppe3_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for handelsregister_url field
            //
            $column = new TextViewColumn('handelsregister_url', 'handelsregister_url', 'Handelsregister Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%handelsregister_url%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for continent field
            //
            $column = new TextViewColumn('land_id', 'land_id_continent', 'Land Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('interessenraum_id', 'interessenraum_id_name', 'Interessenraum Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for twitter_name field
            //
            $column = new TextViewColumn('twitter_name', 'twitter_name', 'Twitter Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_strasse field
            //
            $column = new TextViewColumn('adresse_strasse', 'adresse_strasse', 'Adresse Strasse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_zusatz field
            //
            $column = new TextViewColumn('adresse_zusatz', 'adresse_zusatz', 'Adresse Zusatz', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_plz field
            //
            $column = new TextViewColumn('adresse_plz', 'adresse_plz', 'Adresse Plz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for uid field
            //
            $column = new TextViewColumn('uid', 'uid', 'Uid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung_de field
            //
            $column = new TextViewColumn('abkuerzung_de', 'abkuerzung_de', 'Abkuerzung De', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen_de field
            //
            $column = new TextViewColumn('alias_namen_de', 'alias_namen_de', 'Alias Namen De', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung_fr field
            //
            $column = new TextViewColumn('abkuerzung_fr', 'abkuerzung_fr', 'Abkuerzung Fr', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for rechtsform_handelsregister field
            //
            $column = new TextViewColumn('rechtsform_handelsregister', 'rechtsform_handelsregister', 'Rechtsform Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for rechtsform_zefix field
            //
            $column = new NumberViewColumn('rechtsform_zefix', 'rechtsform_zefix', 'Rechtsform Zefix', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung_it field
            //
            $column = new TextViewColumn('abkuerzung_it', 'abkuerzung_it', 'Abkuerzung It', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen_it field
            //
            $column = new TextViewColumn('alias_namen_it', 'alias_namen_it', 'Alias Namen It', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sekretariat field
            //
            $column = new TextViewColumn('sekretariat', 'sekretariat', 'Sekretariat', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_by_import field
            //
            $column = new DateTimeViewColumn('updated_by_import', 'updated_by_import', 'Updated By Import', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ALT_branche_id field
            //
            $column = new NumberViewColumn('ALT_branche_id', 'ALT_branche_id', 'ALT Branche Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for in_handelsregister field
            //
            $column = new NumberViewColumn('in_handelsregister', 'in_handelsregister', 'In Handelsregister', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for inaktiv field
            //
            $column = new NumberViewColumn('inaktiv', 'inaktiv', 'Inaktiv', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for facebook_name field
            //
            $column = new TextViewColumn('facebook_name', 'facebook_name', 'Facebook Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe2_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe3_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe3_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe3_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe3_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_organisation_interessengruppe3_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class interessengruppe_parlamentarierPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Parlamentarier');
            $this->SetMenuLabel('Parlamentarier');
    
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`parlamentarier`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nachname', true),
                    new StringField('vorname', true),
                    new StringField('vorname_kurz'),
                    new StringField('zweiter_vorname'),
                    new IntegerField('rat_id', true),
                    new IntegerField('kanton_id', true),
                    new StringField('kommissionen'),
                    new IntegerField('partei_id'),
                    new StringField('parteifunktion', true),
                    new IntegerField('fraktion_id'),
                    new StringField('fraktionsfunktion'),
                    new DateField('im_rat_seit', true),
                    new DateField('im_rat_bis'),
                    new DateField('ratswechsel'),
                    new DateField('ratsunterbruch_von'),
                    new DateField('ratsunterbruch_bis'),
                    new StringField('beruf'),
                    new StringField('beruf_fr'),
                    new IntegerField('beruf_interessengruppe_id'),
                    new StringField('titel'),
                    new StringField('aemter'),
                    new StringField('weitere_aemter'),
                    new StringField('zivilstand'),
                    new IntegerField('anzahl_kinder'),
                    new IntegerField('militaerischer_grad_id'),
                    new StringField('geschlecht'),
                    new DateField('geburtstag'),
                    new StringField('photo'),
                    new StringField('photo_dateiname'),
                    new StringField('photo_dateierweiterung'),
                    new StringField('photo_dateiname_voll'),
                    new StringField('photo_mime_type'),
                    new StringField('kleinbild'),
                    new IntegerField('sitzplatz'),
                    new StringField('email'),
                    new StringField('homepage'),
                    new StringField('homepage_2'),
                    new IntegerField('parlament_biografie_id'),
                    new IntegerField('parlament_number'),
                    new StringField('parlament_beruf_json'),
                    new StringField('parlament_interessenbindungen'),
                    new StringField('parlament_interessenbindungen_json'),
                    new DateTimeField('parlament_interessenbindungen_updated'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('linkedin_profil_url'),
                    new StringField('xing_profil_name'),
                    new StringField('facebook_name'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('sprache'),
                    new StringField('arbeitssprache'),
                    new StringField('adresse_firma'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('adresse_ort'),
                    new StringField('telephon_1'),
                    new StringField('telephon_2'),
                    new StringField('erfasst'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('autorisierung_verschickt_visa'),
                    new DateTimeField('autorisierung_verschickt_datum'),
                    new StringField('autorisiert_visa'),
                    new DateField('autorisiert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $this->dataset->AddLookupField('rat_id', 'rat', new IntegerField('id'), new StringField('abkuerzung', false, false, false, false, 'rat_id_abkuerzung', 'rat_id_abkuerzung_rat'), 'rat_id_abkuerzung_rat');
            $this->dataset->AddLookupField('kanton_id', 'kanton', new IntegerField('id'), new StringField('abkuerzung', false, false, false, false, 'kanton_id_abkuerzung', 'kanton_id_abkuerzung_kanton'), 'kanton_id_abkuerzung_kanton');
            $this->dataset->AddLookupField('partei_id', 'v_partei', new IntegerField('id'), new StringField('abkuerzung', false, false, false, false, 'partei_id_abkuerzung', 'partei_id_abkuerzung_v_partei'), 'partei_id_abkuerzung_v_partei');
            $this->dataset->AddLookupField('fraktion_id', 'v_fraktion', new IntegerField('id'), new StringField('abkuerzung', false, false, false, false, 'fraktion_id_abkuerzung', 'fraktion_id_abkuerzung_v_fraktion'), 'fraktion_id_abkuerzung_v_fraktion');
            $this->dataset->AddLookupField('beruf_interessengruppe_id', 'v_interessengruppe_simple', new IntegerField('id'), new StringField('anzeige_name', false, false, false, false, 'beruf_interessengruppe_id_anzeige_name', 'beruf_interessengruppe_id_anzeige_name_v_interessengruppe_simple'), 'beruf_interessengruppe_id_anzeige_name_v_interessengruppe_simple');
            $this->dataset->AddLookupField('militaerischer_grad_id', 'mil_grad', new IntegerField('id'), new StringField('name', false, false, false, false, 'militaerischer_grad_id_name', 'militaerischer_grad_id_name_mil_grad'), 'militaerischer_grad_id_name_mil_grad');
        }
    
        protected function DoPrepare() {
            globalOnPreparePage($this);
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(100);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator() {
            return setupRSS($this, $this->dataset); /*afterburner*/ 
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'nachname', 'nachname', 'Nachname'),
                new FilterColumn($this->dataset, 'vorname', 'vorname', 'Vorname'),
                new FilterColumn($this->dataset, 'zweiter_vorname', 'zweiter_vorname', 'Zweiter Vorname'),
                new FilterColumn($this->dataset, 'rat_id', 'rat_id_abkuerzung', 'Rat'),
                new FilterColumn($this->dataset, 'kanton_id', 'kanton_id_abkuerzung', 'Kanton'),
                new FilterColumn($this->dataset, 'kommissionen', 'kommissionen', 'Kommissionen'),
                new FilterColumn($this->dataset, 'partei_id', 'partei_id_abkuerzung', 'Partei'),
                new FilterColumn($this->dataset, 'parteifunktion', 'parteifunktion', 'Parteifunktion'),
                new FilterColumn($this->dataset, 'fraktion_id', 'fraktion_id_abkuerzung', 'Fraktion'),
                new FilterColumn($this->dataset, 'fraktionsfunktion', 'fraktionsfunktion', 'Fraktionsfunktion'),
                new FilterColumn($this->dataset, 'im_rat_seit', 'im_rat_seit', 'Im Rat Seit'),
                new FilterColumn($this->dataset, 'im_rat_bis', 'im_rat_bis', 'Im Rat Bis'),
                new FilterColumn($this->dataset, 'ratsunterbruch_von', 'ratsunterbruch_von', 'Ratsunterbruch Von'),
                new FilterColumn($this->dataset, 'ratsunterbruch_bis', 'ratsunterbruch_bis', 'Ratsunterbruch Bis'),
                new FilterColumn($this->dataset, 'beruf', 'beruf', 'Beruf'),
                new FilterColumn($this->dataset, 'beruf_interessengruppe_id', 'beruf_interessengruppe_id_anzeige_name', 'Beruf Interessengruppe Id'),
                new FilterColumn($this->dataset, 'zivilstand', 'zivilstand', 'Zivilstand'),
                new FilterColumn($this->dataset, 'geschlecht', 'geschlecht', 'Geschlecht'),
                new FilterColumn($this->dataset, 'photo', 'photo', 'Photo'),
                new FilterColumn($this->dataset, 'kleinbild', 'kleinbild', 'Kleinbild'),
                new FilterColumn($this->dataset, 'sitzplatz', 'sitzplatz', 'Sitzplatz'),
                new FilterColumn($this->dataset, 'email', 'email', 'Email'),
                new FilterColumn($this->dataset, 'homepage', 'homepage', 'Homepage'),
                new FilterColumn($this->dataset, 'geburtstag', 'geburtstag', 'Geburtstag'),
                new FilterColumn($this->dataset, 'anzahl_kinder', 'anzahl_kinder', 'Anzahl Kinder'),
                new FilterColumn($this->dataset, 'militaerischer_grad_id', 'militaerischer_grad_id_name', 'Militaerischer Grad Id'),
                new FilterColumn($this->dataset, 'parlament_biografie_id', 'parlament_biografie_id', 'Parlament Biografie'),
                new FilterColumn($this->dataset, 'notizen', 'notizen', 'Notizen'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum'),
                new FilterColumn($this->dataset, 'kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa'),
                new FilterColumn($this->dataset, 'kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum'),
                new FilterColumn($this->dataset, 'autorisierung_verschickt_visa', 'autorisierung_verschickt_visa', 'Autorisierung Verschickt Visa'),
                new FilterColumn($this->dataset, 'autorisierung_verschickt_datum', 'autorisierung_verschickt_datum', 'Autorisierung Verschickt Datum'),
                new FilterColumn($this->dataset, 'autorisiert_visa', 'autorisiert_visa', 'Autorisiert Visa'),
                new FilterColumn($this->dataset, 'autorisiert_datum', 'autorisiert_datum', 'Autorisiert Datum'),
                new FilterColumn($this->dataset, 'freigabe_visa', 'freigabe_visa', 'Freigabe Visa'),
                new FilterColumn($this->dataset, 'freigabe_datum', 'freigabe_datum', 'Freigabe Datum'),
                new FilterColumn($this->dataset, 'created_visa', 'created_visa', 'Created Visa'),
                new FilterColumn($this->dataset, 'created_date', 'created_date', 'Created Date'),
                new FilterColumn($this->dataset, 'updated_visa', 'updated_visa', 'Updated Visa'),
                new FilterColumn($this->dataset, 'updated_date', 'updated_date', 'Updated Date'),
                new FilterColumn($this->dataset, 'photo_dateiname', 'photo_dateiname', 'Photo Dateiname'),
                new FilterColumn($this->dataset, 'ratswechsel', 'ratswechsel', 'Ratswechsel'),
                new FilterColumn($this->dataset, 'photo_dateierweiterung', 'photo_dateierweiterung', 'Photo Dateierweiterung'),
                new FilterColumn($this->dataset, 'photo_dateiname_voll', 'photo_dateiname_voll', 'Photo Dateiname Voll'),
                new FilterColumn($this->dataset, 'photo_mime_type', 'photo_mime_type', 'Photo Mime Type'),
                new FilterColumn($this->dataset, 'twitter_name', 'twitter_name', 'Twitter Name'),
                new FilterColumn($this->dataset, 'linkedin_profil_url', 'linkedin_profil_url', 'Linkedin Profil Url'),
                new FilterColumn($this->dataset, 'xing_profil_name', 'xing_profil_name', 'Xing Profil Name'),
                new FilterColumn($this->dataset, 'facebook_name', 'facebook_name', 'Facebook Name'),
                new FilterColumn($this->dataset, 'arbeitssprache', 'arbeitssprache', 'Arbeitssprache'),
                new FilterColumn($this->dataset, 'adresse_firma', 'adresse_firma', 'Adresse Firma'),
                new FilterColumn($this->dataset, 'adresse_strasse', 'adresse_strasse', 'Adresse Strasse'),
                new FilterColumn($this->dataset, 'adresse_zusatz', 'adresse_zusatz', 'Adresse Zusatz'),
                new FilterColumn($this->dataset, 'adresse_plz', 'adresse_plz', 'Adresse Plz'),
                new FilterColumn($this->dataset, 'adresse_ort', 'adresse_ort', 'Adresse Ort'),
                new FilterColumn($this->dataset, 'beruf_fr', 'beruf_fr', 'Beruf Fr'),
                new FilterColumn($this->dataset, 'titel', 'titel', 'Titel'),
                new FilterColumn($this->dataset, 'aemter', 'aemter', 'Aemter'),
                new FilterColumn($this->dataset, 'weitere_aemter', 'weitere_aemter', 'Weitere Aemter'),
                new FilterColumn($this->dataset, 'homepage_2', 'homepage_2', 'Homepage 2'),
                new FilterColumn($this->dataset, 'parlament_number', 'parlament_number', 'Parlament Number'),
                new FilterColumn($this->dataset, 'parlament_interessenbindungen', 'parlament_interessenbindungen', 'Parlament Interessenbindungen'),
                new FilterColumn($this->dataset, 'parlament_interessenbindungen_updated', 'parlament_interessenbindungen_updated', 'Parlament Interessenbindungen Updated'),
                new FilterColumn($this->dataset, 'wikipedia', 'wikipedia', 'Wikipedia'),
                new FilterColumn($this->dataset, 'sprache', 'sprache', 'Sprache'),
                new FilterColumn($this->dataset, 'telephon_1', 'telephon_1', 'Telephon 1'),
                new FilterColumn($this->dataset, 'telephon_2', 'telephon_2', 'Telephon 2'),
                new FilterColumn($this->dataset, 'erfasst', 'erfasst', 'Erfasst'),
                new FilterColumn($this->dataset, 'parlament_interessenbindungen_json', 'parlament_interessenbindungen_json', 'Parlament Interessenbindungen Json'),
                new FilterColumn($this->dataset, 'vorname_kurz', 'vorname_kurz', 'Vorname Kurz'),
                new FilterColumn($this->dataset, 'parlament_beruf_json', 'parlament_beruf_json', 'Parlament Beruf Json'),
                new FilterColumn($this->dataset, 'instagram_profil', 'instagram_profil', 'Instagram Profil'),
                new FilterColumn($this->dataset, 'youtube_user', 'youtube_user', 'Youtube User'),
                new FilterColumn($this->dataset, 'wikidata_qid', 'wikidata_qid', 'Wikidata Qid')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['nachname'])
                ->addColumn($columns['vorname'])
                ->addColumn($columns['zweiter_vorname'])
                ->addColumn($columns['rat_id'])
                ->addColumn($columns['kanton_id'])
                ->addColumn($columns['kommissionen'])
                ->addColumn($columns['partei_id'])
                ->addColumn($columns['parteifunktion'])
                ->addColumn($columns['fraktion_id'])
                ->addColumn($columns['fraktionsfunktion'])
                ->addColumn($columns['im_rat_seit'])
                ->addColumn($columns['im_rat_bis'])
                ->addColumn($columns['ratsunterbruch_von'])
                ->addColumn($columns['ratsunterbruch_bis'])
                ->addColumn($columns['beruf'])
                ->addColumn($columns['beruf_interessengruppe_id'])
                ->addColumn($columns['zivilstand'])
                ->addColumn($columns['geschlecht'])
                ->addColumn($columns['photo'])
                ->addColumn($columns['kleinbild'])
                ->addColumn($columns['sitzplatz'])
                ->addColumn($columns['email'])
                ->addColumn($columns['homepage'])
                ->addColumn($columns['geburtstag'])
                ->addColumn($columns['anzahl_kinder'])
                ->addColumn($columns['militaerischer_grad_id'])
                ->addColumn($columns['parlament_biografie_id'])
                ->addColumn($columns['notizen'])
                ->addColumn($columns['eingabe_abgeschlossen_visa'])
                ->addColumn($columns['eingabe_abgeschlossen_datum'])
                ->addColumn($columns['kontrolliert_visa'])
                ->addColumn($columns['kontrolliert_datum'])
                ->addColumn($columns['autorisierung_verschickt_visa'])
                ->addColumn($columns['autorisierung_verschickt_datum'])
                ->addColumn($columns['autorisiert_visa'])
                ->addColumn($columns['autorisiert_datum'])
                ->addColumn($columns['freigabe_visa'])
                ->addColumn($columns['freigabe_datum'])
                ->addColumn($columns['created_visa'])
                ->addColumn($columns['created_date'])
                ->addColumn($columns['updated_visa'])
                ->addColumn($columns['updated_date'])
                ->addColumn($columns['photo_dateiname'])
                ->addColumn($columns['beruf_fr'])
                ->addColumn($columns['titel'])
                ->addColumn($columns['aemter'])
                ->addColumn($columns['weitere_aemter'])
                ->addColumn($columns['homepage_2'])
                ->addColumn($columns['parlament_number'])
                ->addColumn($columns['parlament_interessenbindungen'])
                ->addColumn($columns['parlament_interessenbindungen_updated'])
                ->addColumn($columns['wikipedia'])
                ->addColumn($columns['sprache'])
                ->addColumn($columns['telephon_1'])
                ->addColumn($columns['telephon_2'])
                ->addColumn($columns['erfasst'])
                ->addColumn($columns['parlament_interessenbindungen_json'])
                ->addColumn($columns['vorname_kurz'])
                ->addColumn($columns['parlament_beruf_json'])
                ->addColumn($columns['instagram_profil'])
                ->addColumn($columns['youtube_user'])
                ->addColumn($columns['wikidata_qid']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('rat_id')
                ->setOptionsFor('kanton_id')
                ->setOptionsFor('partei_id')
                ->setOptionsFor('parteifunktion')
                ->setOptionsFor('fraktion_id')
                ->setOptionsFor('fraktionsfunktion')
                ->setOptionsFor('im_rat_seit')
                ->setOptionsFor('im_rat_bis')
                ->setOptionsFor('ratsunterbruch_von')
                ->setOptionsFor('ratsunterbruch_bis')
                ->setOptionsFor('beruf_interessengruppe_id')
                ->setOptionsFor('zivilstand')
                ->setOptionsFor('geschlecht')
                ->setOptionsFor('geburtstag')
                ->setOptionsFor('militaerischer_grad_id')
                ->setOptionsFor('eingabe_abgeschlossen_datum')
                ->setOptionsFor('kontrolliert_datum')
                ->setOptionsFor('autorisierung_verschickt_datum')
                ->setOptionsFor('autorisiert_datum')
                ->setOptionsFor('freigabe_datum')
                ->setOptionsFor('created_date')
                ->setOptionsFor('updated_date')
                ->setOptionsFor('parlament_interessenbindungen_updated')
                ->setOptionsFor('sprache')
                ->setOptionsFor('erfasst');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nachname_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['nachname'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('vorname_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['vorname'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('zweiter_vorname_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['zweiter_vorname'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('rat_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_rat_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('rat_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_rat_id_search');
            
            $text_editor = new TextEdit('rat_id');
            
            $filterBuilder->addColumn(
                $columns['rat_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('kanton_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_kanton_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('kanton_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_kanton_id_search');
            
            $text_editor = new TextEdit('kanton_id');
            
            $filterBuilder->addColumn(
                $columns['kanton_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kommissionen_edit');
            $main_editor->SetMaxLength(75);
            
            $filterBuilder->addColumn(
                $columns['kommissionen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('partei_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_partei_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('partei_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_partei_id_search');
            
            $text_editor = new TextEdit('partei_id');
            
            $filterBuilder->addColumn(
                $columns['partei_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MultiValueSelect('parteifunktion');
            $main_editor->addChoice('mitglied', 'mitglied');
            $main_editor->addChoice('praesident', 'praesident');
            $main_editor->addChoice('vizepraesident', 'vizepraesident');
            $main_editor->addChoice('fraktionschef', 'fraktionschef');
            
            $text_editor = new TextEdit('parteifunktion');
            
            $filterBuilder->addColumn(
                $columns['parteifunktion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('fraktion_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_fraktion_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('fraktion_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_fraktion_id_search');
            
            $text_editor = new TextEdit('fraktion_id');
            
            $filterBuilder->addColumn(
                $columns['fraktion_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('fraktionsfunktion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('mitglied', 'mitglied');
            $main_editor->addChoice('praesident', 'praesident');
            $main_editor->addChoice('vizepraesident', 'vizepraesident');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('fraktionsfunktion');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('fraktionsfunktion');
            
            $filterBuilder->addColumn(
                $columns['fraktionsfunktion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('im_rat_seit_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['im_rat_seit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('im_rat_bis_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['im_rat_bis'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('ratsunterbruch_von_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['ratsunterbruch_von'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('ratsunterbruch_bis_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['ratsunterbruch_bis'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beruf');
            
            $filterBuilder->addColumn(
                $columns['beruf'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('beruf_interessengruppe_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_beruf_interessengruppe_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('beruf_interessengruppe_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_beruf_interessengruppe_id_search');
            
            $text_editor = new TextEdit('beruf_interessengruppe_id');
            
            $filterBuilder->addColumn(
                $columns['beruf_interessengruppe_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zivilstand_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('ledig', 'ledig');
            $main_editor->addChoice('verheirated', 'verheirated');
            $main_editor->addChoice('geschieden', 'geschieden');
            $main_editor->addChoice('eingetragene partnerschaft', 'eingetragene partnerschaft');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('zivilstand');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('zivilstand');
            
            $filterBuilder->addColumn(
                $columns['zivilstand'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('geschlecht_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('M', 'M');
            $main_editor->addChoice('F', 'F');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('geschlecht');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('geschlecht');
            
            $filterBuilder->addColumn(
                $columns['geschlecht'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('photo_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['photo'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kleinbild_edit');
            $main_editor->SetMaxLength(80);
            
            $filterBuilder->addColumn(
                $columns['kleinbild'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('sitzplatz_edit');
            
            $filterBuilder->addColumn(
                $columns['sitzplatz'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('email_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['email'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('homepage');
            
            $filterBuilder->addColumn(
                $columns['homepage'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('geburtstag_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['geburtstag'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('anzahl_kinder_edit');
            
            $filterBuilder->addColumn(
                $columns['anzahl_kinder'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('militaerischer_grad_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_militaerischer_grad_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('militaerischer_grad_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_parlamentarier_militaerischer_grad_id_search');
            
            $text_editor = new TextEdit('militaerischer_grad_id');
            
            $filterBuilder->addColumn(
                $columns['militaerischer_grad_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('parlament_biografie_id_edit');
            
            $filterBuilder->addColumn(
                $columns['parlament_biografie_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('notizen');
            
            $filterBuilder->addColumn(
                $columns['notizen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kontrolliert_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('autorisierung_verschickt_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['autorisierung_verschickt_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('autorisierung_verschickt_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['autorisierung_verschickt_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('autorisiert_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['autorisiert_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('autorisiert_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['autorisiert_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('freigabe_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['freigabe_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['freigabe_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('created_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['created_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['created_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('updated_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['updated_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('photo_dateiname');
            
            $filterBuilder->addColumn(
                $columns['photo_dateiname'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beruf_fr');
            
            $filterBuilder->addColumn(
                $columns['beruf_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('titel_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['titel'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('aemter');
            
            $filterBuilder->addColumn(
                $columns['aemter'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('weitere_aemter');
            
            $filterBuilder->addColumn(
                $columns['weitere_aemter'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('homepage_2');
            
            $filterBuilder->addColumn(
                $columns['homepage_2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('parlament_number_edit');
            
            $filterBuilder->addColumn(
                $columns['parlament_number'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('parlament_interessenbindungen');
            
            $filterBuilder->addColumn(
                $columns['parlament_interessenbindungen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('parlament_interessenbindungen_updated_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['parlament_interessenbindungen_updated'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikipedia');
            
            $filterBuilder->addColumn(
                $columns['wikipedia'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('sprache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('de', 'de');
            $main_editor->addChoice('fr', 'fr');
            $main_editor->addChoice('it', 'it');
            $main_editor->addChoice('sk', 'sk');
            $main_editor->addChoice('rm', 'rm');
            $main_editor->addChoice('tr', 'tr');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('sprache');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('sprache');
            
            $filterBuilder->addColumn(
                $columns['sprache'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('telephon_1_edit');
            $main_editor->SetMaxLength(25);
            
            $filterBuilder->addColumn(
                $columns['telephon_1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('telephon_2_edit');
            $main_editor->SetMaxLength(25);
            
            $filterBuilder->addColumn(
                $columns['telephon_2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('erfasst_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Ja', 'Ja');
            $main_editor->addChoice('Nein', 'Nein');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('erfasst');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('erfasst');
            
            $filterBuilder->addColumn(
                $columns['erfasst'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('parlament_interessenbindungen_json_edit');
            
            $filterBuilder->addColumn(
                $columns['parlament_interessenbindungen_json'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('vorname_kurz_edit');
            $main_editor->SetMaxLength(15);
            
            $filterBuilder->addColumn(
                $columns['vorname_kurz'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('parlament_beruf_json_edit');
            
            $filterBuilder->addColumn(
                $columns['parlament_beruf_json'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('instagram_profil_edit');
            $main_editor->SetMaxLength(30);
            
            $filterBuilder->addColumn(
                $columns['instagram_profil'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('youtube_user_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['youtube_user'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikidata_qid_edit');
            $main_editor->SetMaxLength(12);
            
            $filterBuilder->addColumn(
                $columns['wikidata_qid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Technischer Schlüssel des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nachname field
            //
            $column = new TextViewColumn('nachname', 'nachname', 'Nachname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Nachname des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for vorname field
            //
            $column = new TextViewColumn('vorname', 'vorname', 'Vorname', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Vornahme des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zweiter_vorname field
            //
            $column = new TextViewColumn('zweiter_vorname', 'zweiter_vorname', 'Zweiter Vorname', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Zweiter Vorname des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('rat_id', 'rat_id_abkuerzung', 'Rat', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Ratszugehörigkeit; Fremdschlüssel des Rates');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('kanton_id', 'kanton_id_abkuerzung', 'Kanton', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kantonszugehörigkeit; Fremdschlüssel des Kantons');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kommissionen field
            //
            $column = new TextViewColumn('kommissionen', 'kommissionen', 'Kommissionen', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abkürzungen der Kommissionen des Parlamentariers (automatisch erzeugt [in_Kommission Trigger])');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('partei_id', 'partei_id_abkuerzung', 'Partei', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Partei. Leer bedeutet parteilos.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parteifunktion field
            //
            $column = new TextViewColumn('parteifunktion', 'parteifunktion', 'Parteifunktion', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Funktion des Parlamentariers in der Partei');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('fraktion_id', 'fraktion_id_abkuerzung', 'Fraktion', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fraktionszugehörigkeit im nationalen Parlament. Fremdschlüssel.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fraktionsfunktion field
            //
            $column = new TextViewColumn('fraktionsfunktion', 'fraktionsfunktion', 'Fraktionsfunktion', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Funktion des Parlamentariers in der Fraktion');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for im_rat_seit field
            //
            $column = new DateTimeViewColumn('im_rat_seit', 'im_rat_seit', 'Im Rat Seit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Jahr der Zugehörigkeit zum Parlament');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for im_rat_bis field
            //
            $column = new DateTimeViewColumn('im_rat_bis', 'im_rat_bis', 'Im Rat Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Austrittsdatum aus dem Parlament. Leer (NULL) = aktuell im Rat, nicht leer = historischer Eintrag');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ratsunterbruch_von field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_von', 'ratsunterbruch_von', 'Ratsunterbruch Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Unterbruch in der Ratstätigkeit von, leer (NULL) = kein Unterbruch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ratsunterbruch_bis field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_bis', 'ratsunterbruch_bis', 'Ratsunterbruch Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Unterbruch in der Ratstätigkeit bis, leer (NULL) = kein Unterbruch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beruf field
            //
            $column = new TextViewColumn('beruf', 'beruf', 'Beruf', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Beruf des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('beruf_interessengruppe_id', 'beruf_interessengruppe_id_anzeige_name', 'Beruf Interessengruppe Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%beruf_interessengruppe_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Zuordnung (Fremdschlüssel) zu Interessengruppe für den Beruf des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zivilstand field
            //
            $column = new TextViewColumn('zivilstand', 'zivilstand', 'Zivilstand', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Zivilstand');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for geschlecht field
            //
            $column = new TextViewColumn('geschlecht', 'geschlecht', 'Geschlecht', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Geschlecht des Parlamentariers, M=Mann, F=Frau');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo field
            //
            $column = new TextViewColumn('photo', 'photo', 'Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Photo des Parlamentariers (JPEG/jpg)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kleinbild field
            //
            $column = new TextViewColumn('kleinbild', 'kleinbild', 'Kleinbild', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Bild 44x62 px oder leer.png');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sitzplatz field
            //
            $column = new TextViewColumn('sitzplatz', 'sitzplatz', 'Sitzplatz', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Sitzplatznr im Parlament. Siehe Sitzordnung auf parlament.ch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('mailto:%email%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('E-Mail-Adresse des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Homepage des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for geburtstag field
            //
            $column = new DateTimeViewColumn('geburtstag', 'geburtstag', 'Geburtstag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Geburtstag des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzahl_kinder field
            //
            $column = new TextViewColumn('anzahl_kinder', 'anzahl_kinder', 'Anzahl Kinder', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Anzahl der Kinder');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('militaerischer_grad_id', 'militaerischer_grad_id_name', 'Militaerischer Grad Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Militärischer Grad, leer (NULL) = kein Militärdienst');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parlament_biografie_id field
            //
            $column = new TextViewColumn('parlament_biografie_id', 'parlament_biografie_id', 'Parlament Biografie', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://www.parlament.ch/d/suche/seiten/biografie.aspx?biografie_id=%parlament_biografie_id%');
            $column->setTarget('_blank');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Biographie ID auf Parlament.ch; Dient zur Herstellung eines Links auf die Parlament.ch Seite des Parlamenteriers. Zudem kann die ID für die automatische Verarbeitung gebraucht werden.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Interne Notizen zu diesem Eintrag. Einträge am besten mit Datum und Visa versehen.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe abgeschlossen hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Die Eingabe ist für den Ersteller der Einträge abgeschlossen und bereit für die Kontrolle. (Leer/NULL bedeutet, dass die Eingabe noch im Gange ist.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe kontrolliert hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Der Eintrag wurde durch eine zweite Person am angegebenen Datum kontrolliert. (Leer/NULL bedeutet noch nicht kontrolliert.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for autorisierung_verschickt_visa field
            //
            $column = new TextViewColumn('autorisierung_verschickt_visa', 'autorisierung_verschickt_visa', 'Autorisierung Verschickt Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Autorisierungsanfrage verschickt durch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for autorisierung_verschickt_datum field
            //
            $column = new DateTimeViewColumn('autorisierung_verschickt_datum', 'autorisierung_verschickt_datum', 'Autorisierung Verschickt Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Autorisierungsanfrage verschickt am. (Leer/NULL bedeutet noch keine Anfrage verschickt.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for autorisiert_visa field
            //
            $column = new TextViewColumn('autorisiert_visa', 'autorisiert_visa', 'Autorisiert Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Autorisiert durch. Sonstige Angaben als Notiz erfassen.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for autorisiert_datum field
            //
            $column = new DateTimeViewColumn('autorisiert_datum', 'autorisiert_datum', 'Autorisiert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Autorisiert am. Leer/NULL bedeutet noch nicht autorisiert. Ein Datum bedeutet, dass die Interessenbindungen und Zutrittsberechtigten vom Parlamentarier autorisiert wurden.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabe von wem? (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabedatum (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo_dateiname field
            //
            $column = new TextViewColumn('photo_dateiname', 'photo_dateiname', 'Photo Dateiname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Photodateiname ohne Erweiterung');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beruf_fr field
            //
            $column = new TextViewColumn('beruf_fr', 'beruf_fr', 'Beruf Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Beruf des Parlamentariers auf französisch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for titel field
            //
            $column = new TextViewColumn('titel', 'titel', 'Titel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Titel des Parlamentariers, wird von ws.parlament.ch importiert');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for aemter field
            //
            $column = new TextViewColumn('aemter', 'aemter', 'Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Politische Ämter (importiert von ws.parlament.ch mandate)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for weitere_aemter field
            //
            $column = new TextViewColumn('weitere_aemter', 'weitere_aemter', 'Weitere Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Zusätzliche Ämter (importiert von ws.parlament.ch additionalMandate)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for homepage_2 field
            //
            $column = new TextViewColumn('homepage_2', 'homepage_2', 'Homepage 2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Zweite Homepage, importiert von ws.parlament.ch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parlament_number field
            //
            $column = new NumberViewColumn('parlament_number', 'parlament_number', 'Parlament Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Number Feld auf ws.parlament.ch, wird von ws.parlament.ch importiert, wird z.B. als ID für Photos verwendet.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parlament_interessenbindungen field
            //
            $column = new TextViewColumn('parlament_interessenbindungen', 'parlament_interessenbindungen', 'Parlament Interessenbindungen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Importierte Interessenbindungen von ws.parlament.ch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parlament_interessenbindungen_updated field
            //
            $column = new DateTimeViewColumn('parlament_interessenbindungen_updated', 'parlament_interessenbindungen_updated', 'Parlament Interessenbindungen Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Datum, wann die Interessenbindungen von ws.parlament.ch zu letzt aktualisiert wurden.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Link zum Wkipedia-Eintrag des Parlamentariers');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sprache field
            //
            $column = new TextViewColumn('sprache', 'sprache', 'Sprache', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Sprache des Parlamentariers, wird von ws.parlament.ch importiert');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for telephon_1 field
            //
            $column = new TextViewColumn('telephon_1', 'telephon_1', 'Telephon 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Telephonnummer 1, z.B. Festnetz');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for telephon_2 field
            //
            $column = new TextViewColumn('telephon_2', 'telephon_2', 'Telephon 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Telephonnummer 2, z.B. Mobiltelephon');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for erfasst field
            //
            $column = new TextViewColumn('erfasst', 'erfasst', 'Erfasst', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Ist der Parlamentarier erfasst? Falls der Parlamentarier beispielsweise nicht mehr zur Wiederwahl antritt und deshalb nicht erfasst wird, kann dieses Feld auf Nein gestellt werden. NULL bedeutet Status unklar.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parlament_interessenbindungen_json field
            //
            $column = new TextViewColumn('parlament_interessenbindungen_json', 'parlament_interessenbindungen_json', 'Parlament Interessenbindungen Json', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Importierte Interessenbindungen von ws.parlament.ch als JSON. Rechtsformen: -, AG, Anst., EG, EidgKomm, Gen., GmbH, KollG, Komm., Körp., Stift., Ve., öffStift; Gremien: -, A, AufR., Bei., D, GL, GL, V, GV, Pat., Sr., V, VR, Vw., ZA, ZV; Funktionen: -, A, AufR., Bei., D, GL, GL, V, GV, Pat., Sr., V, VR, Vw., ZA, ZV');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for vorname_kurz field
            //
            $column = new TextViewColumn('vorname_kurz', 'vorname_kurz', 'Vorname Kurz', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Alltagsvorname oder gebräuchlicher Spitzname, z.B. Nik für Niklaus');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for parlament_beruf_json field
            //
            $column = new TextViewColumn('parlament_beruf_json', 'parlament_beruf_json', 'Parlament Beruf Json', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Importierter Beruf des Parlamentariers: Beruf, Arbeitgeber, Jobtitel/Funktion, von, bis (von parlament.ch)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Instagram Username (Profil)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Youtube Username');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Wikidata Item Q-ID. Wikidata enthält sprachunabhängige Wikipediadaten und stellt eine global gültige ID dar (semantic Web). Die Q-ID wird aufgrund des Wikipedia-Links automatisch gesetzt.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nachname field
            //
            $column = new TextViewColumn('nachname', 'nachname', 'Nachname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for vorname field
            //
            $column = new TextViewColumn('vorname', 'vorname', 'Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zweiter_vorname field
            //
            $column = new TextViewColumn('zweiter_vorname', 'zweiter_vorname', 'Zweiter Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('rat_id', 'rat_id_abkuerzung', 'Rat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('kanton_id', 'kanton_id_abkuerzung', 'Kanton', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kommissionen field
            //
            $column = new TextViewColumn('kommissionen', 'kommissionen', 'Kommissionen', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('partei_id', 'partei_id_abkuerzung', 'Partei', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parteifunktion field
            //
            $column = new TextViewColumn('parteifunktion', 'parteifunktion', 'Parteifunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('fraktion_id', 'fraktion_id_abkuerzung', 'Fraktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fraktionsfunktion field
            //
            $column = new TextViewColumn('fraktionsfunktion', 'fraktionsfunktion', 'Fraktionsfunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for im_rat_seit field
            //
            $column = new DateTimeViewColumn('im_rat_seit', 'im_rat_seit', 'Im Rat Seit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for im_rat_bis field
            //
            $column = new DateTimeViewColumn('im_rat_bis', 'im_rat_bis', 'Im Rat Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ratsunterbruch_von field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_von', 'ratsunterbruch_von', 'Ratsunterbruch Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ratsunterbruch_bis field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_bis', 'ratsunterbruch_bis', 'Ratsunterbruch Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beruf field
            //
            $column = new TextViewColumn('beruf', 'beruf', 'Beruf', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('beruf_interessengruppe_id', 'beruf_interessengruppe_id_anzeige_name', 'Beruf Interessengruppe Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%beruf_interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zivilstand field
            //
            $column = new TextViewColumn('zivilstand', 'zivilstand', 'Zivilstand', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for geschlecht field
            //
            $column = new TextViewColumn('geschlecht', 'geschlecht', 'Geschlecht', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo field
            //
            $column = new TextViewColumn('photo', 'photo', 'Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kleinbild field
            //
            $column = new TextViewColumn('kleinbild', 'kleinbild', 'Kleinbild', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sitzplatz field
            //
            $column = new TextViewColumn('sitzplatz', 'sitzplatz', 'Sitzplatz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('mailto:%email%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for geburtstag field
            //
            $column = new DateTimeViewColumn('geburtstag', 'geburtstag', 'Geburtstag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzahl_kinder field
            //
            $column = new TextViewColumn('anzahl_kinder', 'anzahl_kinder', 'Anzahl Kinder', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('militaerischer_grad_id', 'militaerischer_grad_id_name', 'Militaerischer Grad Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parlament_biografie_id field
            //
            $column = new TextViewColumn('parlament_biografie_id', 'parlament_biografie_id', 'Parlament Biografie', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://www.parlament.ch/d/suche/seiten/biografie.aspx?biografie_id=%parlament_biografie_id%');
            $column->setTarget('_blank');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for autorisierung_verschickt_visa field
            //
            $column = new TextViewColumn('autorisierung_verschickt_visa', 'autorisierung_verschickt_visa', 'Autorisierung Verschickt Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for autorisierung_verschickt_datum field
            //
            $column = new DateTimeViewColumn('autorisierung_verschickt_datum', 'autorisierung_verschickt_datum', 'Autorisierung Verschickt Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for autorisiert_visa field
            //
            $column = new TextViewColumn('autorisiert_visa', 'autorisiert_visa', 'Autorisiert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for autorisiert_datum field
            //
            $column = new DateTimeViewColumn('autorisiert_datum', 'autorisiert_datum', 'Autorisiert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo_dateiname field
            //
            $column = new TextViewColumn('photo_dateiname', 'photo_dateiname', 'Photo Dateiname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beruf_fr field
            //
            $column = new TextViewColumn('beruf_fr', 'beruf_fr', 'Beruf Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for titel field
            //
            $column = new TextViewColumn('titel', 'titel', 'Titel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for aemter field
            //
            $column = new TextViewColumn('aemter', 'aemter', 'Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for weitere_aemter field
            //
            $column = new TextViewColumn('weitere_aemter', 'weitere_aemter', 'Weitere Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for homepage_2 field
            //
            $column = new TextViewColumn('homepage_2', 'homepage_2', 'Homepage 2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parlament_number field
            //
            $column = new NumberViewColumn('parlament_number', 'parlament_number', 'Parlament Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parlament_interessenbindungen field
            //
            $column = new TextViewColumn('parlament_interessenbindungen', 'parlament_interessenbindungen', 'Parlament Interessenbindungen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parlament_interessenbindungen_updated field
            //
            $column = new DateTimeViewColumn('parlament_interessenbindungen_updated', 'parlament_interessenbindungen_updated', 'Parlament Interessenbindungen Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sprache field
            //
            $column = new TextViewColumn('sprache', 'sprache', 'Sprache', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for telephon_1 field
            //
            $column = new TextViewColumn('telephon_1', 'telephon_1', 'Telephon 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for telephon_2 field
            //
            $column = new TextViewColumn('telephon_2', 'telephon_2', 'Telephon 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for erfasst field
            //
            $column = new TextViewColumn('erfasst', 'erfasst', 'Erfasst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parlament_interessenbindungen_json field
            //
            $column = new TextViewColumn('parlament_interessenbindungen_json', 'parlament_interessenbindungen_json', 'Parlament Interessenbindungen Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for vorname_kurz field
            //
            $column = new TextViewColumn('vorname_kurz', 'vorname_kurz', 'Vorname Kurz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for parlament_beruf_json field
            //
            $column = new TextViewColumn('parlament_beruf_json', 'parlament_beruf_json', 'Parlament Beruf Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for nachname field
            //
            $editor = new TextEdit('nachname_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nachname', 'nachname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for vorname field
            //
            $editor = new TextEdit('vorname_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Vorname', 'vorname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zweiter_vorname field
            //
            $editor = new TextEdit('zweiter_vorname_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zweiter Vorname', 'zweiter_vorname', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for rat_id field
            //
            $editor = new ComboBox('rat_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`rat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('name_en'),
                    new IntegerField('anzahl_mitglieder'),
                    new StringField('typ', true),
                    new IntegerField('interessenraum_id'),
                    new IntegerField('anzeigestufe', true),
                    new IntegerField('gewicht', true),
                    new StringField('beschreibung'),
                    new StringField('homepage_de'),
                    new StringField('homepage_fr'),
                    new StringField('homepage_it'),
                    new StringField('homepage_en'),
                    new StringField('mitglied_bezeichnung_maennlich_de', true),
                    new StringField('mitglied_bezeichnung_weiblich_de', true),
                    new StringField('mitglied_bezeichnung_maennlich_fr', true),
                    new StringField('mitglied_bezeichnung_weiblich_fr', true),
                    new IntegerField('parlament_id', true),
                    new StringField('parlament_type'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Rat', 
                'rat_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kanton_id field
            //
            $editor = new ComboBox('kanton_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`kanton`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new IntegerField('kantonsnr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr', true),
                    new StringField('name_it', true),
                    new IntegerField('romandie', true),
                    new IntegerField('anzahl_staenderaete', true),
                    new StringField('amtssprache', true),
                    new StringField('hauptort_de', true),
                    new StringField('hauptort_fr'),
                    new StringField('hauptort_it'),
                    new IntegerField('flaeche_km2', true),
                    new IntegerField('beitrittsjahr', true),
                    new StringField('wappen_svg', true),
                    new StringField('wappen_svg_pfad', true),
                    new StringField('wappen_klein', true),
                    new StringField('wappen', true),
                    new StringField('lagebild', true),
                    new StringField('homepage'),
                    new StringField('beschreibung'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Kanton', 
                'kanton_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kommissionen field
            //
            $editor = new TextEdit('kommissionen_edit');
            $editor->SetMaxLength(75);
            $editColumn = new CustomEditColumn('Kommissionen', 'kommissionen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for partei_id field
            //
            $editor = new ComboBox('partei_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_partei`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new StringField('abkuerzung_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new IntegerField('fraktion_id'),
                    new DateField('gruendung'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('homepage'),
                    new StringField('homepage_fr'),
                    new StringField('email'),
                    new StringField('email_fr'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('facebook_name'),
                    new StringField('twitter_name_fr'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('abkuerzung_de', true),
                    new StringField('beschreibung_de'),
                    new StringField('homepage_de'),
                    new StringField('twitter_name_de'),
                    new StringField('email_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Partei', 
                'partei_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parteifunktion field
            //
            $editor = new CheckBoxGroup('parteifunktion_edit');
            $editor->SetDisplayMode(CheckBoxGroup::StackedMode);
            $editor->addChoice('mitglied', 'mitglied');
            $editor->addChoice('praesident', 'praesident');
            $editor->addChoice('vizepraesident', 'vizepraesident');
            $editor->addChoice('fraktionschef', 'fraktionschef');
            $editColumn = new CustomEditColumn('Parteifunktion', 'parteifunktion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fraktion_id field
            //
            $editor = new ComboBox('fraktion_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_fraktion`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new DateField('von'),
                    new DateField('bis'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('beschreibung_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Fraktion', 
                'fraktion_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fraktionsfunktion field
            //
            $editor = new ComboBox('fraktionsfunktion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('mitglied', 'mitglied');
            $editor->addChoice('praesident', 'praesident');
            $editor->addChoice('vizepraesident', 'vizepraesident');
            $editColumn = new CustomEditColumn('Fraktionsfunktion', 'fraktionsfunktion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for im_rat_seit field
            //
            $editor = new DateTimeEdit('im_rat_seit_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Im Rat Seit', 'im_rat_seit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for im_rat_bis field
            //
            $editor = new DateTimeEdit('im_rat_bis_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Im Rat Bis', 'im_rat_bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ratsunterbruch_von field
            //
            $editor = new DateTimeEdit('ratsunterbruch_von_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratsunterbruch Von', 'ratsunterbruch_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ratsunterbruch_bis field
            //
            $editor = new DateTimeEdit('ratsunterbruch_bis_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratsunterbruch Bis', 'ratsunterbruch_bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beruf field
            //
            $editor = new TextAreaEdit('beruf_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beruf', 'beruf', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beruf_interessengruppe_id field
            //
            $editor = new ComboBox('beruf_interessengruppe_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Beruf Interessengruppe Id', 
                'beruf_interessengruppe_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zivilstand field
            //
            $editor = new ComboBox('zivilstand_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ledig', 'ledig');
            $editor->addChoice('verheirated', 'verheirated');
            $editor->addChoice('geschieden', 'geschieden');
            $editor->addChoice('eingetragene partnerschaft', 'eingetragene partnerschaft');
            $editColumn = new CustomEditColumn('Zivilstand', 'zivilstand', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for geschlecht field
            //
            $editor = new ComboBox('geschlecht_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('M', 'M');
            $editor->addChoice('F', 'F');
            $editColumn = new CustomEditColumn('Geschlecht', 'geschlecht', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photo field
            //
            $editor = new TextEdit('photo_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Photo', 'photo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kleinbild field
            //
            $editor = new TextEdit('kleinbild_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Kleinbild', 'kleinbild', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sitzplatz field
            //
            $editor = new TextEdit('sitzplatz_edit');
            $editColumn = new CustomEditColumn('Sitzplatz', 'sitzplatz', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for homepage field
            //
            $editor = new TextAreaEdit('homepage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage', 'homepage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for geburtstag field
            //
            $editor = new DateTimeEdit('geburtstag_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Geburtstag', 'geburtstag', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for anzahl_kinder field
            //
            $editor = new TextEdit('anzahl_kinder_edit');
            $editColumn = new CustomEditColumn('Anzahl Kinder', 'anzahl_kinder', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for militaerischer_grad_id field
            //
            $editor = new ComboBox('militaerischer_grad_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mil_grad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('typ', true),
                    new IntegerField('ranghoehe', true),
                    new IntegerField('anzeigestufe', true),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Militaerischer Grad Id', 
                'militaerischer_grad_id', 
                $editor, 
                $this->dataset, 'id', 'name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parlament_biografie_id field
            //
            $editor = new TextEdit('parlament_biografie_id_edit');
            $editColumn = new CustomEditColumn('Parlament Biografie', 'parlament_biografie_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for autorisierung_verschickt_visa field
            //
            $editor = new TextEdit('autorisierung_verschickt_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Autorisierung Verschickt Visa', 'autorisierung_verschickt_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for autorisierung_verschickt_datum field
            //
            $editor = new DateTimeEdit('autorisierung_verschickt_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Autorisierung Verschickt Datum', 'autorisierung_verschickt_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for autorisiert_visa field
            //
            $editor = new TextEdit('autorisiert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Autorisiert Visa', 'autorisiert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for autorisiert_datum field
            //
            $editor = new DateTimeEdit('autorisiert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Autorisiert Datum', 'autorisiert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photo_dateiname field
            //
            $editor = new TextAreaEdit('photo_dateiname_edit', 50, 8);
            $editColumn = new CustomEditColumn('Photo Dateiname', 'photo_dateiname', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beruf_fr field
            //
            $editor = new TextAreaEdit('beruf_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beruf Fr', 'beruf_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for titel field
            //
            $editor = new TextEdit('titel_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Titel', 'titel', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for aemter field
            //
            $editor = new TextAreaEdit('aemter_edit', 50, 8);
            $editColumn = new CustomEditColumn('Aemter', 'aemter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for weitere_aemter field
            //
            $editor = new TextAreaEdit('weitere_aemter_edit', 50, 8);
            $editColumn = new CustomEditColumn('Weitere Aemter', 'weitere_aemter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for homepage_2 field
            //
            $editor = new TextAreaEdit('homepage_2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage 2', 'homepage_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parlament_number field
            //
            $editor = new TextEdit('parlament_number_edit');
            $editColumn = new CustomEditColumn('Parlament Number', 'parlament_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen field
            //
            $editor = new TextAreaEdit('parlament_interessenbindungen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen', 'parlament_interessenbindungen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen_updated field
            //
            $editor = new DateTimeEdit('parlament_interessenbindungen_updated_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen Updated', 'parlament_interessenbindungen_updated', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextAreaEdit('wikipedia_edit', 50, 8);
            $editColumn = new CustomEditColumn('Wikipedia', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sprache field
            //
            $editor = new ComboBox('sprache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('de', 'de');
            $editor->addChoice('fr', 'fr');
            $editor->addChoice('it', 'it');
            $editor->addChoice('sk', 'sk');
            $editor->addChoice('rm', 'rm');
            $editor->addChoice('tr', 'tr');
            $editColumn = new CustomEditColumn('Sprache', 'sprache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for telephon_1 field
            //
            $editor = new TextEdit('telephon_1_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('Telephon 1', 'telephon_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for telephon_2 field
            //
            $editor = new TextEdit('telephon_2_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('Telephon 2', 'telephon_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for erfasst field
            //
            $editor = new ComboBox('erfasst_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Ja', 'Ja');
            $editor->addChoice('Nein', 'Nein');
            $editColumn = new CustomEditColumn('Erfasst', 'erfasst', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen_json field
            //
            $editor = new TextEdit('parlament_interessenbindungen_json_edit');
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen Json', 'parlament_interessenbindungen_json', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for vorname_kurz field
            //
            $editor = new TextEdit('vorname_kurz_edit');
            $editor->SetMaxLength(15);
            $editColumn = new CustomEditColumn('Vorname Kurz', 'vorname_kurz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for parlament_beruf_json field
            //
            $editor = new TextEdit('parlament_beruf_json_edit');
            $editColumn = new CustomEditColumn('Parlament Beruf Json', 'parlament_beruf_json', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for instagram_profil field
            //
            $editor = new TextEdit('instagram_profil_edit');
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Instagram Profil', 'instagram_profil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for youtube_user field
            //
            $editor = new TextEdit('youtube_user_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Youtube User', 'youtube_user', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata Qid', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for nachname field
            //
            $editor = new TextEdit('nachname_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nachname', 'nachname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for vorname field
            //
            $editor = new TextEdit('vorname_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Vorname', 'vorname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zweiter_vorname field
            //
            $editor = new TextEdit('zweiter_vorname_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zweiter Vorname', 'zweiter_vorname', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for rat_id field
            //
            $editor = new ComboBox('rat_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`rat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('name_en'),
                    new IntegerField('anzahl_mitglieder'),
                    new StringField('typ', true),
                    new IntegerField('interessenraum_id'),
                    new IntegerField('anzeigestufe', true),
                    new IntegerField('gewicht', true),
                    new StringField('beschreibung'),
                    new StringField('homepage_de'),
                    new StringField('homepage_fr'),
                    new StringField('homepage_it'),
                    new StringField('homepage_en'),
                    new StringField('mitglied_bezeichnung_maennlich_de', true),
                    new StringField('mitglied_bezeichnung_weiblich_de', true),
                    new StringField('mitglied_bezeichnung_maennlich_fr', true),
                    new StringField('mitglied_bezeichnung_weiblich_fr', true),
                    new IntegerField('parlament_id', true),
                    new StringField('parlament_type'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Rat', 
                'rat_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kanton_id field
            //
            $editor = new ComboBox('kanton_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`kanton`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new IntegerField('kantonsnr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr', true),
                    new StringField('name_it', true),
                    new IntegerField('romandie', true),
                    new IntegerField('anzahl_staenderaete', true),
                    new StringField('amtssprache', true),
                    new StringField('hauptort_de', true),
                    new StringField('hauptort_fr'),
                    new StringField('hauptort_it'),
                    new IntegerField('flaeche_km2', true),
                    new IntegerField('beitrittsjahr', true),
                    new StringField('wappen_svg', true),
                    new StringField('wappen_svg_pfad', true),
                    new StringField('wappen_klein', true),
                    new StringField('wappen', true),
                    new StringField('lagebild', true),
                    new StringField('homepage'),
                    new StringField('beschreibung'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Kanton', 
                'kanton_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kommissionen field
            //
            $editor = new TextEdit('kommissionen_edit');
            $editor->SetMaxLength(75);
            $editColumn = new CustomEditColumn('Kommissionen', 'kommissionen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for partei_id field
            //
            $editor = new ComboBox('partei_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_partei`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new StringField('abkuerzung_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new IntegerField('fraktion_id'),
                    new DateField('gruendung'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('homepage'),
                    new StringField('homepage_fr'),
                    new StringField('email'),
                    new StringField('email_fr'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('facebook_name'),
                    new StringField('twitter_name_fr'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('abkuerzung_de', true),
                    new StringField('beschreibung_de'),
                    new StringField('homepage_de'),
                    new StringField('twitter_name_de'),
                    new StringField('email_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Partei', 
                'partei_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for parteifunktion field
            //
            $editor = new CheckBoxGroup('parteifunktion_edit');
            $editor->SetDisplayMode(CheckBoxGroup::StackedMode);
            $editor->addChoice('mitglied', 'mitglied');
            $editor->addChoice('praesident', 'praesident');
            $editor->addChoice('vizepraesident', 'vizepraesident');
            $editor->addChoice('fraktionschef', 'fraktionschef');
            $editColumn = new CustomEditColumn('Parteifunktion', 'parteifunktion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fraktion_id field
            //
            $editor = new ComboBox('fraktion_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_fraktion`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new DateField('von'),
                    new DateField('bis'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('beschreibung_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Fraktion', 
                'fraktion_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fraktionsfunktion field
            //
            $editor = new ComboBox('fraktionsfunktion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('mitglied', 'mitglied');
            $editor->addChoice('praesident', 'praesident');
            $editor->addChoice('vizepraesident', 'vizepraesident');
            $editColumn = new CustomEditColumn('Fraktionsfunktion', 'fraktionsfunktion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for im_rat_seit field
            //
            $editor = new DateTimeEdit('im_rat_seit_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Im Rat Seit', 'im_rat_seit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for im_rat_bis field
            //
            $editor = new DateTimeEdit('im_rat_bis_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Im Rat Bis', 'im_rat_bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ratsunterbruch_von field
            //
            $editor = new DateTimeEdit('ratsunterbruch_von_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratsunterbruch Von', 'ratsunterbruch_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ratsunterbruch_bis field
            //
            $editor = new DateTimeEdit('ratsunterbruch_bis_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratsunterbruch Bis', 'ratsunterbruch_bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beruf field
            //
            $editor = new TextAreaEdit('beruf_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beruf', 'beruf', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beruf_interessengruppe_id field
            //
            $editor = new ComboBox('beruf_interessengruppe_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Beruf Interessengruppe Id', 
                'beruf_interessengruppe_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zivilstand field
            //
            $editor = new ComboBox('zivilstand_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ledig', 'ledig');
            $editor->addChoice('verheirated', 'verheirated');
            $editor->addChoice('geschieden', 'geschieden');
            $editor->addChoice('eingetragene partnerschaft', 'eingetragene partnerschaft');
            $editColumn = new CustomEditColumn('Zivilstand', 'zivilstand', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for geschlecht field
            //
            $editor = new ComboBox('geschlecht_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('M', 'M');
            $editor->addChoice('F', 'F');
            $editColumn = new CustomEditColumn('Geschlecht', 'geschlecht', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo field
            //
            $editor = new TextEdit('photo_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Photo', 'photo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kleinbild field
            //
            $editor = new TextEdit('kleinbild_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Kleinbild', 'kleinbild', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sitzplatz field
            //
            $editor = new TextEdit('sitzplatz_edit');
            $editColumn = new CustomEditColumn('Sitzplatz', 'sitzplatz', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for homepage field
            //
            $editor = new TextAreaEdit('homepage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage', 'homepage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for geburtstag field
            //
            $editor = new DateTimeEdit('geburtstag_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Geburtstag', 'geburtstag', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for anzahl_kinder field
            //
            $editor = new TextEdit('anzahl_kinder_edit');
            $editColumn = new CustomEditColumn('Anzahl Kinder', 'anzahl_kinder', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for militaerischer_grad_id field
            //
            $editor = new ComboBox('militaerischer_grad_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mil_grad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('typ', true),
                    new IntegerField('ranghoehe', true),
                    new IntegerField('anzeigestufe', true),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Militaerischer Grad Id', 
                'militaerischer_grad_id', 
                $editor, 
                $this->dataset, 'id', 'name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for autorisierung_verschickt_visa field
            //
            $editor = new TextEdit('autorisierung_verschickt_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Autorisierung Verschickt Visa', 'autorisierung_verschickt_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for autorisierung_verschickt_datum field
            //
            $editor = new DateTimeEdit('autorisierung_verschickt_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Autorisierung Verschickt Datum', 'autorisierung_verschickt_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for autorisiert_visa field
            //
            $editor = new TextEdit('autorisiert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Autorisiert Visa', 'autorisiert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for autorisiert_datum field
            //
            $editor = new DateTimeEdit('autorisiert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Autorisiert Datum', 'autorisiert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo_dateiname field
            //
            $editor = new TextAreaEdit('photo_dateiname_edit', 50, 8);
            $editColumn = new CustomEditColumn('Photo Dateiname', 'photo_dateiname', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ratswechsel field
            //
            $editor = new DateTimeEdit('ratswechsel_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratswechsel', 'ratswechsel', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo_dateierweiterung field
            //
            $editor = new TextEdit('photo_dateierweiterung_edit');
            $editor->SetMaxLength(15);
            $editColumn = new CustomEditColumn('Photo Dateierweiterung', 'photo_dateierweiterung', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo_dateiname_voll field
            //
            $editor = new TextAreaEdit('photo_dateiname_voll_edit', 50, 8);
            $editColumn = new CustomEditColumn('Photo Dateiname Voll', 'photo_dateiname_voll', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo_mime_type field
            //
            $editor = new TextEdit('photo_mime_type_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Photo Mime Type', 'photo_mime_type', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for twitter_name field
            //
            $editor = new TextEdit('twitter_name_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Twitter Name', 'twitter_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for linkedin_profil_url field
            //
            $editor = new TextAreaEdit('linkedin_profil_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Linkedin Profil Url', 'linkedin_profil_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for xing_profil_name field
            //
            $editor = new TextAreaEdit('xing_profil_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Xing Profil Name', 'xing_profil_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for facebook_name field
            //
            $editor = new TextAreaEdit('facebook_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Facebook Name', 'facebook_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for arbeitssprache field
            //
            $editor = new ComboBox('arbeitssprache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('de', 'de');
            $editor->addChoice('fr', 'fr');
            $editor->addChoice('it', 'it');
            $editColumn = new CustomEditColumn('Arbeitssprache', 'arbeitssprache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_firma field
            //
            $editor = new TextEdit('adresse_firma_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Adresse Firma', 'adresse_firma', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_strasse field
            //
            $editor = new TextEdit('adresse_strasse_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Adresse Strasse', 'adresse_strasse', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_zusatz field
            //
            $editor = new TextEdit('adresse_zusatz_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Adresse Zusatz', 'adresse_zusatz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_plz field
            //
            $editor = new TextEdit('adresse_plz_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Adresse Plz', 'adresse_plz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for adresse_ort field
            //
            $editor = new TextEdit('adresse_ort_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Adresse Ort', 'adresse_ort', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beruf_fr field
            //
            $editor = new TextAreaEdit('beruf_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beruf Fr', 'beruf_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for titel field
            //
            $editor = new TextEdit('titel_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Titel', 'titel', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for aemter field
            //
            $editor = new TextAreaEdit('aemter_edit', 50, 8);
            $editColumn = new CustomEditColumn('Aemter', 'aemter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for weitere_aemter field
            //
            $editor = new TextAreaEdit('weitere_aemter_edit', 50, 8);
            $editColumn = new CustomEditColumn('Weitere Aemter', 'weitere_aemter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for homepage_2 field
            //
            $editor = new TextAreaEdit('homepage_2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage 2', 'homepage_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for parlament_number field
            //
            $editor = new TextEdit('parlament_number_edit');
            $editColumn = new CustomEditColumn('Parlament Number', 'parlament_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen field
            //
            $editor = new TextAreaEdit('parlament_interessenbindungen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen', 'parlament_interessenbindungen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen_updated field
            //
            $editor = new DateTimeEdit('parlament_interessenbindungen_updated_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen Updated', 'parlament_interessenbindungen_updated', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextAreaEdit('wikipedia_edit', 50, 8);
            $editColumn = new CustomEditColumn('Wikipedia', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for sprache field
            //
            $editor = new ComboBox('sprache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('de', 'de');
            $editor->addChoice('fr', 'fr');
            $editor->addChoice('it', 'it');
            $editor->addChoice('sk', 'sk');
            $editor->addChoice('rm', 'rm');
            $editor->addChoice('tr', 'tr');
            $editColumn = new CustomEditColumn('Sprache', 'sprache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for telephon_1 field
            //
            $editor = new TextEdit('telephon_1_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('Telephon 1', 'telephon_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for telephon_2 field
            //
            $editor = new TextEdit('telephon_2_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('Telephon 2', 'telephon_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for erfasst field
            //
            $editor = new ComboBox('erfasst_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Ja', 'Ja');
            $editor->addChoice('Nein', 'Nein');
            $editColumn = new CustomEditColumn('Erfasst', 'erfasst', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen_json field
            //
            $editor = new TextEdit('parlament_interessenbindungen_json_edit');
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen Json', 'parlament_interessenbindungen_json', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for vorname_kurz field
            //
            $editor = new TextEdit('vorname_kurz_edit');
            $editor->SetMaxLength(15);
            $editColumn = new CustomEditColumn('Vorname Kurz', 'vorname_kurz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for parlament_beruf_json field
            //
            $editor = new TextEdit('parlament_beruf_json_edit');
            $editColumn = new CustomEditColumn('Parlament Beruf Json', 'parlament_beruf_json', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for instagram_profil field
            //
            $editor = new TextEdit('instagram_profil_edit');
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Instagram Profil', 'instagram_profil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for youtube_user field
            //
            $editor = new TextEdit('youtube_user_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Youtube User', 'youtube_user', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata Qid', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for nachname field
            //
            $editor = new TextEdit('nachname_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nachname', 'nachname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for vorname field
            //
            $editor = new TextEdit('vorname_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Vorname', 'vorname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zweiter_vorname field
            //
            $editor = new TextEdit('zweiter_vorname_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zweiter Vorname', 'zweiter_vorname', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for rat_id field
            //
            $editor = new ComboBox('rat_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`rat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('name_en'),
                    new IntegerField('anzahl_mitglieder'),
                    new StringField('typ', true),
                    new IntegerField('interessenraum_id'),
                    new IntegerField('anzeigestufe', true),
                    new IntegerField('gewicht', true),
                    new StringField('beschreibung'),
                    new StringField('homepage_de'),
                    new StringField('homepage_fr'),
                    new StringField('homepage_it'),
                    new StringField('homepage_en'),
                    new StringField('mitglied_bezeichnung_maennlich_de', true),
                    new StringField('mitglied_bezeichnung_weiblich_de', true),
                    new StringField('mitglied_bezeichnung_maennlich_fr', true),
                    new StringField('mitglied_bezeichnung_weiblich_fr', true),
                    new IntegerField('parlament_id', true),
                    new StringField('parlament_type'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Rat', 
                'rat_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kanton_id field
            //
            $editor = new ComboBox('kanton_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`kanton`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new IntegerField('kantonsnr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr', true),
                    new StringField('name_it', true),
                    new IntegerField('romandie', true),
                    new IntegerField('anzahl_staenderaete', true),
                    new StringField('amtssprache', true),
                    new StringField('hauptort_de', true),
                    new StringField('hauptort_fr'),
                    new StringField('hauptort_it'),
                    new IntegerField('flaeche_km2', true),
                    new IntegerField('beitrittsjahr', true),
                    new StringField('wappen_svg', true),
                    new StringField('wappen_svg_pfad', true),
                    new StringField('wappen_klein', true),
                    new StringField('wappen', true),
                    new StringField('lagebild', true),
                    new StringField('homepage'),
                    new StringField('beschreibung'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Kanton', 
                'kanton_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kommissionen field
            //
            $editor = new TextEdit('kommissionen_edit');
            $editor->SetMaxLength(75);
            $editColumn = new CustomEditColumn('Kommissionen', 'kommissionen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for partei_id field
            //
            $editor = new ComboBox('partei_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_partei`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new StringField('abkuerzung_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new IntegerField('fraktion_id'),
                    new DateField('gruendung'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('homepage'),
                    new StringField('homepage_fr'),
                    new StringField('email'),
                    new StringField('email_fr'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('facebook_name'),
                    new StringField('twitter_name_fr'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('abkuerzung_de', true),
                    new StringField('beschreibung_de'),
                    new StringField('homepage_de'),
                    new StringField('twitter_name_de'),
                    new StringField('email_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Partei', 
                'partei_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parteifunktion field
            //
            $editor = new CheckBoxGroup('parteifunktion_edit');
            $editor->SetDisplayMode(CheckBoxGroup::StackedMode);
            $editor->addChoice('mitglied', 'mitglied');
            $editor->addChoice('praesident', 'praesident');
            $editor->addChoice('vizepraesident', 'vizepraesident');
            $editor->addChoice('fraktionschef', 'fraktionschef');
            $editColumn = new CustomEditColumn('Parteifunktion', 'parteifunktion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fraktion_id field
            //
            $editor = new ComboBox('fraktion_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_fraktion`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new DateField('von'),
                    new DateField('bis'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('beschreibung_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Fraktion', 
                'fraktion_id', 
                $editor, 
                $this->dataset, 'id', 'abkuerzung', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fraktionsfunktion field
            //
            $editor = new ComboBox('fraktionsfunktion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('mitglied', 'mitglied');
            $editor->addChoice('praesident', 'praesident');
            $editor->addChoice('vizepraesident', 'vizepraesident');
            $editColumn = new CustomEditColumn('Fraktionsfunktion', 'fraktionsfunktion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for im_rat_seit field
            //
            $editor = new DateTimeEdit('im_rat_seit_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Im Rat Seit', 'im_rat_seit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for im_rat_bis field
            //
            $editor = new DateTimeEdit('im_rat_bis_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Im Rat Bis', 'im_rat_bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ratsunterbruch_von field
            //
            $editor = new DateTimeEdit('ratsunterbruch_von_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratsunterbruch Von', 'ratsunterbruch_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ratsunterbruch_bis field
            //
            $editor = new DateTimeEdit('ratsunterbruch_bis_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Ratsunterbruch Bis', 'ratsunterbruch_bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beruf field
            //
            $editor = new TextAreaEdit('beruf_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beruf', 'beruf', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beruf_interessengruppe_id field
            //
            $editor = new ComboBox('beruf_interessengruppe_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Beruf Interessengruppe Id', 
                'beruf_interessengruppe_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zivilstand field
            //
            $editor = new ComboBox('zivilstand_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ledig', 'ledig');
            $editor->addChoice('verheirated', 'verheirated');
            $editor->addChoice('geschieden', 'geschieden');
            $editor->addChoice('eingetragene partnerschaft', 'eingetragene partnerschaft');
            $editColumn = new CustomEditColumn('Zivilstand', 'zivilstand', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for geschlecht field
            //
            $editor = new ComboBox('geschlecht_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('M', 'M');
            $editor->addChoice('F', 'F');
            $editColumn = new CustomEditColumn('Geschlecht', 'geschlecht', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photo field
            //
            $editor = new TextEdit('photo_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Photo', 'photo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kleinbild field
            //
            $editor = new TextEdit('kleinbild_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Kleinbild', 'kleinbild', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sitzplatz field
            //
            $editor = new TextEdit('sitzplatz_edit');
            $editColumn = new CustomEditColumn('Sitzplatz', 'sitzplatz', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for homepage field
            //
            $editor = new TextAreaEdit('homepage_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage', 'homepage', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for geburtstag field
            //
            $editor = new DateTimeEdit('geburtstag_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Geburtstag', 'geburtstag', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for anzahl_kinder field
            //
            $editor = new TextEdit('anzahl_kinder_edit');
            $editColumn = new CustomEditColumn('Anzahl Kinder', 'anzahl_kinder', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for militaerischer_grad_id field
            //
            $editor = new ComboBox('militaerischer_grad_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mil_grad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('typ', true),
                    new IntegerField('ranghoehe', true),
                    new IntegerField('anzeigestufe', true),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Militaerischer Grad Id', 
                'militaerischer_grad_id', 
                $editor, 
                $this->dataset, 'id', 'name', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parlament_biografie_id field
            //
            $editor = new TextEdit('parlament_biografie_id_edit');
            $editColumn = new CustomEditColumn('Parlament Biografie', 'parlament_biografie_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for autorisierung_verschickt_visa field
            //
            $editor = new TextEdit('autorisierung_verschickt_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Autorisierung Verschickt Visa', 'autorisierung_verschickt_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for autorisierung_verschickt_datum field
            //
            $editor = new DateTimeEdit('autorisierung_verschickt_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Autorisierung Verschickt Datum', 'autorisierung_verschickt_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for autorisiert_visa field
            //
            $editor = new TextEdit('autorisiert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Autorisiert Visa', 'autorisiert_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for autorisiert_datum field
            //
            $editor = new DateTimeEdit('autorisiert_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Autorisiert Datum', 'autorisiert_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photo_dateiname field
            //
            $editor = new TextAreaEdit('photo_dateiname_edit', 50, 8);
            $editColumn = new CustomEditColumn('Photo Dateiname', 'photo_dateiname', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beruf_fr field
            //
            $editor = new TextAreaEdit('beruf_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beruf Fr', 'beruf_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for titel field
            //
            $editor = new TextEdit('titel_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Titel', 'titel', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for aemter field
            //
            $editor = new TextAreaEdit('aemter_edit', 50, 8);
            $editColumn = new CustomEditColumn('Aemter', 'aemter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for weitere_aemter field
            //
            $editor = new TextAreaEdit('weitere_aemter_edit', 50, 8);
            $editColumn = new CustomEditColumn('Weitere Aemter', 'weitere_aemter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for homepage_2 field
            //
            $editor = new TextAreaEdit('homepage_2_edit', 50, 8);
            $editColumn = new CustomEditColumn('Homepage 2', 'homepage_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parlament_number field
            //
            $editor = new TextEdit('parlament_number_edit');
            $editColumn = new CustomEditColumn('Parlament Number', 'parlament_number', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen field
            //
            $editor = new TextAreaEdit('parlament_interessenbindungen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen', 'parlament_interessenbindungen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen_updated field
            //
            $editor = new DateTimeEdit('parlament_interessenbindungen_updated_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen Updated', 'parlament_interessenbindungen_updated', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextAreaEdit('wikipedia_edit', 50, 8);
            $editColumn = new CustomEditColumn('Wikipedia', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sprache field
            //
            $editor = new ComboBox('sprache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('de', 'de');
            $editor->addChoice('fr', 'fr');
            $editor->addChoice('it', 'it');
            $editor->addChoice('sk', 'sk');
            $editor->addChoice('rm', 'rm');
            $editor->addChoice('tr', 'tr');
            $editColumn = new CustomEditColumn('Sprache', 'sprache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for telephon_1 field
            //
            $editor = new TextEdit('telephon_1_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('Telephon 1', 'telephon_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for telephon_2 field
            //
            $editor = new TextEdit('telephon_2_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('Telephon 2', 'telephon_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for erfasst field
            //
            $editor = new ComboBox('erfasst_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Ja', 'Ja');
            $editor->addChoice('Nein', 'Nein');
            $editColumn = new CustomEditColumn('Erfasst', 'erfasst', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parlament_interessenbindungen_json field
            //
            $editor = new TextEdit('parlament_interessenbindungen_json_edit');
            $editColumn = new CustomEditColumn('Parlament Interessenbindungen Json', 'parlament_interessenbindungen_json', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for vorname_kurz field
            //
            $editor = new TextEdit('vorname_kurz_edit');
            $editor->SetMaxLength(15);
            $editColumn = new CustomEditColumn('Vorname Kurz', 'vorname_kurz', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for parlament_beruf_json field
            //
            $editor = new TextEdit('parlament_beruf_json_edit');
            $editColumn = new CustomEditColumn('Parlament Beruf Json', 'parlament_beruf_json', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for instagram_profil field
            //
            $editor = new TextEdit('instagram_profil_edit');
            $editor->SetMaxLength(30);
            $editColumn = new CustomEditColumn('Instagram Profil', 'instagram_profil', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for youtube_user field
            //
            $editor = new TextEdit('youtube_user_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Youtube User', 'youtube_user', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata Qid', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nachname field
            //
            $column = new TextViewColumn('nachname', 'nachname', 'Nachname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for vorname field
            //
            $column = new TextViewColumn('vorname', 'vorname', 'Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zweiter_vorname field
            //
            $column = new TextViewColumn('zweiter_vorname', 'zweiter_vorname', 'Zweiter Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('rat_id', 'rat_id_abkuerzung', 'Rat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('kanton_id', 'kanton_id_abkuerzung', 'Kanton', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kommissionen field
            //
            $column = new TextViewColumn('kommissionen', 'kommissionen', 'Kommissionen', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('partei_id', 'partei_id_abkuerzung', 'Partei', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for parteifunktion field
            //
            $column = new TextViewColumn('parteifunktion', 'parteifunktion', 'Parteifunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('fraktion_id', 'fraktion_id_abkuerzung', 'Fraktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fraktionsfunktion field
            //
            $column = new TextViewColumn('fraktionsfunktion', 'fraktionsfunktion', 'Fraktionsfunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for im_rat_seit field
            //
            $column = new DateTimeViewColumn('im_rat_seit', 'im_rat_seit', 'Im Rat Seit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for im_rat_bis field
            //
            $column = new DateTimeViewColumn('im_rat_bis', 'im_rat_bis', 'Im Rat Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ratsunterbruch_von field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_von', 'ratsunterbruch_von', 'Ratsunterbruch Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ratsunterbruch_bis field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_bis', 'ratsunterbruch_bis', 'Ratsunterbruch Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beruf field
            //
            $column = new TextViewColumn('beruf', 'beruf', 'Beruf', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('beruf_interessengruppe_id', 'beruf_interessengruppe_id_anzeige_name', 'Beruf Interessengruppe Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%beruf_interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zivilstand field
            //
            $column = new TextViewColumn('zivilstand', 'zivilstand', 'Zivilstand', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for geschlecht field
            //
            $column = new TextViewColumn('geschlecht', 'geschlecht', 'Geschlecht', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo field
            //
            $column = new TextViewColumn('photo', 'photo', 'Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kleinbild field
            //
            $column = new TextViewColumn('kleinbild', 'kleinbild', 'Kleinbild', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sitzplatz field
            //
            $column = new TextViewColumn('sitzplatz', 'sitzplatz', 'Sitzplatz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('mailto:%email%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for geburtstag field
            //
            $column = new DateTimeViewColumn('geburtstag', 'geburtstag', 'Geburtstag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzahl_kinder field
            //
            $column = new TextViewColumn('anzahl_kinder', 'anzahl_kinder', 'Anzahl Kinder', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('militaerischer_grad_id', 'militaerischer_grad_id_name', 'Militaerischer Grad Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for parlament_biografie_id field
            //
            $column = new TextViewColumn('parlament_biografie_id', 'parlament_biografie_id', 'Parlament Biografie', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://www.parlament.ch/d/suche/seiten/biografie.aspx?biografie_id=%parlament_biografie_id%');
            $column->setTarget('_blank');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for autorisierung_verschickt_visa field
            //
            $column = new TextViewColumn('autorisierung_verschickt_visa', 'autorisierung_verschickt_visa', 'Autorisierung Verschickt Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for autorisierung_verschickt_datum field
            //
            $column = new DateTimeViewColumn('autorisierung_verschickt_datum', 'autorisierung_verschickt_datum', 'Autorisierung Verschickt Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for autorisiert_visa field
            //
            $column = new TextViewColumn('autorisiert_visa', 'autorisiert_visa', 'Autorisiert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for autorisiert_datum field
            //
            $column = new DateTimeViewColumn('autorisiert_datum', 'autorisiert_datum', 'Autorisiert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo_dateiname field
            //
            $column = new TextViewColumn('photo_dateiname', 'photo_dateiname', 'Photo Dateiname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for beruf_fr field
            //
            $column = new TextViewColumn('beruf_fr', 'beruf_fr', 'Beruf Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for titel field
            //
            $column = new TextViewColumn('titel', 'titel', 'Titel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for aemter field
            //
            $column = new TextViewColumn('aemter', 'aemter', 'Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for weitere_aemter field
            //
            $column = new TextViewColumn('weitere_aemter', 'weitere_aemter', 'Weitere Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for homepage_2 field
            //
            $column = new TextViewColumn('homepage_2', 'homepage_2', 'Homepage 2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for parlament_number field
            //
            $column = new NumberViewColumn('parlament_number', 'parlament_number', 'Parlament Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for parlament_interessenbindungen field
            //
            $column = new TextViewColumn('parlament_interessenbindungen', 'parlament_interessenbindungen', 'Parlament Interessenbindungen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for parlament_interessenbindungen_updated field
            //
            $column = new DateTimeViewColumn('parlament_interessenbindungen_updated', 'parlament_interessenbindungen_updated', 'Parlament Interessenbindungen Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sprache field
            //
            $column = new TextViewColumn('sprache', 'sprache', 'Sprache', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for telephon_1 field
            //
            $column = new TextViewColumn('telephon_1', 'telephon_1', 'Telephon 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for telephon_2 field
            //
            $column = new TextViewColumn('telephon_2', 'telephon_2', 'Telephon 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for erfasst field
            //
            $column = new TextViewColumn('erfasst', 'erfasst', 'Erfasst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for parlament_interessenbindungen_json field
            //
            $column = new TextViewColumn('parlament_interessenbindungen_json', 'parlament_interessenbindungen_json', 'Parlament Interessenbindungen Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for vorname_kurz field
            //
            $column = new TextViewColumn('vorname_kurz', 'vorname_kurz', 'Vorname Kurz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for parlament_beruf_json field
            //
            $column = new TextViewColumn('parlament_beruf_json', 'parlament_beruf_json', 'Parlament Beruf Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nachname field
            //
            $column = new TextViewColumn('nachname', 'nachname', 'Nachname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for vorname field
            //
            $column = new TextViewColumn('vorname', 'vorname', 'Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for zweiter_vorname field
            //
            $column = new TextViewColumn('zweiter_vorname', 'zweiter_vorname', 'Zweiter Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('rat_id', 'rat_id_abkuerzung', 'Rat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('kanton_id', 'kanton_id_abkuerzung', 'Kanton', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for kommissionen field
            //
            $column = new TextViewColumn('kommissionen', 'kommissionen', 'Kommissionen', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('partei_id', 'partei_id_abkuerzung', 'Partei', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for parteifunktion field
            //
            $column = new TextViewColumn('parteifunktion', 'parteifunktion', 'Parteifunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('fraktion_id', 'fraktion_id_abkuerzung', 'Fraktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fraktionsfunktion field
            //
            $column = new TextViewColumn('fraktionsfunktion', 'fraktionsfunktion', 'Fraktionsfunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for im_rat_seit field
            //
            $column = new DateTimeViewColumn('im_rat_seit', 'im_rat_seit', 'Im Rat Seit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for im_rat_bis field
            //
            $column = new DateTimeViewColumn('im_rat_bis', 'im_rat_bis', 'Im Rat Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for ratsunterbruch_von field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_von', 'ratsunterbruch_von', 'Ratsunterbruch Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for ratsunterbruch_bis field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_bis', 'ratsunterbruch_bis', 'Ratsunterbruch Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for beruf field
            //
            $column = new TextViewColumn('beruf', 'beruf', 'Beruf', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('beruf_interessengruppe_id', 'beruf_interessengruppe_id_anzeige_name', 'Beruf Interessengruppe Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%beruf_interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for zivilstand field
            //
            $column = new TextViewColumn('zivilstand', 'zivilstand', 'Zivilstand', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for geschlecht field
            //
            $column = new TextViewColumn('geschlecht', 'geschlecht', 'Geschlecht', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for photo field
            //
            $column = new TextViewColumn('photo', 'photo', 'Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for kleinbild field
            //
            $column = new TextViewColumn('kleinbild', 'kleinbild', 'Kleinbild', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for sitzplatz field
            //
            $column = new TextViewColumn('sitzplatz', 'sitzplatz', 'Sitzplatz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('mailto:%email%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for geburtstag field
            //
            $column = new DateTimeViewColumn('geburtstag', 'geburtstag', 'Geburtstag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for anzahl_kinder field
            //
            $column = new TextViewColumn('anzahl_kinder', 'anzahl_kinder', 'Anzahl Kinder', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('militaerischer_grad_id', 'militaerischer_grad_id_name', 'Militaerischer Grad Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for parlament_biografie_id field
            //
            $column = new TextViewColumn('parlament_biografie_id', 'parlament_biografie_id', 'Parlament Biografie', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://www.parlament.ch/d/suche/seiten/biografie.aspx?biografie_id=%parlament_biografie_id%');
            $column->setTarget('_blank');
            $grid->AddExportColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for autorisierung_verschickt_visa field
            //
            $column = new TextViewColumn('autorisierung_verschickt_visa', 'autorisierung_verschickt_visa', 'Autorisierung Verschickt Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for autorisierung_verschickt_datum field
            //
            $column = new DateTimeViewColumn('autorisierung_verschickt_datum', 'autorisierung_verschickt_datum', 'Autorisierung Verschickt Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for autorisiert_visa field
            //
            $column = new TextViewColumn('autorisiert_visa', 'autorisiert_visa', 'Autorisiert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for autorisiert_datum field
            //
            $column = new DateTimeViewColumn('autorisiert_datum', 'autorisiert_datum', 'Autorisiert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for photo_dateiname field
            //
            $column = new TextViewColumn('photo_dateiname', 'photo_dateiname', 'Photo Dateiname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for beruf_fr field
            //
            $column = new TextViewColumn('beruf_fr', 'beruf_fr', 'Beruf Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for titel field
            //
            $column = new TextViewColumn('titel', 'titel', 'Titel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for aemter field
            //
            $column = new TextViewColumn('aemter', 'aemter', 'Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for weitere_aemter field
            //
            $column = new TextViewColumn('weitere_aemter', 'weitere_aemter', 'Weitere Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for homepage_2 field
            //
            $column = new TextViewColumn('homepage_2', 'homepage_2', 'Homepage 2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for parlament_number field
            //
            $column = new NumberViewColumn('parlament_number', 'parlament_number', 'Parlament Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for parlament_interessenbindungen field
            //
            $column = new TextViewColumn('parlament_interessenbindungen', 'parlament_interessenbindungen', 'Parlament Interessenbindungen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for parlament_interessenbindungen_updated field
            //
            $column = new DateTimeViewColumn('parlament_interessenbindungen_updated', 'parlament_interessenbindungen_updated', 'Parlament Interessenbindungen Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for sprache field
            //
            $column = new TextViewColumn('sprache', 'sprache', 'Sprache', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for telephon_1 field
            //
            $column = new TextViewColumn('telephon_1', 'telephon_1', 'Telephon 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for telephon_2 field
            //
            $column = new TextViewColumn('telephon_2', 'telephon_2', 'Telephon 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for erfasst field
            //
            $column = new TextViewColumn('erfasst', 'erfasst', 'Erfasst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for parlament_interessenbindungen_json field
            //
            $column = new TextViewColumn('parlament_interessenbindungen_json', 'parlament_interessenbindungen_json', 'Parlament Interessenbindungen Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for vorname_kurz field
            //
            $column = new TextViewColumn('vorname_kurz', 'vorname_kurz', 'Vorname Kurz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for parlament_beruf_json field
            //
            $column = new TextViewColumn('parlament_beruf_json', 'parlament_beruf_json', 'Parlament Beruf Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for nachname field
            //
            $column = new TextViewColumn('nachname', 'nachname', 'Nachname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for vorname field
            //
            $column = new TextViewColumn('vorname', 'vorname', 'Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zweiter_vorname field
            //
            $column = new TextViewColumn('zweiter_vorname', 'zweiter_vorname', 'Zweiter Vorname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('rat_id', 'rat_id_abkuerzung', 'Rat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('kanton_id', 'kanton_id_abkuerzung', 'Kanton', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kommissionen field
            //
            $column = new TextViewColumn('kommissionen', 'kommissionen', 'Kommissionen', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('partei_id', 'partei_id_abkuerzung', 'Partei', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for parteifunktion field
            //
            $column = new TextViewColumn('parteifunktion', 'parteifunktion', 'Parteifunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for abkuerzung field
            //
            $column = new TextViewColumn('fraktion_id', 'fraktion_id_abkuerzung', 'Fraktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for fraktionsfunktion field
            //
            $column = new TextViewColumn('fraktionsfunktion', 'fraktionsfunktion', 'Fraktionsfunktion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for im_rat_seit field
            //
            $column = new DateTimeViewColumn('im_rat_seit', 'im_rat_seit', 'Im Rat Seit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for im_rat_bis field
            //
            $column = new DateTimeViewColumn('im_rat_bis', 'im_rat_bis', 'Im Rat Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ratsunterbruch_von field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_von', 'ratsunterbruch_von', 'Ratsunterbruch Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ratsunterbruch_bis field
            //
            $column = new DateTimeViewColumn('ratsunterbruch_bis', 'ratsunterbruch_bis', 'Ratsunterbruch Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beruf field
            //
            $column = new TextViewColumn('beruf', 'beruf', 'Beruf', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzeige_name field
            //
            $column = new TextViewColumn('beruf_interessengruppe_id', 'beruf_interessengruppe_id_anzeige_name', 'Beruf Interessengruppe Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('interessengruppe.php?operation=view&pk0=%beruf_interessengruppe_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zivilstand field
            //
            $column = new TextViewColumn('zivilstand', 'zivilstand', 'Zivilstand', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for geschlecht field
            //
            $column = new TextViewColumn('geschlecht', 'geschlecht', 'Geschlecht', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo field
            //
            $column = new TextViewColumn('photo', 'photo', 'Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kleinbild field
            //
            $column = new TextViewColumn('kleinbild', 'kleinbild', 'Kleinbild', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sitzplatz field
            //
            $column = new TextViewColumn('sitzplatz', 'sitzplatz', 'Sitzplatz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('mailto:%email%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for homepage field
            //
            $column = new TextViewColumn('homepage', 'homepage', 'Homepage', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%homepage%');
            $column->setTarget('_blank');
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for geburtstag field
            //
            $column = new DateTimeViewColumn('geburtstag', 'geburtstag', 'Geburtstag', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzahl_kinder field
            //
            $column = new TextViewColumn('anzahl_kinder', 'anzahl_kinder', 'Anzahl Kinder', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('militaerischer_grad_id', 'militaerischer_grad_id_name', 'Militaerischer Grad Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for parlament_biografie_id field
            //
            $column = new TextViewColumn('parlament_biografie_id', 'parlament_biografie_id', 'Parlament Biografie', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://www.parlament.ch/d/suche/seiten/biografie.aspx?biografie_id=%parlament_biografie_id%');
            $column->setTarget('_blank');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for autorisierung_verschickt_visa field
            //
            $column = new TextViewColumn('autorisierung_verschickt_visa', 'autorisierung_verschickt_visa', 'Autorisierung Verschickt Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for autorisierung_verschickt_datum field
            //
            $column = new DateTimeViewColumn('autorisierung_verschickt_datum', 'autorisierung_verschickt_datum', 'Autorisierung Verschickt Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for autorisiert_visa field
            //
            $column = new TextViewColumn('autorisiert_visa', 'autorisiert_visa', 'Autorisiert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for autorisiert_datum field
            //
            $column = new DateTimeViewColumn('autorisiert_datum', 'autorisiert_datum', 'Autorisiert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo_dateiname field
            //
            $column = new TextViewColumn('photo_dateiname', 'photo_dateiname', 'Photo Dateiname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ratswechsel field
            //
            $column = new DateTimeViewColumn('ratswechsel', 'ratswechsel', 'Ratswechsel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo_dateierweiterung field
            //
            $column = new TextViewColumn('photo_dateierweiterung', 'photo_dateierweiterung', 'Photo Dateierweiterung', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo_dateiname_voll field
            //
            $column = new TextViewColumn('photo_dateiname_voll', 'photo_dateiname_voll', 'Photo Dateiname Voll', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo_mime_type field
            //
            $column = new TextViewColumn('photo_mime_type', 'photo_mime_type', 'Photo Mime Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for twitter_name field
            //
            $column = new TextViewColumn('twitter_name', 'twitter_name', 'Twitter Name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for linkedin_profil_url field
            //
            $column = new TextViewColumn('linkedin_profil_url', 'linkedin_profil_url', 'Linkedin Profil Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for xing_profil_name field
            //
            $column = new TextViewColumn('xing_profil_name', 'xing_profil_name', 'Xing Profil Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for facebook_name field
            //
            $column = new TextViewColumn('facebook_name', 'facebook_name', 'Facebook Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for arbeitssprache field
            //
            $column = new TextViewColumn('arbeitssprache', 'arbeitssprache', 'Arbeitssprache', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_firma field
            //
            $column = new TextViewColumn('adresse_firma', 'adresse_firma', 'Adresse Firma', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_strasse field
            //
            $column = new TextViewColumn('adresse_strasse', 'adresse_strasse', 'Adresse Strasse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_zusatz field
            //
            $column = new TextViewColumn('adresse_zusatz', 'adresse_zusatz', 'Adresse Zusatz', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_plz field
            //
            $column = new TextViewColumn('adresse_plz', 'adresse_plz', 'Adresse Plz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for adresse_ort field
            //
            $column = new TextViewColumn('adresse_ort', 'adresse_ort', 'Adresse Ort', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for beruf_fr field
            //
            $column = new TextViewColumn('beruf_fr', 'beruf_fr', 'Beruf Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for titel field
            //
            $column = new TextViewColumn('titel', 'titel', 'Titel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for aemter field
            //
            $column = new TextViewColumn('aemter', 'aemter', 'Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for weitere_aemter field
            //
            $column = new TextViewColumn('weitere_aemter', 'weitere_aemter', 'Weitere Aemter', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for homepage_2 field
            //
            $column = new TextViewColumn('homepage_2', 'homepage_2', 'Homepage 2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for parlament_number field
            //
            $column = new NumberViewColumn('parlament_number', 'parlament_number', 'Parlament Number', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('\'');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for parlament_interessenbindungen field
            //
            $column = new TextViewColumn('parlament_interessenbindungen', 'parlament_interessenbindungen', 'Parlament Interessenbindungen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for parlament_interessenbindungen_updated field
            //
            $column = new DateTimeViewColumn('parlament_interessenbindungen_updated', 'parlament_interessenbindungen_updated', 'Parlament Interessenbindungen Updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for sprache field
            //
            $column = new TextViewColumn('sprache', 'sprache', 'Sprache', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for telephon_1 field
            //
            $column = new TextViewColumn('telephon_1', 'telephon_1', 'Telephon 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for telephon_2 field
            //
            $column = new TextViewColumn('telephon_2', 'telephon_2', 'Telephon 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for erfasst field
            //
            $column = new TextViewColumn('erfasst', 'erfasst', 'Erfasst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for parlament_interessenbindungen_json field
            //
            $column = new TextViewColumn('parlament_interessenbindungen_json', 'parlament_interessenbindungen_json', 'Parlament Interessenbindungen Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for vorname_kurz field
            //
            $column = new TextViewColumn('vorname_kurz', 'vorname_kurz', 'Vorname Kurz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for parlament_beruf_json field
            //
            $column = new TextViewColumn('parlament_beruf_json', 'parlament_beruf_json', 'Parlament Beruf Json', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for instagram_profil field
            //
            $column = new TextViewColumn('instagram_profil', 'instagram_profil', 'Instagram Profil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for youtube_user field
            //
            $column = new TextViewColumn('youtube_user', 'youtube_user', 'Youtube User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata Qid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`rat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('name_en'),
                    new IntegerField('anzahl_mitglieder'),
                    new StringField('typ', true),
                    new IntegerField('interessenraum_id'),
                    new IntegerField('anzeigestufe', true),
                    new IntegerField('gewicht', true),
                    new StringField('beschreibung'),
                    new StringField('homepage_de'),
                    new StringField('homepage_fr'),
                    new StringField('homepage_it'),
                    new StringField('homepage_en'),
                    new StringField('mitglied_bezeichnung_maennlich_de', true),
                    new StringField('mitglied_bezeichnung_weiblich_de', true),
                    new StringField('mitglied_bezeichnung_maennlich_fr', true),
                    new StringField('mitglied_bezeichnung_weiblich_fr', true),
                    new IntegerField('parlament_id', true),
                    new StringField('parlament_type'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_rat_id_search', 'id', 'abkuerzung', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`kanton`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('abkuerzung', true),
                    new IntegerField('kantonsnr', true),
                    new StringField('name_de', true),
                    new StringField('name_fr', true),
                    new StringField('name_it', true),
                    new IntegerField('romandie', true),
                    new IntegerField('anzahl_staenderaete', true),
                    new StringField('amtssprache', true),
                    new StringField('hauptort_de', true),
                    new StringField('hauptort_fr'),
                    new StringField('hauptort_it'),
                    new IntegerField('flaeche_km2', true),
                    new IntegerField('beitrittsjahr', true),
                    new StringField('wappen_svg', true),
                    new StringField('wappen_svg_pfad', true),
                    new StringField('wappen_klein', true),
                    new StringField('wappen', true),
                    new StringField('lagebild', true),
                    new StringField('homepage'),
                    new StringField('beschreibung'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_kanton_id_search', 'id', 'abkuerzung', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_partei`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new StringField('abkuerzung_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new IntegerField('fraktion_id'),
                    new DateField('gruendung'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('homepage'),
                    new StringField('homepage_fr'),
                    new StringField('email'),
                    new StringField('email_fr'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('facebook_name'),
                    new StringField('twitter_name_fr'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('abkuerzung_de', true),
                    new StringField('beschreibung_de'),
                    new StringField('homepage_de'),
                    new StringField('twitter_name_de'),
                    new StringField('email_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_partei_id_search', 'id', 'abkuerzung', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_partei`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new StringField('abkuerzung_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new IntegerField('fraktion_id'),
                    new DateField('gruendung'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('homepage'),
                    new StringField('homepage_fr'),
                    new StringField('email'),
                    new StringField('email_fr'),
                    new StringField('twitter_name'),
                    new StringField('instagram_profil'),
                    new StringField('youtube_user'),
                    new StringField('facebook_name'),
                    new StringField('twitter_name_fr'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('abkuerzung_de', true),
                    new StringField('beschreibung_de'),
                    new StringField('homepage_de'),
                    new StringField('twitter_name_de'),
                    new StringField('email_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_partei_id_search', 'id', 'abkuerzung', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_fraktion`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('abkuerzung', true),
                    new StringField('name'),
                    new StringField('name_fr'),
                    new StringField('position'),
                    new StringField('farbcode'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new DateField('von'),
                    new DateField('bis'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de'),
                    new StringField('beschreibung_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('abkuerzung', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_fraktion_id_search', 'id', 'abkuerzung', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_interessengruppe_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('alias_namen_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_beruf_interessengruppe_id_search', 'id', 'anzeige_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mil_grad`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new StringField('abkuerzung', true),
                    new StringField('abkuerzung_fr'),
                    new StringField('typ', true),
                    new IntegerField('ranghoehe', true),
                    new IntegerField('anzeigestufe', true),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_parlamentarier_militaerischer_grad_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class interessengruppePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Lobbygruppe');
            $this->SetMenuLabel('<span class="entity">Lobbygruppe</span>');
    
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`interessengruppe`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('branche_id', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('alias_namen'),
                    new StringField('alias_namen_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $this->dataset->AddLookupField('branche_id', 'v_branche_simple', new IntegerField('id'), new StringField('anzeige_name_mixed', false, false, false, false, 'branche_id_anzeige_name_mixed', 'branche_id_anzeige_name_mixed_v_branche_simple'), 'branche_id_anzeige_name_mixed_v_branche_simple');
        }
    
        protected function DoPrepare() {
            globalOnPreparePage($this);
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new CustomPageNavigator('partition', $this, $this->GetDataset(), 'Name beginnt mit', $result, 'partition');
            $partitionNavigator->OnGetPartitions->AddListener('partition_OnGetPartitions', $this);
            $partitionNavigator->OnGetPartitionCondition->AddListener('partition_OnGetPartitionCondition', $this);
            $partitionNavigator->SetAllowViewAllRecords(true);
            $partitionNavigator->SetNavigationStyle(NS_LIST);
            $result->AddPageNavigator($partitionNavigator);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(12);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator() {
            return setupRSS($this, $this->dataset); /*afterburner*/ 
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'name', 'name', 'Name'),
                new FilterColumn($this->dataset, 'name_fr', 'name_fr', 'Name Fr'),
                new FilterColumn($this->dataset, 'branche_id', 'branche_id_anzeige_name_mixed', 'Branche'),
                new FilterColumn($this->dataset, 'beschreibung', 'beschreibung', 'Beschreibung'),
                new FilterColumn($this->dataset, 'beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr'),
                new FilterColumn($this->dataset, 'alias_namen', 'alias_namen', 'Alias Namen'),
                new FilterColumn($this->dataset, 'alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr'),
                new FilterColumn($this->dataset, 'isicv4', 'isicv4', 'ISICv4 Codes'),
                new FilterColumn($this->dataset, 'wikipedia', 'wikipedia', 'Wikipedia URL'),
                new FilterColumn($this->dataset, 'wikidata_qid', 'wikidata_qid', 'Wikidata'),
                new FilterColumn($this->dataset, 'notizen', 'notizen', 'Notizen'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum'),
                new FilterColumn($this->dataset, 'kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa'),
                new FilterColumn($this->dataset, 'kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum'),
                new FilterColumn($this->dataset, 'freigabe_visa', 'freigabe_visa', 'Freigabe Visa'),
                new FilterColumn($this->dataset, 'freigabe_datum', 'freigabe_datum', 'Freigabe Datum'),
                new FilterColumn($this->dataset, 'created_visa', 'created_visa', 'Created Visa'),
                new FilterColumn($this->dataset, 'created_date', 'created_date', 'Created Date'),
                new FilterColumn($this->dataset, 'updated_visa', 'updated_visa', 'Updated Visa'),
                new FilterColumn($this->dataset, 'updated_date', 'updated_date', 'Updated Date')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['name_fr'])
                ->addColumn($columns['branche_id'])
                ->addColumn($columns['beschreibung'])
                ->addColumn($columns['beschreibung_fr'])
                ->addColumn($columns['alias_namen'])
                ->addColumn($columns['alias_namen_fr'])
                ->addColumn($columns['isicv4'])
                ->addColumn($columns['wikidata_qid'])
                ->addColumn($columns['notizen']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('id')
                ->setOptionsFor('name')
                ->setOptionsFor('name_fr')
                ->setOptionsFor('branche_id')
                ->setOptionsFor('alias_namen')
                ->setOptionsFor('alias_namen_fr')
                ->setOptionsFor('eingabe_abgeschlossen_visa')
                ->setOptionsFor('eingabe_abgeschlossen_datum')
                ->setOptionsFor('kontrolliert_visa')
                ->setOptionsFor('kontrolliert_datum')
                ->setOptionsFor('freigabe_visa')
                ->setOptionsFor('freigabe_datum')
                ->setOptionsFor('created_visa')
                ->setOptionsFor('created_date')
                ->setOptionsFor('updated_visa')
                ->setOptionsFor('updated_date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name_edit');
            $main_editor->SetMaxLength(150);
            
            $filterBuilder->addColumn(
                $columns['name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('name_fr_edit');
            $main_editor->SetMaxLength(150);
            
            $filterBuilder->addColumn(
                $columns['name_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('branche_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_interessengruppe_branche_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('branche_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_interessengruppe_branche_id_search');
            
            $text_editor = new TextEdit('branche_id');
            
            $filterBuilder->addColumn(
                $columns['branche_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung');
            
            $filterBuilder->addColumn(
                $columns['beschreibung'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung_fr');
            
            $filterBuilder->addColumn(
                $columns['beschreibung_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen');
            
            $filterBuilder->addColumn(
                $columns['alias_namen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('alias_namen_fr');
            
            $filterBuilder->addColumn(
                $columns['alias_namen_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('isicv4_edit');
            $main_editor->SetMaxLength(25);
            $main_editor->SetPlaceholder('01 012 0123, siehe Seitenhilfe');
            
            $filterBuilder->addColumn(
                $columns['isicv4'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikipedia_edit');
            
            $filterBuilder->addColumn(
                $columns['wikipedia'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('wikidata_qid_edit');
            $main_editor->SetMaxLength(12);
            
            $filterBuilder->addColumn(
                $columns['wikidata_qid'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('notizen');
            
            $filterBuilder->addColumn(
                $columns['notizen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kontrolliert_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('freigabe_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['freigabe_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['freigabe_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('created_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['created_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['created_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('updated_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['updated_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            if (GetCurrentUserPermissionsForPage('interessengruppe.interessengruppe_log')->HasViewGrant() && $withDetails)
            {
            //
            // View column for interessengruppe_interessengruppe_log detail
            //
            $column = new DetailColumn(array('id'), 'interessengruppe.interessengruppe_log', 'interessengruppe_interessengruppe_log_handler', $this->dataset, 'Interessengruppe Log');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('interessengruppe.organisation')->HasViewGrant() && $withDetails)
            {
            //
            // View column for interessengruppe_organisation detail
            //
            $column = new DetailColumn(array('id'), 'interessengruppe.organisation', 'interessengruppe_organisation_handler', $this->dataset, 'Organisation');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('interessengruppe.parlamentarier')->HasViewGrant() && $withDetails)
            {
            //
            // View column for interessengruppe_parlamentarier detail
            //
            $column = new DetailColumn(array('id'), 'interessengruppe.parlamentarier', 'interessengruppe_parlamentarier_handler', $this->dataset, 'Parlamentarier');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://lobbywatch.ch/de/daten/lobbygruppe/%id%');
            $column->setTarget('_blank');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Technischer Schlüssel der Lobbygruppe (Interessengruppe).  Der Link zeigt auf den Eintrag in der Lobbywatch.ch Webseite.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->setBold(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Bezeichnung der Interessengruppe');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französische Bezeichnung der Interessengruppe');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anzeige_name_mixed field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name_mixed', 'Branche', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('branche.php?operation=view&pk0=%branche_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Branche');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Eingrenzung und Beschreibung zur Interessengruppe');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Eingrenzung und Beschreibung zur Interessengruppe auf französisch');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Strichpunkt-getrennte Aufzählung von alternative Namen für die Lobbygruppe; bei der Suche werden für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Strichpunkt-getrennte Aufzählung von alternativen französischen Namen für die Lobbygruppe; bei der Suche werden für ein einfacheres Finden auch in den Alias-Namen gesucht.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'ISICv4 Codes', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('ISICv4-Codes, getrennt durch Leerzeichen. International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 ist ein Einteilungsstandard der UNO, siehe https://unstats.un.org/unsd/publication/SeriesM/seriesm_4rev4e.pdf');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia URL', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%wikipedia%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Link zum Wikipedia-Eintrag');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('https://www.wikidata.org/wiki/%wikidata_qid%');
            $column->setTarget('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Wikidata Item Q-ID. Wikidata enthält sprachunabhängige Wikipediadaten und stellt eine global gültige ID dar (semantic Web). Die Q-ID wird aufgrund des Wikipedia-Links automatisch gesetzt.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Interne Notizen zu diesem Eintrag. Einträge am besten mit Datum und Visa versehen.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe abgeschlossen hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Die Eingabe ist für den Ersteller der Einträge abgeschlossen und bereit für die Kontrolle. (Leer/NULL bedeutet, dass die Eingabe noch im Gange ist.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe kontrolliert hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Der Eintrag wurde durch eine zweite Person am angegebenen Datum kontrolliert. (Leer/NULL bedeutet noch nicht kontrolliert.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabe von (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabedatum (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://lobbywatch.ch/de/daten/lobbygruppe/%id%');
            $column->setTarget('_blank');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->setBold(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anzeige_name_mixed field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name_mixed', 'Branche', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('branche.php?operation=view&pk0=%branche_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'ISICv4 Codes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia URL', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%wikipedia%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('https://www.wikidata.org/wiki/%wikidata_qid%');
            $column->setTarget('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name_fr field
            //
            $editor = new TextEdit('name_fr_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Name Fr', 'name_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for branche_id field
            //
            $editor = new ComboBox('branche_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Branche', 
                'branche_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name_mixed', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextAreaEdit('beschreibung_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextAreaEdit('beschreibung_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for alias_namen field
            //
            $editor = new TextAreaEdit('alias_namen_edit', 80, 2);
            $editColumn = new CustomEditColumn('Alias Namen', 'alias_namen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_fr field
            //
            $editor = new TextAreaEdit('alias_namen_fr_edit', 80, 2);
            $editColumn = new CustomEditColumn('Alias Namen Fr', 'alias_namen_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for isicv4 field
            //
            $editor = new TextEdit('isicv4_edit');
            $editor->SetMaxLength(25);
            $editor->SetPlaceholder('01 012 0123, siehe Seitenhilfe');
            $editColumn = new CustomEditColumn('ISICv4 Codes', 'isicv4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('^\d{2,4}( \d{2,4})*$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextEdit('wikipedia_edit');
            $editColumn = new CustomEditColumn('Wikipedia URL', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('^https://\w{2}\.wikipedia.org/wiki/', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for wikidata_qid field
            //
            $editor = new TextEdit('wikidata_qid_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Wikidata', 'wikidata_qid', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for name_fr field
            //
            $editor = new TextEdit('name_fr_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Name Fr', 'name_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for branche_id field
            //
            $editor = new ComboBox('branche_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Branche', 
                'branche_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name_mixed', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextAreaEdit('beschreibung_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextAreaEdit('beschreibung_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for alias_namen field
            //
            $editor = new TextAreaEdit('alias_namen_edit', 80, 2);
            $editColumn = new CustomEditColumn('Alias Namen', 'alias_namen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for alias_namen_fr field
            //
            $editor = new TextAreaEdit('alias_namen_fr_edit', 80, 2);
            $editColumn = new CustomEditColumn('Alias Namen Fr', 'alias_namen_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name_fr field
            //
            $editor = new TextEdit('name_fr_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Name Fr', 'name_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for branche_id field
            //
            $editor = new ComboBox('branche_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Branche', 
                'branche_id', 
                $editor, 
                $this->dataset, 'id', 'anzeige_name_mixed', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextAreaEdit('beschreibung_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextAreaEdit('beschreibung_fr_edit', 50, 8);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for alias_namen field
            //
            $editor = new TextAreaEdit('alias_namen_edit', 80, 2);
            $editColumn = new CustomEditColumn('Alias Namen', 'alias_namen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for alias_namen_fr field
            //
            $editor = new TextAreaEdit('alias_namen_fr_edit', 80, 2);
            $editColumn = new CustomEditColumn('Alias Namen Fr', 'alias_namen_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for isicv4 field
            //
            $editor = new TextEdit('isicv4_edit');
            $editor->SetMaxLength(25);
            $editor->SetPlaceholder('01 012 0123, siehe Seitenhilfe');
            $editColumn = new CustomEditColumn('ISICv4 Codes', 'isicv4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('^\d{2,4}( \d{2,4})*$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for wikipedia field
            //
            $editor = new TextEdit('wikipedia_edit');
            $editColumn = new CustomEditColumn('Wikipedia URL', 'wikipedia', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('^https://\w{2}\.wikipedia.org/wiki/', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editor->setPlaceholder(getNotizenPlaceholder()); // Afterburned
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://lobbywatch.ch/de/daten/lobbygruppe/%id%');
            $column->setTarget('_blank');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->setBold(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for anzeige_name_mixed field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name_mixed', 'Branche', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('branche.php?operation=view&pk0=%branche_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'ISICv4 Codes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia URL', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%wikipedia%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('https://www.wikidata.org/wiki/%wikidata_qid%');
            $column->setTarget('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://lobbywatch.ch/de/daten/lobbygruppe/%id%');
            $column->setTarget('_blank');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->setBold(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for anzeige_name_mixed field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name_mixed', 'Branche', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('branche.php?operation=view&pk0=%branche_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'ISICv4 Codes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia URL', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%wikipedia%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('https://www.wikidata.org/wiki/%wikidata_qid%');
            $column->setTarget('');
            $grid->AddExportColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://lobbywatch.ch/de/daten/lobbygruppe/%id%');
            $column->setTarget('_blank');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->setBold(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name_fr field
            //
            $column = new TextViewColumn('name_fr', 'name_fr', 'Name Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for anzeige_name_mixed field
            //
            $column = new TextViewColumn('branche_id', 'branche_id_anzeige_name_mixed', 'Branche', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('branche.php?operation=view&pk0=%branche_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen field
            //
            $column = new TextViewColumn('alias_namen', 'alias_namen', 'Alias Namen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for alias_namen_fr field
            //
            $column = new TextViewColumn('alias_namen_fr', 'alias_namen_fr', 'Alias Namen Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for isicv4 field
            //
            $column = new TextViewColumn('isicv4', 'isicv4', 'ISICv4 Codes', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikipedia field
            //
            $column = new TextViewColumn('wikipedia', 'wikipedia', 'Wikipedia URL', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%wikipedia%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for wikidata_qid field
            //
            $column = new TextViewColumn('wikidata_qid', 'wikidata_qid', 'Wikidata', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('https://www.wikidata.org/wiki/%wikidata_qid%');
            $column->setTarget('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetReplaceLFByBR(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
        
        function partition_OnGetPartitions(&$partitions)
        {
            $tmp = array();
            $this->GetConnection()->ExecQueryToArray("
            SELECT DISTINCT
            left(i.name, 1) as first_letter
            FROM interessengruppe i
            ORDER BY first_letter", $tmp
            );
            
            foreach($tmp as $letter) {
              $partitions[$letter['first_letter']] = strtoupper($letter['first_letter']);
            }
        }
        
        function partition_OnGetPartitionCondition($partitionKey, &$condition)
        {
            $condition = "left(interessengruppe.name, 1) = '$partitionKey'";
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $defaultSortedColumns = array();
            $defaultSortedColumns[] = new SortColumn('updated_date', 'DESC');
            $result->setDefaultOrdering($defaultSortedColumns);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setIncludeAllFieldsForMultiEditByDefault(false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetViewFormTitle('Lobbygruppe "%name%"');
            $this->SetEditFormTitle('Edit Lobbygruppe "%name%"');
            $this->SetInsertFormTitle('Add new Lobbygruppe');
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setDescription('' . $GLOBALS["edit_header_message"] /*afterburner*/  . '
            
            <div class="wiki-table-help">
            <p>Liste der Interessengruppen. Innerhalb einer Branche gibt es normalerweise verschiedene Interessengruppen.
            </p>
            
            <p>Beispiel: Das Gesundheitswesen hat die Interessengruppen Pharmaindustrie, Ärzte, Pflegeberufe, Patienten, Spitäler, Krankenkassen, …
            </p>
            
            <p>Interessengruppen versuchen die Politik in ihrem Interesse zu beeinflussen.
            </p>
            </div>
            
            ' . $GLOBALS["edit_general_hint"] /*afterburner*/  . '');
            $this->setShowFormErrorsOnTop(true);
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $detailPage = new interessengruppe_interessengruppe_logPage('interessengruppe_interessengruppe_log', $this, array('id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('interessengruppe.interessengruppe_log'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('interessengruppe.interessengruppe_log'));
            $detailPage->SetHttpHandlerName('interessengruppe_interessengruppe_log_handler');
            $handler = new PageHTTPHandler('interessengruppe_interessengruppe_log_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new interessengruppe_organisationPage('interessengruppe_organisation', $this, array('interessengruppe_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('interessengruppe.organisation'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('interessengruppe.organisation'));
            $detailPage->SetHttpHandlerName('interessengruppe_organisation_handler');
            $handler = new PageHTTPHandler('interessengruppe_organisation_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new interessengruppe_parlamentarierPage('interessengruppe_parlamentarier', $this, array('beruf_interessengruppe_id'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('interessengruppe.parlamentarier'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('interessengruppe.parlamentarier'));
            $detailPage->SetHttpHandlerName('interessengruppe_parlamentarier_handler');
            $handler = new PageHTTPHandler('interessengruppe_parlamentarier_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_branche_id_search', 'id', 'anzeige_name_mixed', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_branche_id_search', 'id', 'anzeige_name_mixed', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_branche_id_search', 'id', 'anzeige_name_mixed', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_branche_id_search', 'id', 'anzeige_name_mixed', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_branche_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_name_de'),
                    new StringField('anzeige_name_fr'),
                    new StringField('anzeige_name_mixed'),
                    new IntegerField('id', true),
                    new StringField('name', true),
                    new StringField('name_fr'),
                    new IntegerField('kommission_id'),
                    new IntegerField('kommission2_id'),
                    new StringField('technischer_name', true),
                    new StringField('beschreibung', true),
                    new StringField('beschreibung_fr'),
                    new StringField('angaben'),
                    new StringField('angaben_fr'),
                    new StringField('isicv4'),
                    new StringField('wikipedia'),
                    new StringField('wikidata_qid'),
                    new StringField('farbcode'),
                    new StringField('symbol_abs'),
                    new StringField('symbol_rel'),
                    new StringField('symbol_klein_rel'),
                    new StringField('symbol_dateiname_wo_ext'),
                    new StringField('symbol_dateierweiterung'),
                    new StringField('symbol_dateiname'),
                    new StringField('symbol_mime_type'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new StringField('name_de', true),
                    new StringField('beschreibung_de', true),
                    new StringField('angaben_de'),
                    new IntegerField('published', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('anzeige_name_mixed', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_interessengruppe_branche_id_search', 'id', 'anzeige_name_mixed', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
            customOnCustomRenderColumn('interessengruppe', $fieldName, $fieldData, $rowData, $customText, $handled);
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
            customDrawRow('interessengruppe', $rowData, $rowCellStyles, $rowStyles, $rowClasses, $cellClasses);
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
            defaultOnGetCustomTemplate($this, $part, $mode, $result, $params);
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new interessengruppePage("interessengruppe", "interessengruppe.php", GetCurrentUserPermissionsForPage("interessengruppe"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("interessengruppe"));
        GetApplication()->SetMainPage($Page);
        before_render($Page); /*afterburner*/ 
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
