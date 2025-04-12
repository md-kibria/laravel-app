@extends('layouts.admin.master')
@section('title')
    Blog Posts
@endsection
@section('css')
    <!-- extra css -->
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/mermaid.min.css') }}">
@endsection
@section('content')
    <x-breadcrumb title="Blog Posts" pagetitle="Posts" />

    <div class="row">

        <!-- end col -->
        <div class="col-xl-12 col-lg-12">
            <div class="row g-4 mb-4">
                <div class="col-sm-auto">
                    <div>
                        <a href="/admin/posts/create" class="btn btn-success"><i
                                class="ri-add-line align-bottom me-1"></i> Add Post</a>
                    </div>
                </div>
            </div>

            {{-- <div id="product-list" class="gridjs-border-none mb-4"></div> --}}
            <div class="table-responsive table-card m-1">
                <table class="table table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            {{-- <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                    <label class="form-check-label" for="cardtableCheck"></label>
                                </div>
                            </th> --}}
                            <th scope="col">Id</th>
                            <th scope="col">Post Title</th>
                            <th scope="col">Views</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Publish</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="align-middle">
                                    <a href="#" class="fw-semibold">#{{ $post->id }}</a>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2 avatar-sm">
                                            <div class="avatar-title bg-light rounded">
                                                @if($post->thumbnail)
                                                    <img src="{{ asset('/storage/' . $post->thumbnail) }}" alt="" class="avatar-xs" />
                                                @else
                                                <span class="text-body-secondary text-center fs-6" style="line-height: 13px;"><small>No <br/>Thumb</small></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $post->title }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ (int) $post->views }}</td>
                                <td class="align-middle">{{ (int) $post->comments }}</td>
                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</td>
                                <td class="align-middle"><span
                                        class="badge @if ($post->status === 'published') bg-success @else bg-danger @endif text-capitalize">{{ $post->status }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        <a href="/admin/posts/{{ $post->id }}/edit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="#delteModal-{{$post->id}}" data-bs-toggle="modal" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-2">
                <p class="text-muted mb-0">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                </p>
                {{ $posts->links() }}
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- removeItemModal -->
    @foreach ($posts as $post)
    <div id="delteModal-{{$post->id}}" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="close-removecategoryModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-15">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Post?</p>
                        </div>
                    </div>
                    <form class="d-flex gap-2 justify-content-center mt-4 mb-2" action="/admin/posts/{{$post->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn w-sm btn-light btn-hover"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn w-sm btn-danger btn-hover" id="remove-category">Yes, Delete
                            It!</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
@section('scripts')
    <!-- nouisliderribute js -->
    <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script>

    <!-- gridjs js -->
    <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

    <!-- Product list init -->
    <script src="{{ URL::asset('build/js/backend/product-list.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
