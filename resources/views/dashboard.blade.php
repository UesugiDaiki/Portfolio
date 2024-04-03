@include('components.admin_html_head')

<body>
    @include('components.admin_header')

    <!-- Portfolio manage section -->
    <section id="portfolio-manage" class="container">
        <h2 class="text-center">Portfolio manage</h2>
        @foreach($portfolios as $portfolio)
            @if($loop->index % 6 == 0)
                <div class="row">
            @endif
            <div class="col-md-2 portfolio-item">
                <a href="/20031223/edit_portfolio/{{ $portfolio->id }}">
                    <div class="item-img">
                        <img src="/storage/{{ $portfolio->id }}/{{ $portfolio->image }}" alt="{{ $portfolio->name }}">
                    </div>
                    <div class="portfolio-caption">
                        <h5>{{ $portfolio->name }}</h5>
                    </div>
                </a>
            </div>
            @if($loop->index % 6 == 5)
                </div>
            @endif
        @endforeach
        <a style="display: flex; justify-content: flex-end;" type="button" class="btn" href="/20031223/add_portfolio">Add Portfolio
            &gt;</a>
    </section>

    <!-- Skill manage section -->
    <section id="skill-manage" class="container mg-bottom-5 pd-bottom-2">
        <h2 class="text-center">Skill manage</h2>
        <form action="delete_skills" method="post">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%"></th>
                        <th scope="col">Skill</th>
                        <th scope="col">Level</th>
                        <th scope="col" style="width: 10%"></th>
                        <th scope="col" style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($skills as $skill)
                        <tr>
                            <th scope="row">{{ $skill->id }}</th>
                            <td>{{ $skill->name }}</td>
                            <td>{{ $skill->level }}</td>
                            <td><input type="checkbox" name="skills[]" value="{{ $skill->id }}"></td>
                            <td><a href="/20031223/edit_skill/{{ $skill->id }}" class="btn-to-a">Edit</a></td>
                        </tr>
                    @endforeach
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button type="submit" class="btn-to-a">Delete checked</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <a style="display: flex; justify-content: flex-end;" type="button" class="btn" href="/20031223/add_skill">Add Skill
            &gt;</a>
    </section>

</body>
</html>
