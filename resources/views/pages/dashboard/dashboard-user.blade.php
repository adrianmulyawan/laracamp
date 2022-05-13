@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
    <section class="dashboard my-5">
        <div class="container">
            <div class="row text-left">
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        DASHBOARD
                    </p>
                    <h2 class="primary-header ">
                        My Bootcamps
                    </h2>
                </div>
            </div>
            <div class="row my-5">
                <table class="table">
                    <tbody>
                        @forelse ($items as $item)
                            <tr class="align-middle">
                                <td width="18%">
                                    <img src="{{ asset('laracamp-template/assets/images/item_bootcamp.png') }}" height="120" alt="">
                                </td>
                                <td>
                                    <p class="mb-2">
                                        <strong>
                                            {{ $item->camp->title }}
                                        </strong>
                                    </p>
                                    <p>
                                        {{ \Carbon\Carbon::create($item->created_at)->format('M d, Y') }}
                                    </p>
                                </td>
                                <td>
                                    <strong>
                                        Rp {{ number_format($item->camp->price,2,',','.') }}
                                    </strong>
                                </td>
                                <td>
                                    @if ($item->is_paid)
                                        <strong class="text-success">
                                            Payment Success
                                        </strong>
                                    @else
                                        <strong>
                                            Waiting for Payment
                                        </strong>
                                    @endif
                                </td>
                                <td>
                                    <a href="https://wa.me/081258161143?text=Hi, saya ingin bertanya mengenai kelas {{ $item->camp->title }}" class="btn btn-primary" target="__blank">
                                        Contact Support
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="align-middle">
                                <td colspan="5">
                                    You haven't had any checkouts yet!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection