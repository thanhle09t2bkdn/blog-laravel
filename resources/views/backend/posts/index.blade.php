@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Posts</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('backend.posts.create') }}" class="btn btn-success">
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
                                    <div class="col-md-6">
                                        @include('backend.fields.search.title')
                                    </div>
                                    <div class="col-md-6">
                                        @include('backend.fields.search.author')
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        @include('backend.fields.common.search')
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
                    @include('backend.components.alert')
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="form-inline">
                                    <div class="form-group">Posts</div>
                                </div>
                            </div>

                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDelete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <form method="POST" action="{{ route('backend.posts.delete') }}" id="form-delete-items">
                                @method('DELETE')
                                @csrf
                                <table class="table table-hovercode" id="table-list">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="check-all" onchange="checkAll()">
                                        </th>
                                        <th>Title</th>
                                        <th>Author</th>
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
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td class="text-center">{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('backend.posts.show', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('backend.posts.edit', $item->id) }}" class="btn btn-sm btn-warning">
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
                                    {{ $list->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('backend.components.confirm-delete')
@endsection
