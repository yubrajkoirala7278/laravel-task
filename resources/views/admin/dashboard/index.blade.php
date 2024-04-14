@extends('admin.layouts.master')
@section('content')
    <div class="container csv-div text-center">
        <h2 class="mb-3">JSON to CSV Converter</h2>
        <form id="json-form" enctype="multipart/form-data">
            <input type="file" class="form-control mb-3" id="json-file" name="json-file">
            <button class="btn btn-success " type="submit" id="convert-btn">Convert to CSV</button>
        </form>
    </div>
@endsection

@section('script')
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
                    },
                    success: function(response) {
                        var downloadLink = document.createElement('a');
                        downloadLink.href = '/admin/download-csv?csv_file=' + response.csv_file;
                        downloadLink.download = 'file.csv';
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
