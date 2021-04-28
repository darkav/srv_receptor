
this.addEventListener('message', (e) => {
    var dato = JSON.parse(e.data);
        // a todas las 
    console.log("verificando dato",dato);
    var nodo = {};
    nodo.datos = dato;
    fetch("../api/sucursal/v1/ping/pong", {
        method: "POST",
        headers:{
            "Accept": 'application/json',
            "Content-Type": "application/json"
        },
        body: JSON.stringify(nodo)
    }).then(response => response.json())
    .then((data) => {
        var nodo = {};
        nodo.myAccion=1
        nodo.datos = data;
        postMessage(JSON.stringify(nodo));
    })
    
    
});


