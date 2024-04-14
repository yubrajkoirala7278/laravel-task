<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- jquery cdn --}}
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <title>JSON to CSV Export</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF token meta tag -->
</head>

<body>

    <form id="json-form" enctype="multipart/form-data">
        <input type="file" id="json-file" name="json-file">
        <button type="submit" id="convert-btn">Convert to CSV</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#json-form').submit(function(event) {
                event.preventDefault();

                var formData = new FormData();
                formData.append('json-file', $('#json-file')[0].files[0]);

                $.ajax({
                    url: '/admin/convert-to-csv',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, // Include CSRF token in headers
                    success: function(response) {
                        window.location.href = '/admin/download-csv?csv_file=' + response
                            .csv_file;
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
