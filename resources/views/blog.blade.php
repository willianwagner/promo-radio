@extends('layouts.blog')

@section('content')
<div class="row blog_posts stander_blog one_colo_stander_blog">
        @foreach($posts as $post)
        <div class="col-md-6">
            <article>
                <div class="post_img">
                    <a href="/blog/{{$post->id}}">
                        <img src="/uploads/blog/{{$post->imagem}}">
                    </a>
                </div>
                <h5 class="post_title">
                    <a href="/blog/{{$post->id}}">{{$post->titulo}}</a>
                </h5>
                <div class="post_meta_top">
                    <span class="post_meta_category">
                        <a href="/categoria-blog/{{$post->categoria}}">{{$post->categoria}}</a>
                    </span>
                    <span class="post_meta_date">{{$post->created_at->format('d/m/Y')}}</span>
                </div>
                <div class="post_content">
                    <p><a href="/blog/{{$post->id}}">{{str_limit($post->texto, 100,'...')}}</a></p>
                </div>
            </article>
        </div>
        @endforeach
</div>
        <div class="clearfix"></div>
        <div class="row text-center">
            <div class="pagination-wrapper" style="margin:0 auto;"> {!! $posts->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
        <style>
            .pagination span {
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 0;
                width: 40px;
                height: 40px;
                margin-right: 11px;
                line-height: 40px;
                text-align: center;
                position: relative;
                display: inline-block;
                background-color: #f6f6f6;
                color: #a7a6a6;
                border: none;
                font-weight: 500;
                font-size: 14px;
                padding: 0;
            }
        </style>
@endsection