<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Suggestions</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
</head>
<body>

<form action="dashboard.php" method="POST">
    <input type="text" name="task_name" id="task_name" placeholder="Enter task name" autocomplete="off">
    <div id="suggestions" style="border: 1px solid #ccc; display: none;"></div> <!-- Suggestions container -->
    <button type="submit">Add Task</button>
</form>

<script>
    $(document).ready(function() {
        $('#task_name').on('input', function() {
            var task_name = $(this).val();
            if (task_name.length > 2) {  // Only send request if input length is greater than 2
                $.ajax({
                    url: 'get_suggestions.php',  // The PHP script that will process the task name
                    method: 'POST',
                    data: { task_name: task_name },
                    success: function(response) {
                        var suggestions = JSON.parse(response);  // Parse the returned JSON data
                        if (suggestions.length > 0) {
                            $('#suggestions').empty().show();
                            suggestions.forEach(function(suggestion) {
                                $('#suggestions').append('<div>' + suggestion + '</div>');
                            });
                        } else {
                            $('#suggestions').hide();  // Hide if no suggestions
                        }
                    }
                });
            } else {
                $('#suggestions').hide();  // Hide suggestions when input is short
            }
        });

        // Select suggestion on click
        $(document).on('click', '#suggestions div', function() {
            $('#task_name').val($(this).text());
            $('#suggestions').hide();
        });
    });
</script>

</body>
</html>
