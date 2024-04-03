@include('components.admin_html_head')

<body>
    @include('components.admin_header')

    <section class="container mg-bottom-3 pd-bottom-2">
        <div class="col-md-8 mg-top-2">
            <h2>Add Portfolio</h2>
            <form action="/add_portfolio" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label><span class="required-span">required</span>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label><span class="required-span">required</span>
                    <input type="file" multiple class="form-control" id="image" name="image[]" accept=".jpg, .jpeg, .png, .gif" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label><span class="required-span">required</span>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="point" class="form-label">Point</label><span class="required-span">required</span>
                    <textarea class="form-control" id="point" name="point" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="skill" class="form-label">Skill</label><span class="required-span">required</span>
                    <select class="form-control" aria-label="Default select example" id="skill" name="skill[]" multiple required>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-success">Add</button>
            </form>
        </div>
    </section>
</body>
</html>