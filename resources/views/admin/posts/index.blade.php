@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card dark-theme">
                <div class="card-header d-flex">
                    Lista Post

                    <a class="ms-auto" href="{{route('admin.posts.create')}}">Add</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                            <li class="list-group-item dark-theme">{{$post->title}}
                            <a href="{{route('admin.posts.show', $post->slug)}}">Show</a>
                            @if($post->trashed())
                                <span class="float-end">@include('partials.deleteBtn' , [$post->id , 'route' =>'admin.posts.destroy'])</span>
                                <span class="badge bg-secondary">SoftDeleted</span>
                            @endif
                        </li>
                        @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection