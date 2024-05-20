@extends('frontend.app.app')
@section('content')
<div class="col-lg-5 mx-auto my-5">
    <div class="card">
        <div class="card-body text-center py-4">
            <h4 style="color: #21a06a">Your Order Has been placed successfully!</h4>
            <p class="mb-4">You can check your Order Status from your dashboard.</p>
            <a href="{{ route('invoice.download', request()->order) }}" class="btn btn-primary">Download Invoice</a>
        </div>

    </div>
</div>
@endsection