@include('components.admin_html_head')

<body>
    @include('components.admin_header')

    <section class="container mg-bottom-3">
        <div class="col-md-8 mg-top-2">
            <h2>Edit skill</h2>
            <form class="mg-bottom-1" action="?" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label><span class="required-span">required</span>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <input type="number" class="form-control" min="1" max="5" id="level" name="level" value="{{ $skill->level }}">
                </div>
                <button type="submit" class="btn btn-outline-success" formaction="/edit_skill/{{ $skill->id }}">Edit</button>
                <button type="submit" class="btn btn-outline-danger" formaction="/delete_skill/{{ $skill->id }}">Delete</button>
            </form>
        </div>
    </section>
</body>
</html>