@extends('backend.layouts.app')
@section('title', 'Show Client')

@section('current', 'Show Client')
@section('previous_link')
<a class="opacity-5 text-dark" href="{{url("/admin/clients")}}">Client</a>
@stop

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-offset-3">
            <div class="card">
                <div class="card-header">
                    <h3>Client Details</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Name :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $client->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Email :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $client->email ?? '-' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Phone :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $client->phone ?? '-' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="font-weight-bold">Address :</p>
                        </div>
                        <div class="col-md-7">
                            {{ $client->address ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection