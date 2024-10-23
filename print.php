<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Page in Landscape with Print-Only Content</title>
    <style>
    @media print {

        /* Force landscape orientation */
        @page {
            size: landscape;
        }

        /* Hide elements normally visible on screen */
        .no-print {
            display: none;
        }

        /* Show elements only during printing */
        .print-only {
            display: block;
        }
    }

    /* Default visibility on screen */
    .print-only {
        display: none;
    }
    </style>
</head>

<body>
    <h1>This page will print in landscape orientation</h1>
    <p>This content will be visible on both the screen and in print.</p>

    <div class="no-print">
        <p>This content is only visible on the screen and will not appear when printed.</p>
    </div>

    <div class="print-only">
        <p>This content will only appear when printing.</p>
    </div>

    <!-- Trigger print -->
    <button onclick="window.print()">Print this page</button>

    <script>
    // Optionally trigger print on page load
    // window.onload = function() {
    //     window.print();
    // };
    </script>
</body>

</html>