@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Information</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-default mr-2">Back</a>
                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    @include('components.alert')
                </div>
                <div class="{{ $item->role == \App\Models\User::ROLE_USER ? 'col-md-6' : 'col-md-12' }}">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>
                                                <strong>Name:</strong>
                                                {{ $item->name }}
                                            </p>
                                            <p>
                                                <strong>Email:</strong>
                                                {{ $item->email }}
                                            </p>
                                            <p>
                                                <strong>Is verified?</strong>
                                                @if ($item->email_verified_at)
                                                    <i class="fas fa-check-square"></i>
                                                @else
                                                    <i class="far fa-square"></i>
                                                @endif
                                            </p>
                                            <p>
                                                <strong>Role:</strong>
                                                {{ $item->role_name }}
                                            </p>
                                            <p>
                                                <strong>Login by:</strong>
                                                {{ $item->type_name }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>
                                                <strong>Created at:</strong>
                                                {{ date('M d, Y', strtotime($item->created_at)) }}
                                            </p>
                                            <p>
                                                <strong>Updated at:</strong>
                                                {{ date('M d, Y', strtotime($item->updated_at)) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($item->role == \App\Models\User::ROLE_USER)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Information</h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    <strong>Birthday:</strong>
                                    @if (!empty($info))
                                        {{ $info->birthday }}
                                    @endif
                                </p>
                                <p>
                                    <strong>Gender:</strong>
                                    @if (!empty($info))
                                        {{ $info->gender_name }}
                                    @endif
                                </p>

                                <hr>

                                <p><strong>Kinds:</strong></p>
                                @if (!empty($info))
                                    @foreach($info->kinds as $key => $kind)
                                        <p>- {{ $kind->name }}</p>
                                    @endforeach
                                @endif

                                <p><strong>Brands:</strong></p>
                                @if (!empty($info))
                                    @foreach($info->brands as $key => $brand)
                                        <p>- {{ $brand->name }}</p>
                                    @endforeach
                                @endif


                                <p><strong>Cards:</strong></p>
                                @if (!empty($info))
                                    @foreach($info->cards as $key => $card)
                                        <p>
                                            - {{ $card->bank->name }} | {{ $card->name }}
                                        </p>
                                    @endforeach
                                @endif

                                <p><strong>Memberships:</strong></p>
                                @if (!empty($info))
                                    @foreach($info->memberships as $key => $membership)
                                        <p>
                                            - {{ $membership->organization->name }} | {{ $membership->name }}
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
