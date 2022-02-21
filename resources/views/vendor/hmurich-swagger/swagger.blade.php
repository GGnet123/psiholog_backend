<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('swagger.title') }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.5.1/swagger-ui.css" >
    <style>
        html
        {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        *,
        *:before,
        *:after
        {
            box-sizing: inherit;
        }

        body
        {
            margin:0;
            background: #fafafa;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.5.1/swagger-ui-bundle.js" charset="UTF-8"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.5.1/swagger-ui-standalone-preset.js" charset="UTF-8"> </script>
<script>
    window.onload = function() {
        // Begin swagger UI call region
        const ui = SwaggerUIBundle({
            url: "{{ config('swagger.url_to_openapi') }}",
            dom_id: '#swagger-ui',
            validatorUrl: null,
            deepLinking: true,
            docExpansion: 'none',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        })

        window.ui = ui
    }
</script>
</body>
</html>
