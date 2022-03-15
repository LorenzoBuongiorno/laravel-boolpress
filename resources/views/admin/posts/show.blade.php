@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div>
                    {{$post->title}}
                  </div>
                  <div>
                    Author: {{$post->user->name}}
                  </div>
                  <div>
                    E-mail: {{$post->user->email}}
                  </div>
                  <div>
                    Creato il: {{$post->created_at}}
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