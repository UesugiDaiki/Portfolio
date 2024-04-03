@include('components.html_head')

<body>
    @include('components.header')

    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold text-body-emphasis">404 NOT FOUND</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">お探しのページは見つかりませんでした。</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <a class="btn btn-outline-secondary btn-lg px-4" href="/" role="button">Home</a>
            </div>
        </div>
    </div>
    
    @include('components.footer')
</body>
</html>