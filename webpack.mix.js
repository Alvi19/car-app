const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .copy(
        "node_modules/select2/dist/js/select2.min.js",
        "public/js/select2.min.js"
    )
    .copy(
        "node_modules/select2/dist/css/select2.min.css",
        "public/css/select2.min.css"
    );
