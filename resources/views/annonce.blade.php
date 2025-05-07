<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>accueil</title>
    @vite(['resources/css/bootstrap_app.css', 'resources/js/app.js'])
    <style>
        #optionBtn:hover {
            color: #fff !important;
        }
    </style>
</head>
<body>
    @livewire('add-annonce')
</html>