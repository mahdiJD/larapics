<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">

    <title>Blade Components</title>
</head>
<body>
{{--    @php--}}
{{--        $var = "heart.svg"--}}
{{--    @endphp--}}
{{--    <x-icon :src="$var" />--}}
{{--    <x-ui.button />--}}

<x-alert id="my-alert" type="success" dismissible class="mt-4 mb-4" role="disable">
    <x-slot name="title">
        My Message
    </x-slot>
    <x-slot:message>
        The slot has been submitted!
    </x-slot:message>
</x-alert>
</body>
</html>
