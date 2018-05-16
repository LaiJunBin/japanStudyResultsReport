<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <header>
            @include('components.navbar')
            
        </header>
        <main>
            @yield('content')
            
        </main>
        <footer class="page-footer font-small blue pt-4 mt-4 text-center">
            <a class="github-button" href="https://github.com/xyz607xx" aria-label="Follow @xyz607xx on GitHub">GitHub</a>
            <a class="github-button" href="https://github.com/xyz607xx/japanStudyResultsReport" aria-label="Watch ntkme/github-buttons on GitHub">Watch</a>
            <script src="https://buttons.github.io/buttons.js"></script>
            <script src="https://buttons.github.io/buttons.js"></script>
            <script>
                $(function(){
                    $("footer iframe").css('vertical-align','top');
                    window.onresize = function(){
                        $("footer").css('width',$(this).width());
                    }
                    $("footer").css('width',$(this).width());
                })
            </script>
        </footer>
    </div>
</body>
</html>