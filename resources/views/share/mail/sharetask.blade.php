<!DOCTYPE html>
<html>
    <head>
        <title>Task shared</title>
    </head>
    <body>
        <h2>{{ Task has been shared }}</h2>
        <p>
            Hello {{ $user_owner }},
        </p>
        <p>
            Task {{ $task_name }} has been shared with user {{ $user_name }}.
        </p>
    </body>
</html>