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
<form name="downloadForm" action="https://demo.cloudpayments.ru/acs" method="POST" ">
    <input type="text" name="PaReq" value="+/eyJNZXJjaGFudE5hbWUiOm51bGwsIkZpcnN0U2l4IjoiNDI0MjQyIiwiTGFzdEZvdXIiOiI0MjQyIiwiQW1vdW50IjoxMC4wLCJDdXJyZW5jeUNvZGUiOiJSVUIiLCJEYXRlIjoiMjAyMi0wMy0xOFQwMDowMDowMCswMDowMCIsIkN1c3RvbWVyTmFtZSI6bnVsbCwiQ3VsdHVyZU5hbWUiOiJydS1SVSJ9">
    <input type="text" name="MD" value="1059990963">
    <input type="text" name="TermUrl" value="http://localhost:8000/cloud-pay">
    <button type="submit" >adsasd</button>
</form>
<script>

    function myFunction(){
        downloadForm.submit();
    }
</script>
</body>
</html>
