<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;
use App\Models\Billing;
use App\Models\Client;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    protected $model;

    protected $rView = 'backend.billing.';

    public function __construct(Billing $model)
    {
        return $this->model = $model;
    }

    public function index()
    {
        return view($this->rView. 'index');
    }

    public function ssd()
    {
        $client = $this->model->query()->with('client')->orderBy('created_at', 'desc');
        return datatables()->of($client)
        ->addColumn('action', function ($each) {
            $show_icon = "";
            $edit_icon = "";
            $delete_icon = "";

            $show_icon = '<a href="'.url('admin/billings/'.$each->id).'" class="text-success mr-1"><i class="fas fa-eye"></i></a>';

            $edit_icon = '<a href="'.url('admin/billings/'.$each->id.'/edit').'" class="text-warning mr-1"><i class="fas fa-user-edit"></i></a>';
            
            $delete_icon = '<a href="'.url('admin/billings/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            
            return '<div class="action-icon">'. $show_icon .$edit_icon . $delete_icon.'</div>';
        })
        ->addColumn('client_name', function ($each) {
            if ($each->client) {
                return $each->client->name;
            }
            return '-';
        })
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view($this->rView. 'create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillingRequest $request)
    {
        $billing = $this->model->create($request->all());

        return redirect('/admin/billings')->with('create', 'Created Successfully');
    }

    public function show(Billing $billing)
    {
        return view($this->rView. 'show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        $clients = Client::all();
        return view($this->rView. 'edit', compact('billing', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BillingRequest $request, $id)
    {
        $billing = $this->model->find($id)->update($request->all());
        return redirect('/admin/billings')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        $billing->delete();

        return 'success';
    }
}
