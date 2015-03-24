@foreach (Alert::get() as $alert)
    <div class="alert alert-{{ $alert->class }} alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $alert->message }}</p>
    </div>
@endforeach
