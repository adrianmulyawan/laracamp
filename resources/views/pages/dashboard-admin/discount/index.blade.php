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
                                    <th>User</th>
                                    <th>Camp</th>
                                    <th>Price</th>
                                    <th>Register Data</th>
                                    <th>Paid Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->camp->title }}</td>
                                        <td>Rp {{ number_format($item->camp->price,2,',','.') }}</td>
                                        <td>{{ \Carbon\Carbon::create($item->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <strong>
                                                {{ strtoupper($item->payment_status) }}
                                            </strong>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            Data Not Found!
                                        </td>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection