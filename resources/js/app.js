require('./bootstrap');

require('alpinejs');

function clickLike() {
    var span = document.getElementById("spanLike");
    var spanStyle = span.style;
    if (spanStyle === "unliked")
    {
        span.style = "app.liked";
    }
    else {
        span.style = "app.unliked";
    }
}

