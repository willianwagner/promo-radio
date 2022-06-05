@extends('layouts.blog')

@section('content')

@if(isset($post))

<div class="row">
    <div class="col-md-12">
        <div class="post_img">
            <img src="/uploads/blog/{{$post->imagem}}">
        </div>
    </div>
</div>
<div class="blog_posts stander_blog_single_post">
    <article>
        <h3 class="post_title">
            {{$post->titulo}}
        </h3>
        <div class="post_meta_top">
            <span class="post_meta_category">
                <a href="#">{{$post->categoria}}</a>
            </span>
            <span class="post_meta_date">{{$post->created_at->format('d/m/Y')}}</span>
        </div>
        <div class="post_content">
            <div id="ccontainer">
                @if($post->imagem_interna != '')
                    <img class="pull-right" style="margin-top:7px;margin-left:15px;" src="/uploads/blog/r/{{$post->imagem_interna}}" alt="Card image cap">
                @else
                    <img class="pull-right" style="margin-top:7px;margin-left:15px;" src="/img/anuncie-r.jpeg" alt="Card image cap">
                @endif
                <p class="text-justify" style="white-space:pre-wrap;">{{$post->texto}}</p>
            </div>
        </div>
        
        <div class="separator-line"></div>
    </article>
@else

<div class="row">
    <div class="col-md-12">
        <div class="post_img">
            <img src="site/images/blog.jpg" alt="Card image cap">
        </div>
    </div>
</div>
<div class="blog_posts stander_blog_single_post">
    <article>
        <h3 class="post_title">
            <a href="blog-single-post.html">All the world's waiting for you</a>
        </h3>
        <div class="post_meta_top">
            <span class="post_meta_category">
                <a href="blog-single-post.html">Crispy Food</a>
            </span>
            <span class="post_meta_date">Nov 17, 2020</span>
        </div>
        <div class="post_content">
            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum
                auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit
                amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec
                tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat
                auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                per inceptos himenaeos. Nullam ac urna eu felis dapibus condimentum sit amet a augue.
                Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam
                pharetra, erat sed fermentum feugiat, velit mauris egestas quam.
            </p>

           

            <div class="row">
                <div class="col-md-7">
                    <p>Carried nothing on warrant towards. Polite in of in oh needed itself silent course.
                        Whatever may scarcely had. Assistance travelling especially prosperous appearance
                        mr no itself celebrated. Wanted easily in my called formed suffer. Songs
                        hoped sense as taken ye mirth at. Believe fat how six drawing pursuit minutes
                        far. Same do seen head am part it dear open to.
                    </p>
                    <p> Folly words widow one downs few age every seven. If miss part by fact he park
                        just shew. Discovered had get considered projection who favourable. Necessary
                        up knowledge it tolerably. </p>
                    <p> Unwilling departure education is be dashwoods or an. Use off agreeable law unwilling
                        sir deficient curiosity instantly. Proin condimentum fermentum nunc. Etiam
                        pharetra, erat sed fermentum feugiat, velit mauris egestas quam
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="mb-35px" src="site/images/b3.jpg" alt="Card image cap">
                </div>
            </div>
            <p>Folly words widow one downs few age every seven. If miss part by fact he park just shew.
                Discovered had get considered projection who favourable. Necessary up knowledge it
                tolerably. Unwilling departure education is be dashwoods or an. Use off agreeable
                law unwilling sir deficient curiosity instantly.
            </p>
        </div>
        
        <div class="separator-line"></div>
    </article>
@endif
@endsection