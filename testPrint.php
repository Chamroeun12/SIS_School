<?php
// Your PHP logic (fetching data, etc.) goes here.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Page Example</title>

    <!-- Print-specific CSS -->
    <style>
    @media print {

        /* Hide elements that should not be printed */
        .no-print,
        .header,
        .footer {
            display: none !important;
        }

        /* Ensure that printed content fits nicely on the page */
        body {
            margin: 0;
            padding: 0;
        }
    }

    /* Style for screen (non-print) view */
    body {
        font-family: Arial, sans-serif;
    }

    .header,
    .footer {
        background-color: #f8f9fa;
        padding: 10px;
    }

    .content {
        padding: 20px;
    }

    .no-print {
        background-color: #f0f0f0;
        padding: 10px;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <!-- Content to be printed -->
    <div class="header">
        <h1>This is a header</h1>
        <p>It will not be printed.</p>
    </div>

    <div class="content">
        <h2>Content to Print</h2>
        <p>This section will be printed. It contains all the important information.</p>
    </div>

    <!-- Content not to be printed -->
    <div class="no-print">
        <h3>Additional Information</h3>
        <p>This section will NOT be printed. You can use this area for things like form inputs or extra buttons.</p>
    </div>

    <div class="footer">
        <p>This is a footer. It will not be printed.</p>
    </div>

    <!-- JavaScript to trigger print action -->
    <script>
    function printPage() {
        window.print();
    }
    </script>

    <!-- Print button (not to be printed) -->
    <button class="no-print" onclick="printPage()">Print this page</button>

</body>

</html>