@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-12 col-md-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        My Camps
                    </div>
                    <div class="card-body">
                        @include('includes.alert')
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Camp</th>
                                    <th>Price</th>
                                    <th>Register Data</th>
                                    <th>Paid Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->camp->title }}</td>
                                        <td>Rp {{ number_format($item->camp->price,2,',','.') }}</td>
                                        <td>{{ \Carbon\Carbon::create($item->created_at)->format('d M Y') }}</td>
                                        <td>
                                            @if ($item->is_paid == 1)
                                                <span class="badge bg-success">
                                                    PAID
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    UNPAID
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="" method="POST">
                                                @csrf
                                                <button class="btn btn-primary btn-sm">Set to Paid</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            Data Not Found!
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