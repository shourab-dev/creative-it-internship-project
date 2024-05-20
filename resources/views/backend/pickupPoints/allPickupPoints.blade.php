@extends('backend.layouts.app')
@section('content')
<div class="text-end mb-3">
    <a href="{{ route('pickup.add') }}" class="btn btn-primary">Add Points</a>
</div>
<table id="" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Point Name</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($points as $key=>$point)

        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $point->point_name }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('pickup.delete', $point->id) }}" class="btn btn-danger">Delete</a>
                </div>
            </td>

        </tr>
        @endforeach


    </tbody>

</table>
@endsection