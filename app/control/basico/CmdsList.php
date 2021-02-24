<?php

class CmdsList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'sursum_dfe';
    private static $activeRecord = 'Cmds';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Cmds';
    private $showMethods = ['onReload', 'onSearch'];

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle("Comandos");

        $tipo_comando_id = new TDBCombo('tipo_comando_id', 'sursum_dfe', 'TiposComando', 'id', '{descricao}','descricao asc'  );
        $dt_hr_comando = new TDateTime('dt_hr_comando');
        $comando = new TEntry('comando');
        $dt_hr_retorno = new TDateTime('dt_hr_retorno');
        $retorno = new TEntry('retorno');
        $num_metodo_comunicacao = new TEntry('num_metodo_comunicacao');
        $log_erro = new TRadioGroup('log_erro');
        $num_situacao = new TEntry('num_situacao');

        $log_erro->addItems(['1'=>'Sim','2'=>'Não']);
        $log_erro->setLayout('horizontal');
        $log_erro->setBooleanMode();
        $num_situacao->setMaxLength(1);

        $dt_hr_comando->setMask('dd/mm/yyyy hh:ii');
        $dt_hr_retorno->setMask('dd/mm/yyyy hh:ii');

        $dt_hr_comando->setDatabaseMask('yyyy-mm-dd hh:ii');
        $dt_hr_retorno->setDatabaseMask('yyyy-mm-dd hh:ii');

        $log_erro->setSize(80);
        $comando->setSize('100%');
        $retorno->setSize('100%');
        $dt_hr_comando->setSize(150);
        $dt_hr_retorno->setSize(150);
        $num_situacao->setSize('100%');
        $tipo_comando_id->setSize('100%');
        $num_metodo_comunicacao->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Tp.Comando:", null, '14px', null)],[$tipo_comando_id]);
        $row2 = $this->form->addFields([new TLabel("Dt.Hr.Comando:", null, '14px', null)],[$dt_hr_comando]);
        $row3 = $this->form->addFields([new TLabel("Comando:", null, '14px', null)],[$comando]);
        $row4 = $this->form->addFields([new TLabel("Dt.Hr. Retorno:", null, '14px', null)],[$dt_hr_retorno]);
        $row5 = $this->form->addFields([new TLabel("Retorno:", null, '14px', null)],[$retorno]);
        $row6 = $this->form->addFields([new TLabel("Método Comunicação:", null, '14px', null)],[$num_metodo_comunicacao]);
        $row7 = $this->form->addFields([new TLabel("Ocorreu Erro?:", null, '14px', null)],[$log_erro]);
        $row8 = $this->form->addFields([new TLabel("Situação:", null, '14px', null)],[$num_situacao]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onexportcsv = $this->form->addAction("Exportar como CSV", new TAction([$this, 'onExportCsv']), 'far:file-alt #000000');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_tipo_comando_descricao = new TDataGridColumn('tipo_comando->descricao', "Tp.Comando", 'left');
        $column_dt_hr_comando = new TDataGridColumn('dt_hr_comando', "Dt.Hr.Comando", 'left');
        $column_comando = new TDataGridColumn('comando', "Comando", 'left');
        $column_dt_hr_retorno = new TDataGridColumn('dt_hr_retorno', "Dt.Hr. Retorno", 'left');
        $column_retorno = new TDataGridColumn('retorno', "Retorno", 'left');
        $column_num_metodo_comunicacao = new TDataGridColumn('num_metodo_comunicacao', "Método Comunicação", 'left');
        $column_log_erro = new TDataGridColumn('log_erro', "Ocorreu Erro?", 'left');
        $column_num_situacao = new TDataGridColumn('num_situacao', "Situação", 'left');

        $this->datagrid->addColumn($column_tipo_comando_descricao);
        $this->datagrid->addColumn($column_dt_hr_comando);
        $this->datagrid->addColumn($column_comando);
        $this->datagrid->addColumn($column_dt_hr_retorno);
        $this->datagrid->addColumn($column_retorno);
        $this->datagrid->addColumn($column_num_metodo_comunicacao);
        $this->datagrid->addColumn($column_log_erro);
        $this->datagrid->addColumn($column_num_situacao);

        $action_onDelete = new TDataGridAction(array('CmdsList', 'onDelete'));
        $action_onDelete->setUseButton(false);
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel("Excluir");
        $action_onDelete->setImage('fas:trash-alt #dd5a43');
        $action_onDelete->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(["Básico","Comandos"]));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    public function onDelete($param = null) 
    { 
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                // get the paramseter $key
                $key = $param['key'];
                // open a transaction with database
                TTransaction::open(self::$database);

                // instantiates object
                $object = new Cmds($key, FALSE); 

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                // reload the listing
                $this->onReload( $param );
                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'));
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    public function onExportCsv($param = null) 
    {
        try
        {
            $this->onSearch();

            TTransaction::open(self::$database); // open a transaction
            $repository = new TRepository(self::$activeRecord); // creates a repository for Customer
            $criteria = $this->filter_criteria;

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            $records = $repository->load($criteria); // load the objects according to criteria
            if ($records)
            {
                $file = 'tmp/'.uniqid().'.csv';
                $handle = fopen($file, 'w');
                $columns = $this->datagrid->getColumns();

                $csvColumns = [];
                foreach($columns as $column)
                {
                    $csvColumns[] = $column->getLabel();
                }
                fputcsv($handle, $csvColumns, ';');

                foreach ($records as $record)
                {
                    $csvColumns = [];
                    foreach($columns as $column)
                    {
                        $name = $column->getName();
                        $csvColumns[] = $record->{$name};
                    }
                    fputcsv($handle, $csvColumns, ';');
                }
                fclose($handle);

                TPage::openFile($file);
            }
            else
            {
                new TMessage('info', _t('No records found'));       
            }

            TTransaction::close(); // close the transaction
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->tipo_comando_id) AND ( (is_scalar($data->tipo_comando_id) AND $data->tipo_comando_id !== '') OR (is_array($data->tipo_comando_id) AND (!empty($data->tipo_comando_id)) )) )
        {

            $filters[] = new TFilter('tipo_comando_id', '=', $data->tipo_comando_id);// create the filter 
        }

        if (isset($data->dt_hr_comando) AND ( (is_scalar($data->dt_hr_comando) AND $data->dt_hr_comando !== '') OR (is_array($data->dt_hr_comando) AND (!empty($data->dt_hr_comando)) )) )
        {

            $filters[] = new TFilter('dt_hr_comando', '=', $data->dt_hr_comando);// create the filter 
        }

        if (isset($data->comando) AND ( (is_scalar($data->comando) AND $data->comando !== '') OR (is_array($data->comando) AND (!empty($data->comando)) )) )
        {

            $filters[] = new TFilter('comando', 'like', "%{$data->comando}%");// create the filter 
        }

        if (isset($data->dt_hr_retorno) AND ( (is_scalar($data->dt_hr_retorno) AND $data->dt_hr_retorno !== '') OR (is_array($data->dt_hr_retorno) AND (!empty($data->dt_hr_retorno)) )) )
        {

            $filters[] = new TFilter('dt_hr_retorno', '=', $data->dt_hr_retorno);// create the filter 
        }

        if (isset($data->retorno) AND ( (is_scalar($data->retorno) AND $data->retorno !== '') OR (is_array($data->retorno) AND (!empty($data->retorno)) )) )
        {

            $filters[] = new TFilter('retorno', 'like', "%{$data->retorno}%");// create the filter 
        }

        if (isset($data->num_metodo_comunicacao) AND ( (is_scalar($data->num_metodo_comunicacao) AND $data->num_metodo_comunicacao !== '') OR (is_array($data->num_metodo_comunicacao) AND (!empty($data->num_metodo_comunicacao)) )) )
        {

            $filters[] = new TFilter('num_metodo_comunicacao', '=', $data->num_metodo_comunicacao);// create the filter 
        }

        if (isset($data->log_erro) AND ( (is_scalar($data->log_erro) AND $data->log_erro !== '') OR (is_array($data->log_erro) AND (!empty($data->log_erro)) )) )
        {

            $filters[] = new TFilter('log_erro', '=', $data->log_erro);// create the filter 
        }

        if (isset($data->num_situacao) AND ( (is_scalar($data->num_situacao) AND $data->num_situacao !== '') OR (is_array($data->num_situacao) AND (!empty($data->num_situacao)) )) )
        {

            $filters[] = new TFilter('num_situacao', '=', $data->num_situacao);// create the filter 
        }

        $param = array();
        $param['offset']     = 0;
        $param['first_page'] = 1;

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload($param);
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'sursum_dfe'
            TTransaction::open(self::$database);

            // creates a repository for Cmds
            $repository = new TRepository(self::$activeRecord);
            $limit = 20;

            $criteria = clone $this->filter_criteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid

                    $this->datagrid->addItem($object);

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  $this->showMethods))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

