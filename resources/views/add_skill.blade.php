@include('components.admin_html_head')

<body>
    @include('components.admin_header')

    <section class="container mg-bottom-3 pd-bottom-2">
        <div class="col-md-8 mg-top-2">
            <h2>Add skill</h2>
            <form action="/add_skill" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label><span class="required-span">required</span>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <input type="number" class="form-control" min="1" max="5" id="level" name="level">
                </div>
                <button type="submit" class="btn btn-outline-success">Add</button>
            </form>
        </div>
    </section>
</body>
</html>