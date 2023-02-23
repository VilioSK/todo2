<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('Finished task') }}</title>
    </head>
    <body>
        <h2>{{ __('Task is finished') }}</h2>
        <p>
            Hello {{ $user_name }},
        </p>
        <p>
            Task {{ $task_name }} has been marked as finished.
        </p>
    </body>
</html>