@extends('layouts.app', ['title' => 'Dashboard'])
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
                @include('components.alert')
                <table class="table">
                    <tbody>
                        @forelse ($checkouts as $checkout)
                            <tr class="align-middle">
                                <td width="18%">
                                    <img src="{{ asset('/assets/images/item_bootcamp.png') }}" height="120" alt="">
                                </td>
                                <td>
                                    <p class="mb-2">
                                        <strong>{{ $checkout->camp->title }}</strong>
                                    </p>
                                    <p>
                                        {{ $checkout->created_at->format('M d, Y - H:i') }}
                                    </p>
                                </td>
                                <td>
                                    <strong>${{ $checkout->camp->price }},000</strong>
                                </td>
                                <td>
                                    <strong class="text-success">{{ $checkout->payment_status }}</strong>
                                </td>
                                @if ($checkout->payment_status == 'waiting')
                                    <td>
                                        <a href="{{ $checkout->midtrans_url }}" target="__balnk" class="btn btn-primary">
                                            get payment
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-danger text-center">
                                        <h5>No Data</h5>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection