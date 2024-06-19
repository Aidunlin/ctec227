<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
<h1>Welcome, {{ $name }}!</h1>
    <p>You are {{ $age }} years old.</p>

    <!-- Conditional Statements -->
    @if($age > 50)
        <p>You are eligible for the senior discount!</p>
    @else
        <p>You are not eligible for the senior discount.</p>
    @endif

    <!-- Variable Assignment -->
    @set($greeting = "Hello")

    <p>{{ $greeting }}, {{ $name }}! Here are your items:</p>

    <!-- Foreach Loop -->
    <h2>Your Items:</h2>
    <ul>
        @foreach($items as $item)
            @if($item == 'Item 2')
                @comment This item is skipped @endcomment
                @continue
            @endif
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    <!-- Custom Function Call -->
    <p>Shouted Name: @call(custom_function($name))</p>

    <!-- Including a Partial Template -->
    @include('footer')
</body>

</html>