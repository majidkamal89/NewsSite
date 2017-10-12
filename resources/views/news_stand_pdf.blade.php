<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LassLister</title>
    <style>
        .container {
            min-height: 550px;
            width: 1550px;
        }

        table.scroll {
            width: 100%;
        }

        h3 {
            margin-top: 0px !important;
        }

        .pad-left {
            padding-left: 0px !important;
        }

        .pad-right {
            padding-right: 0px !important;
        }

        .col-md-4 {
            width: 100%;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table {
            margin-bottom: 20px;
            max-width: 100%;
            width: 100%;
        }

        table {
            background-color: transparent;
        }

        .table-css {
            text-align: center;
            border: 1px solid rgb(198, 197, 194);
            border-left: 1px solid rgb(198, 197, 194);
            border-bottom: 1px solid rgb(198, 197, 194);
            padding: 7px;
        }

        .table-header {
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid rgb(198, 197, 194);
            padding: 7px;
        }

        h2 {
            margin-bottom: 5px !important;
            margin-top: 5px !important;
            font-weight: normal !important;
        }

        h1 {
            margin-bottom: 10px !important;
        }
        .page-break {
             page-break-after: always;
        }
    </style>
</head>
<body class="container">
<div class="row page-break" style="width:800px;padding: 0 4px 0 4px;">

    @foreach($newsData as $data)
        <div style="float:left; margin-top: 50px;">
            <h1>{!! ucfirst($data->title) !!}</h1>
            <h5>{!! date('F d, Y', strtotime($data->created_at)) !!}</h5>
            @if(!empty($data->image))
                <img src="{{ public_path('/uploads/news/'.$data->image.'') }}" style="width: 150px;"
                     alt="No Image"/>
            @endif
            <div style="word-wrap: break-word; width: 700px;">{!! $data->description !!}</div>
        </div>
    @endforeach
</div>
</body>
</html>
