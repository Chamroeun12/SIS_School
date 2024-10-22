<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Example</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        color: black;
        /* Text color */
    }

    .color-section {
        color: blue;
        /* Color for this section */
    }

    @media print {
        body {
            color: black;
            /* Ensure print version uses black text */
        }

        .no-print {
            display: none;
            /* Hide elements not needed in print */
        }
    }
    </style>
</head>

<body>
    <h1>Print Color Example</h1>
    <p>This is a sample paragraph.</p>
    <div class="color-section">This section is blue.</div>
    <button onclick="window.print()">Print this page</button>
</body>

</html>