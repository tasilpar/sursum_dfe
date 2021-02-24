<?php

class TransacoesList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'sursum_dfe';
    private static $activeRecord = 'Transacoes';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Transacoes';
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
        $this->form->setFormTitle("Transações");

        $dt_hr_ini = new TDateTime('dt_hr_ini');
        $usuario_id = new TEntry('usuario_id');
        $origem_id = new TDBCombo('origem_id', 'sursum_dfe', 'Origens', 'id', '{id}','id asc'  );
        $dt_hr_fim = new TDateTime('dt_hr_fim');
        $cod_programa = new TEntry('cod_programa');

        $cod_programa->setMaxLength(50);

        $dt_hr_ini->setDatabaseMask('yyyy-mm-dd hh:ii');
        $dt_hr_fim->setDatabaseMask('yyyy-mm-dd hh:ii');

        $dt_hr_ini->setMask('dd/mm/yyyy hh:ii');
        $dt_hr_fim->setMask('dd/mm/yyyy hh:ii');

        $dt_hr_ini->setSize(150);
        $dt_hr_fim->setSize(150);
        $origem_id->setSize('100%');
        $usuario_id->setSize('100%');
        $cod_programa->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Dt.Hr.Transação:", null, '14px', null)],[$dt_hr_ini]);
        $row2 = $this->form->addFields([new TLabel("Usuário:", null, '14px', null)],[$usuario_id]);
        $row3 = $this->form->addFields([new TLabel("Origem:", null, '14px', null)],[$origem_id]);
        $row4 = $this->form->addFields([new TLabel("Dt. Hr. Fim:", null, '14px', null)],[$dt_hr_fim]);
        $row5 = $this->form->addFields([new TLabel("Programa:", null, '14px', null)],[$cod_programa]);

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

        $column_id = new TDataGridColumn('id', "Id", 'center' , '70px');
        $column_dt_hr_ini_transformed = new TDataGridColumn('dt_hr_ini', "Dt.Hr.Transação", 'left');
        $column_cod_programa = new TDataGridColumn('cod_programa', "Programa", 'left');
        $column_dt_hr_fim_transformed = new TDataGridColumn('dt_hr_fim', "Dt. Hr. Fim", 'left');
        $column_usuario_login = new TDataGridColumn('usuario->login', "Usuário", 'left');
        $column_origem_titulo = new TDataGridColumn('origem->titulo', "Origem", 'left');

        $column_dt_hr_ini_transformed->setTransformer(function($value, $object, $row)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y H:i');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $column_dt_hr_fim_transformed->setTransformer(function($value, $object, $row)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y H:i');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });        

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_dt_hr_ini_transformed);
        $this->datagrid->addColumn($column_cod_programa);
        $this->datagrid->addColumn($column_dt_hr_fim_transformed);
        $this->datagrid->addColumn($column_usuario_login);
        $this->datagrid->addColumn($column_origem_titulo);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);
        $panel->getBody()->class .= ' table-responsive';

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(["Básico","Transações"]));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

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

        if (isset($data->dt_hr_ini) AND ( (is_scalar($data->dt_hr_ini) AND $data->dt_hr_ini !== '') OR (is_array($data->dt_hr_ini) AND (!empty($data->dt_hr_ini)) )) )
        {

            $filters[] = new TFilter('dt_hr_ini', '=', $data->dt_hr_ini);// create the filter 
        }

        if (isset($data->usuario_id) AND ( (is_scalar($data->usuario_id) AND $data->usuario_id !== '') OR (is_array($data->usuario_id) AND (!empty($data->usuario_id)) )) )
        {

            $filters[] = new TFilter('usuario_id', '=', $data->usuario_id);// create the filter 
        }

        if (isset($data->origem_id) AND ( (is_scalar($data->origem_id) AND $data->origem_id !== '') OR (is_array($data->origem_id) AND (!empty($data->origem_id)) )) )
        {

            $filters[] = new TFilter('origem_id', '=', $data->origem_id);// create the filter 
        }

        if (isset($data->dt_hr_fim) AND ( (is_scalar($data->dt_hr_fim) AND $data->dt_hr_fim !== '') OR (is_array($data->dt_hr_fim) AND (!empty($data->dt_hr_fim)) )) )
        {

            $filters[] = new TFilter('dt_hr_fim', '=', $data->dt_hr_fim);// create the filter 
        }

        if (isset($data->cod_programa) AND ( (is_scalar($data->cod_programa) AND $data->cod_programa !== '') OR (is_array($data->cod_programa) AND (!empty($data->cod_programa)) )) )
        {

            $filters[] = new TFilter('cod_programa', 'like', "%{$data->cod_programa}%");// create the filter 
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

            // creates a repository for Transacoes
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

