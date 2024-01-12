<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Bootstrap 4 Responsive Sidebar</title>
    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    .wrapper {
        display: flex;
        height: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #343a40;
        /* Dark background color */
        padding: 20px;
        border-right: 1px solid #606060;
        /* Border color */
    }

    .sidebar a {
        color: #fff;
        /* Text color */
        text-decoration: none;
        padding: 10px 0;
        display: block;
    }

    .sidebar a:hover {
        background-color: #505050;
        /* Hover background color */
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .wrapper {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            margin-bottom: 10px;
            border: none;
            /* Remove border on smaller screens */
        }
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav class="sidebar">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
                aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse" id="sidebarCollapse">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Home</a>
                    <a href="#" class="list-group-item list-group-item-action">About</a>
                    <a href="#" class="list-group-item list-group-item-action">Services</a>
                    <a href="#" class="list-group-item list-group-item-action">Contact</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <h2>Main Content</h2>
            <p>This is the main content area. You can add your page content here.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>