<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (auth()->user()->is_admin == true)
        <a href="{{ route('products.create') }}">create product</a>    
    @endif
    <table>
        <thead>
            <tr>
                <td>name</td>
                <td>description</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                </tr>
                
            @empty
                <tr>
                    <td>
                        No data    
                    </td>
                </tr>    
            @endforelse
                
           
        </tbody>
    </table>
</body>
</html>