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
                                    @if ($checkout->is_paid)
                                        <strong class="text-success">Payment Success</strong>
                                    @else
                                        <strong>Waiting for Payment</strong>
                                    @endif
                                </td>
                                <td>
                                    <a href="https://wa.me/087732697337?text=Hallo saya ingin bertanya tentang kelas {{ $checkout->camp->title }}" target="__balnk" class="btn btn-primary">
                                        Contact Support
                                    </a>
                                </td>
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