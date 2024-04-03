@include('components.admin_html_head')

<body>
    @include('components.admin_header')

    <section class="container pt-message">
        <h2>Message</h2>
        @if($empty)
            <p style="margin: 0 5px;">No messages yet</p>
        @else
            <div class="row">
                <div class="col-4">
                    <div id="list-example" class="list-group">

                        <!-- messages -->
                        @foreach($messages as $message)
                            <a class="list-group-item list-group-item-action" href="#{{ $message->id }}">{{ $message->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-8">
                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                        @foreach($messages as $message)
                            <div id="{{ $message->id }}" class="anchor">
                                <h4>{{ $message->name }}</h4>
                                <p><a href="mailto:{{ $message->address }}">{{ $message->address }}</a></p>
                                <p>{{ $message->message }}</p>
                                <hr class="my-4">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </section>
</body>
</html>