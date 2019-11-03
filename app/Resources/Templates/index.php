<html>
    <head>
        <title>Testowa stronka</title>
        <style>
            body {
                background: black;
                color: green;
            }
        </style>
    </head>

    <body>
        <h1>Siemano</h1>
        <p>Witam w mojej kuchni. {$test}</p>
        {loop:array}

        {endloop:array}
        <p>{$array}</p>
    </body>
</html>