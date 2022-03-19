<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Video Call -- Agora</title>
    <link rel="stylesheet" href="/sample/video_call/assets/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<form name="downloadForm" action="https://demo.cloudpayments.ru/acs" method="POST" >
    <input type="text" name="PaReq" value="+/eyJNZXJjaGFudE5hbWUiOm51bGwsIkZpcnN0U2l4IjoiNDAxMjg4IiwiTGFzdEZvdXIiOiIxODgxIiwiQW1vdW50IjoxMDAuMCwiQ3VycmVuY3lDb2RlIjoiS1pUIiwiRGF0ZSI6IjIwMjItMDMtMTlUMDA6MDA6MDArMDA6MDAiLCJDdXN0b21lck5hbWUiOm51bGwsIkN1bHR1cmVOYW1lIjoicnUtUlUifQ==">
    <input type="text" name="MD" value="1061185242">
    <input type="text" name="TermUrl" value="http://localhost:8000/api/v1/accept-3d-secure/20?hash=tk_e52e7e8df48f2b91c01a533132f24">
    <button type="submit" >adsasd</button>
</form>
<script>

    function myFunction(){
        downloadForm.submit();
    }
</script>
</body>
</html>
