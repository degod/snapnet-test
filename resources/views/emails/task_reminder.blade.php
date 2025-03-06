<!DOCTYPE html>
<html>

<head>
    <title>Task Reminder</title>
</head>

<body>
    <h1>Reminder: Your Task is Due Soon</h1>
    <p>Hi {{ $task->user->name }},</p>
    <p>Your task <strong>{{ $task->title }}</strong> is due on {{ $task->due_date }}.</p>
    <p>Make sure to complete it before the deadline!</p>
    <p>Thanks,<br>Your Task Manager</p>
</body>

</html>