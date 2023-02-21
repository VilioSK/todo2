<!-- Session messages -->
@if ($message = Session::get('alert.info'))
    <div class="alert alert-primary">
        <div>
            <i class="bi bi-info-circle-fill"></i>
            {{ $message }}
        </div>
    </div>
@endif
@if ($message = Session::get('alert.success'))
    <div class="alert alert-success">
        <div>
            <i class="bi bi-check-circle"></i>
            {{ $message }}
        </div>
    </div>
@endif
@if ($message = Session::get('alert.error'))
    <div class="alert alert-danger">
        <div>
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ $message }}
        </div>
    </div>
@endif
<!-- Form Error List -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Incorrect form data</strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif