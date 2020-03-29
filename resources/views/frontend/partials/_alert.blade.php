@if (session('success'))
    <article class="message is-success">
        <div class="message-header">
            <p>{{session('success')}}</p>
        </div>
    </article>
@endif

@if (session('info'))
    <article class="message is-info">
        <div class="message-header text-center">
            <p class="text-center">{{session('info')}}</p>
        </div>
    </article>
@endif

@if (session('danger'))
    <article class="message is-danger">
        <div class="message-header">
            <p>{{session('danger')}}</p>
        </div>
    </article>
@endif