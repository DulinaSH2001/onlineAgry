<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Real-Time Search Bar</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
    .search-container {
        position: relative;
        display: inline-block;
    }

    #results-container {
        position: absolute;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-top: none;
        display: none;
    }

    #results {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    #results li {
        padding: 8px;
        cursor: pointer;
    }

    #results li:hover {
        background-color: #f4f4f4;
    }
    </style>
</head>

<body>

    <div class="search-container">
        <input type="text" id="search" class="form-control" placeholder="Type to search">
        <div id="results-container" class="dropdown-menu">
            <ul id="results" class="list-group"></ul>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var searchTerm = $(this).val();

            // Make AJAX request to the PHP backend
            $.ajax({
                url: 'search.php',
                type: 'GET',
                data: {
                    term: searchTerm
                },
                success: function(data) {
                    // Update the results container with the retrieved data
                    $('#results').html(data);

                    // Show/hide the results container based on the number of results
                    $('#results-container').toggle(data.length > 0);
                }
            });
        });

        // Handle clicks on the search results
        $('#results').on('click', 'li', function() {
            var selectedResult = $(this).text();
            $('#search').val(selectedResult);
            $('#results-container').hide();
        });
    });
    </script>

</body>

</html>