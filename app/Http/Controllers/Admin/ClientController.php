<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $model;

    protected $rView = 'backend.client.';

    public function __construct(Client $model)
    {
        return $this->model = $model;
    }

    public function index()
    {
        return view($this->rView. 'index');
    }

    public function ssd()
    {
        $client = $this->model->query()->orderBy('created_at', 'desc');
        return datatables()->of($client)
        ->addColumn('action', function ($each) {
            $show_icon = "";
            $edit_icon = "";
            $delete_icon = "";

            $show_icon = '<a href="'.url('admin/clients/'.$each->id).'" class="text-success mr-1"><i class="fas fa-eye"></i></a>';

            $edit_icon = '<a href="'.url('admin/clients/'.$each->id.'/edit').'" class="text-warning mr-1"><i class="fas fa-user-edit"></i></a>';
            
            $delete_icon = '<a href="'.url('admin/clients/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            
            return '<div class="action-icon">'. $show_icon .$edit_icon . $delete_icon.'</div>';
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
        return view($this->rView. 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = $this->model->create($request->all());

        return redirect('/admin/clients')->with('create', 'Created Successfully');
    }

    public function show(Client $client)
    {
        return view($this->rView. 'show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view($this->rView. 'edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $client = $this->model->find($id)->update($request->all());
        return redirect('/admin/clients')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return 'success';
    }
}
