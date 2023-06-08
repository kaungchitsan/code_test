@extends('backend.layouts.app')
@section('title', 'Edit Billing')

@section('current', 'Edit Billing')
@section('previous_link')
<a class="opacity-5 text-dark" href="{{url("/admin/billings")}}">Billing</a>
@stop

@section('content')
<div class="container-fluid py-4">
    <form class="row g-3" method="POST" action="{{ route('billings.update', $billing) }}" id="billing-update">
        @csrf
        @method('PUT')
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="client_id" class="form-label">Choose Client</label>
                            <select name="client_id" id="client_id" required class="form-control">
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @selected( $client->id == $billing->client_id )>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" value="{{ $billing->amount }}" name="amount" class="form-control" id="amount" placeholder="Amount">
                        </div>
                        <div class="col-md-12">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" name="due_date" value="{{ $billing->due_date }}" class="form-control" id="due_date" placeholder="Due Date">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <Textarea class="form-control" name="description" placeholder="Description here...">{{ $billing->description ?? '' }}</Textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\BillingRequest', '#billing-update'); !!}
@endsection