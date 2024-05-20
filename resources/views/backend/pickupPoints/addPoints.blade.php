@extends('backend.layouts.app')
@section('content')
<div class="col-lg-6 mx-auto ">
    <div class="card">
        <div class="card-header">Add Points</div>
        <div class="card-body">
            <form action="{{ route('pickup.store') }}" method="POST">
                @csrf
                <input type="text" class="form-control" name="point_name" placeholder="Point Name">
                <button class="btn btn-primary w-100 mt-2">Save Point</button>
            </form>
        </div>
    </div>
</div>
@endsection