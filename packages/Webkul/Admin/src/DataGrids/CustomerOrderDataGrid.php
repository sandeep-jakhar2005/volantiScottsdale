<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\OrderAddress;
use Webkul\Ui\DataGrid\DataGrid;

class CustomerOrderDataGrid extends DataGrid
{
    /**
     * Index.
     *
     * @var string
     */
    protected $index = 'id';

    /**
     * Sort order.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('orders')
            ->leftJoin('addresses as order_address_shipping', function ($leftJoin) {
                $leftJoin->on('order_address_shipping.order_id', '=', 'orders.id')
                    ->where('order_address_shipping.address_type', OrderAddress::ADDRESS_TYPE_SHIPPING);
            })
            ->leftJoin('addresses as order_address_billing', function ($leftJoin) {
                $leftJoin->on('order_address_billing.order_id', '=', 'orders.id')
                    ->where('order_address_billing.address_type', OrderAddress::ADDRESS_TYPE_BILLING);
            })
            ->addSelect('orders.id', 'orders.increment_id', 'orders.base_sub_total', 'orders.base_grand_total', 'orders.created_at', 'channel_name', 'status')
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name) as billed_to'))
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name) as shipped_to'))
            ->where('orders.customer_id', request('id'));

        $this->addFilter('billed_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name)'));
        $this->addFilter('shipped_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name)'));
        $this->addFilter('increment_id', 'orders.increment_id');
        $this->addFilter('created_at', 'orders.created_at');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'increment_id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.datagrid.order-date'),
            'type'       => 'datetime',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'channel_name',
            'label'      => trans('admin::app.datagrid.channel-name'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'base_sub_total',
            'label'      => trans('admin::app.datagrid.sub-total'),
            'type'       => 'price',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'base_grand_total',
            'label'      => trans('admin::app.datagrid.grand-total'),
            'type'       => 'price',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.datagrid.status'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
            'closure'    => function ($value) {
                if ($value->status == 'processing') {
                    return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.orders.order-status-processing') . '</span>';
                } elseif ($value->status == 'completed') {
                    return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.orders.order-status-success') . '</span>';
                } elseif ($value->status == 'canceled') {
                    return '<span class="badge badge-md badge-danger">' . trans('admin::app.sales.orders.order-status-canceled') . '</span>';
                } elseif ($value->status == 'closed') {
                    return '<span class="badge badge-md badge-info">' . trans('admin::app.sales.orders.order-status-closed') . '</span>';
                } elseif ($value->status == 'pending') {
                    return '<span class="badge badge-md badge-warning">' . trans('admin::app.sales.orders.order-status-pending') . '</span>';
                } elseif ($value->status == 'pending_payment') {
                    return '<span class="badge badge-md badge-warning">' . trans('admin::app.sales.orders.order-status-pending-payment') . '</span>';
                } elseif ($value->status == 'fraud') {                    
                    return '<span class="badge badge-md badge-danger">' . trans('admin::app.sales.orders.order-status-fraud') . '</span>';
                } elseif ($value->status == 'accepted') {
                    return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.orders.order-status-accepted') . '</span>';
                } elseif ($value->status == 'paid') {
                    return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.orders.order-status-paid') . '</span>';
                } elseif ($value->status == 'shipped') {                    
                    return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.orders.order-status-shipped') . '</span>';
                } elseif ($value->status == 'invoice sent') {
                    return '<span class="badge badge-md badge-info">' . trans('Invoice Sent') . '</span>';
                } elseif ($value->status == 'delivered') {                    
                    return '<span class="badge badge-md badge-success">' . trans('delivered') . '</span>';
                }
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.sales.orders.view',
            'icon'   => 'icon eye-icon',
        ]);
    }
}
