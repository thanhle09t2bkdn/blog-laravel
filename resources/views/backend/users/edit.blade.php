@extends('backend.layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit User</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.components.alert')
                </div>
                <div class="col-md-12">
                    <form action="{{ route('backend.users.update', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">User</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('backend.fields.edit.name')
                                            </div>
                                            <div class="col-md-6">
                                                @include('backend.fields.edit.email')
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('backend.fields.edit.password')
                                            </div>
                                            <div class="col-md-6">
                                                @include('backend.fields.edit.password-confirmation')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Action</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('backend.fields.common.action', ['url' => route('backend.users.index')])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Information</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input type="checkbox" id="is_active" class="form-check-input" name="is_active" {{ empty($item->email_verified_at) ? '' : 'checked' }}>
                                                    <label for="is_active">
                                                        Is active?
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role" id="role">
                                                        @foreach($roleNames as $role => $name)
                                                            <option value="{{ $role }}" {{ old('role', $item->role) == $role ? 'selected' : '' }}>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('role'))
                                                        <span class="error invalid-feedback">{{ $errors->first('role') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
