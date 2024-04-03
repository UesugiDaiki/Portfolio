@include('components.admin_html_head')

<body>
    @include('components.admin_header')

    <section class="container mg-bottom-3 pd-bottom-2">
        <div class="col-md-8 mg-top-2">
            <h2>Edit work</h2>
            <form class="mg-bottom-1" action="?" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label><span class="required-span">required</span>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $portfolio[0]->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Delete Image</label>

                    <div class="col-md-4 delete-image-check">
                        @foreach($image_paths as $image_path)
                            <div class="card">
                                <input class="position-absolute form-check-input" type="checkbox" name="delete-image[]" id="image{{ $loop->index + 1 }}" value="{{ $image_path->path }}">
                                <label for="image{{ $loop->index + 1 }}" class="form-label"><img class="card-img-top" src="/storage/{{ $portfolio[0]->id }}/{{ $image_path->path }}" alt="{{ $portfolio[0]->name }}_image1"></label>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Add Image</label>
                    <input type="file" multiple class="form-control" id="image" name="image[]" accept=".jpg, .jpeg, .png, .gif">
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $portfolio[0]->url }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label><span class="required-span">required</span>
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ $portfolio[0]->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="point" class="form-label">Point</label><span class="required-span">required</span>
                    <textarea class="form-control" id="point" name="point" rows="5" required>{{ $portfolio[0]->point }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="skill" class="form-label">Skill</label><span class="required-span">required</span>
                    <select class="form-control" aria-label="Default select example" id="skill" name="skill[]" multiple required>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" @if(in_array($skill->id, $portfolio_skill_ids)) selected @endif>{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-success" formaction="/edit_portfolio/{{ $portfolio[0]->id }}">Edit</button>
                <button type="submit" class="btn btn-outline-danger" formaction="/delete_portfolio/{{ $portfolio[0]->id }}">Delete</button>
            </form>
        </div>
    </section>
</body>
</html>