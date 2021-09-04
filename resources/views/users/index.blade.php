@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Create
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-search"></i> Search
                            </h3>
                        </div>
                        <form id="form-search">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        @include('fields.search.name')
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ request()->get('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control select2" id="role" name="role">
                                                <option value="">- All -</option>
                                                @foreach($roleNames as $role => $name)
                                                    <option value="{{ $role }}"
                                                        {{ request()->get('role') == $role ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        @include('fields.common.search')
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('components.alert')
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="form-inline">
                                    <div class="form-group">
                                        Form
                                    </div>
                                </div>
                            </div>

                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDelete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <form method="POST" action="{{ route('users.delete') }}" id="form-delete-items">
                                @method('DELETE')
                                @csrf
                                <table class="table table-hovercode" id="table-list">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="check-all" onchange="checkAll()">
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Created at</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="sortable">
                                    @forelse ($list as $item)
                                        <tr class="ui-state-default">
                                            <td>
                                                <input type="checkbox" onchange="checkItem()" value="{{ $item->id }}" name="id[]">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center">{{ $item->role_name }}</td>
                                            <td class="text-center">{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="ui-state-default text-center">No data for this time period.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="px-3">{{ $list->total() }} result(s)</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-3 float-right">
                                    {{ $list->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.confirm-delete')
@endsection
