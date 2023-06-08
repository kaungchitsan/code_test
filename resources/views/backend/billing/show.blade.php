@extends('backend.layouts.app')
@section('title', 'Show Billing')

@section('current', 'Show Billing')
@section('previous_link')
<a class="opacity-5 text-dark" href="{{url("/admin/billings")}}">Billing</a>
@stop

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-offset-3">
            <div class="card">
                <div class="card-header">
                    <h3>Billing Details</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Client Name :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $billing->client ? $billing->client->name : '-' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Amount :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $billing->amount }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Due Date :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $billing->due_date }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Description :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $billing->description ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection