@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex">
                    {{$post->title}}
                    <a class="btn btn-link ms-auto" href="{{route('admin.posts.edit', $post->slug)}}">Modifica</a>
                    <span>@include('partials.deleteBtn' , [$post->id , 'route' =>'admin.posts.destroy'])</span>
                  </div>
                  <div>
                    Author: {{$post->user->name}}
                  </div>
                  <div>
                    E-mail: {{$post->user->email}}
                  </div>
                  <div>
                    Creato il: {{$post->created_at->format("d/m/Y")}}
                  </div>
                  <div>
                    @php
                      use Carbon\Carbon;
                    @endphp
                    Ultima modifica: {{$post->updated_at->diffForHumans(Carbon::now())}}
                  </div>
                  <div>
                      Tags:
                      @foreach($post->tags as $tag)
                             <span>#{{ $tag->name }} </span>
                       
                      @endforeach
                  </div>
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