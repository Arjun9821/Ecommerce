<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @include('home.css')
    <style type="text/css">
        .div_center{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        table{
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }
        th{
            border: 2px solid skyblue;
            background-color: black;
            color: white;
            font-size: 19px;
            font-weight: bold;
            text-align: center;
        }
        td{
            border: 1px solid skyblue;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->

    @include ('home.header')

    <div class="div_center">
        <table>
            <tr>
                <th>Product Name</th>
                <th>Product price</th>
                <th>Delivery Status</th>
                <th>Product Image</th>
            </tr>

            @foreach($order as $orders)
            <tr>
                <td>{{ $orders -> product -> title }}</td>
                <td>{{ $orders -> product -> price }}</td>
                <td>{{ $orders -> status }}</td>
                <td>
                    <img height="200" width="300" src="products/{{ $orders -> product -> image }}">
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

@include ('home.info')

</body>
</html>