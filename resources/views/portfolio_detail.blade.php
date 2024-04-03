@include('components.html_head')

<body>
    @include('components.header')

    <section id="project-details" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- 画像 -->
                <div class="mb-5 mg-top-6">
                    <h2>Screenshots</h3>
                    <div id="carouselExample" class="carousel slide carousel-dark">
                        <div class="carousel-inner">
                            @foreach($image_paths as $image_path)
                                <div class="carousel-item @if($loop->index == 0)active @endif">
                                    <img src="../storage/{{ $id }}/{{ $image_path->path }}" class="d-block w-100" alt="portfolio image {{ $loop->index }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- 詳細 -->
                <div class="mg-bottom-2">
                    @isset($portfolio[0]->url)
                        <h2><a href="{{ $portfolio[0]->url }}" class="project-title">{{ $portfolio[0]->name }}</a></h2>
                    @else
                        <h2>{{ $portfolio[0]->name }}</h2>
                    @endisset
                    <p>{{ $portfolio[0]->point }}</p>
                    <p>
                        @foreach($skills as $skill)
                            {{ $skill->skill_name }} / 
                        @endforeach
                    </p>
                </div>
                <div class="mg-bottom-3">
                    @isset($portfolio[0]->file_path)
                        <a href="../storage/{{ $id }}/{{ $portfolio[0]->file_path }}" download>download</a>
                    @endisset
                </div>
            </div>
        </div>
        <a type="button" class="btn" href="/">&lt; Back to Portfolio</a>
    </section>
    
    @include('components.footer')
</body>
</html>