@include('components.html_head')

<body>
    @include('components.header')

    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Portfolio of Uesugi Daiki</h1>
        <p class="lead">Web design and Programing</p>
    </div>

    <!-- About Section -->
    <section id="about" class="container mg-bottom-5">
        <div class="row">
            <div class="col-md-6">
                <!-- About -->
                <h2>About</h2>
                <p>
                    名前 ： 上杉大樹<br>
                    居住地 ： 福岡県<br>
                    2022年福岡情報ITクリエイター専門学校入学。<br>
                    2025年卒業予定。
                </p>
            </div>
            <div class="col-md-6">
                <!-- Skills -->
                <h2>Skills</h2>
                <table class="table">
                    <tbody>
                        @foreach($skills as $skill)
                        @if($skill->level)
                        <tr>
                            <td>{{ $skill->name }}</td>
                            <td>
                                @for($i = 0; $i < $skill->level; $i++)
                                ★
                                @endfor
                                @for($i = 0; $i < 5 - $skill->level; $i++)
                                ☆
                                @endfor
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="container mg-bottom-5">
        <h2>Portfolio</h2>
        <!-- row -->
        @foreach($portfolios as $portfolio)
            @if($loop->index % 3 == 0)
                <div class="row">
            @endif
            <div class="col-md-4 portfolio-item">
                <a href="portfolio/{{ $portfolio->id }}">
                    <div class="card h-100">
                        <div class="item-img">
                            <img src="storage/{{ $portfolio->id }}/{{ $portfolio->image }}" alt="{{ $portfolio->name }}">
                        </div>
                        <div class="portfolio-caption">
                            <h3>{{ $portfolio->name }}</h3>
                            <p>{{ $portfolio->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @if($loop->index % 3 == 2)
                </div>
            @endif
        @endforeach
    </section>
    
    @include('components.footer')
</body>
</html>