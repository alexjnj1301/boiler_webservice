let color = 'black';

document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:8000/api/pixels')
        .then(response => response.json())
        .then(data => {
                data.forEach(pixel => {
                    var test = document.createElement('div');
                    test.style.position = 'absolute';
                    test.style.top = pixel.y + 'px';
                    test.style.left = pixel.x + 'px';
                    test.style.zIndex = '9999';
                    test.style.width = '10px';
                    test.style.height = '10px';
                    test.style.backgroundColor = pixel.color;

                    var currentDiv = document.getElementById("div1");
                    document.body.insertBefore(test, currentDiv);
                });
            }
        )
        .catch(error => console.error(error));
});

function methode() {
    var e = window.event;

    var posX = e.clientX;
    var posY = e.clientY;

    var test = document.createElement('div');
    test.style.position = 'absolute';
    test.style.top = posY + 'px';
    test.style.left = posX + 'px';
    test.style.zIndex = '9999';
    test.style.width = '10px';
    test.style.height = '10px';
    test.style.backgroundColor = color;

    var currentDiv = document.getElementById("merde");
    document.body.insertBefore(test, currentDiv);

    let pixel = {
        x: posX,
        y: posY,
        color: color
    };

    console.log(pixel);

    const options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(
            pixel
        )
    };

    console.log(options);

    fetch('http://localhost:8000/api/pixels', options)
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));
}

function changecolor() {
    color = colorpicker.value;
}
