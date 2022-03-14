@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                  {{$post->title}}
                </div>

                <div class="card-body">
                     <form action="{{ route('admin.posts.store') }}" method="post">
                        @csrf
                          <div class="mb-3">
                            {{$post->content}}
                          </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection