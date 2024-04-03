@include('components.html_head')

<body>
    @include('components.header')

    <section class="container pt-5 mg-bottom-3">
        <div class="col-md-8 mg-top-2">
            <h2>Contact</h2>
            <form action="contact_out" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="your-name" class="form-label">お名前</label><span class="required-span">必須</span>
                    <input type="text" class="form-control" id="your-name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="your-email" class="form-label">メールアドレス</label><span class="required-span">必須</span>
                    <input type="email" class="form-control" id="your-email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="your-message" class="form-label">お問い合わせ内容</label><span class="required-span">必須</span>
                    <textarea class="form-control" id="your-message" cols="30" rows="10" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-outline-success">送信</button>
            </form>
        </div>
    </section>
    
    @include('components.footer')
</body>
</html>