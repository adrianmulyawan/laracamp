@extends('layouts.app')

@section('title', 'Discount Management')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-12 col-md-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        Discount Management
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex flex-row-reverse">
                                <a href="{{ route('discount.create') }}" class="btn btn-sm btn-primary">
                                   + Create Discount
                                </a>
                            </div>
                        </div>
                        @include('includes.alert')
                        <table class="table table-responsive mt-2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Discount Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Percentage</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 0 ?>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $counter += 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">
                                                {{ $item->code }}
                                            </span>
                                        </td>
                                        <td>{!! $item->description !!}</td>
                                        <td class="text-center">{{ $item->percentage }}%</td>
                                        <td>
                                            <a href="{{ route('discount.edit', $item->id) }}" class="btn btn-warning">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('discount.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            Data Discount Not Found!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection