@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <section class="dashboard my-5">
        <div class="container">
            <div class="row text-left">
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        DASHBOARD ADMIN
                    </p>
                    <h2 class="primary-header ">
                        Manage Data Camp Customer
                    </h2>
                </div>
            </div>
            <div class="row my-5 table-responsive">
                @include('components.alert')
                <table class="table table-hover table">
                    <tbody>
                        @forelse ($checkouts as $checkout)
                            <tr class="align-middle">
                                <td width="18%">
                                    <img src="{{ asset('/assets/images/item_bootcamp.png') }}" height="120" alt="">
                                </td>
                                <td>
                                    <strong>{{ $checkout->user->name }}</strong>
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
                                        <strong class="badge bg-success">Terbayar</strong>
                                    @else
                                        <strong class=" badge bg-warning">Menunggu</strong>
                                    @endif
                                </td>
                                <td>
                                    <p class="mb-2">
                                        <strong>{{ $checkout->updated_at ? 'Di update' : '' }}</strong>
                                    </p>
                                    <p>
                                        {{ $checkout->updated_at ? $checkout->updated_at->format('M d, Y - H:i') : '' }}
                                    </p>
                                </td>
                                <td>
                                    @if (!$checkout->is_paid)
                                        <form action="{{ route('admin.update.paid', $checkout->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">Set to paid</button>
                                        </form>
                                    @elseif($checkout->is_paid)
                                        <form action="{{ route('admin.update.cancle', $checkout->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-secondary btn-sm">Cancle Paid</button>
                                        </form>
                                    @endif
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