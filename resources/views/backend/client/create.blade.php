@extends('backend.layouts.app')
@section('title', 'Create Client')

@section('current', 'Create Client')
@section('previous_link')
<a class="opacity-5 text-dark" href="{{url("/admin/clients")}}">Client</a>
@stop

@section('content')
<div class="container-fluid py-4">
    <form class="row g-3" method="POST" action="{{ route('clients.store') }}" id="client-create">
        @csrf
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Client Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <Textarea class="form-control" name="address" placeholder="Client Address"></Textarea>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary mt-2" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\ClientRequest', '#client-create'); !!}
@endsection