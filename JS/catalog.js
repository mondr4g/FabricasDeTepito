function imaxPrice(){
    document.getElementById('imaxPrice').innerHTML = "$" + document.getElementById('iprice').value;    
}

function fmaxPrice(){
    document.getElementById('fmaxPrice').innerHTML = "$" + document.getElementById('fprice').value;    
}

function getFilter() {
    let playera = document.getElementById('playera');
    let pantalon = document.getElementById('pantalon');
    let chamarra = document.getElementById('chamarra');
    let sudadera = document.getElementById('sudadera');
    let abrigo = document.getElementById('abrigo');
    let xs = document.getElementById('xs');
    let s = document.getElementById('s');
    let m = document.getElementById('m');
    let l = document.getElementById('l');
    let xl = document.getElementById('xl');
    let iprice = document.getElementById('iprice').value;
    let fprice = document.getElementById('fprice').value;
    let category = document.getElementById('cat').value;
    let rebajas = document.getElementById('reb').value;
    let lanz = document.getElementById('nLanz').value;
    let filter = '{';
    let all = false;

    if(playera.checked || pantalon.checked || chamarra.checked || sudadera.checked || abrigo.checked || xs.checked || s.checked || m.checked || l.checked || xl.checked)
        all = true;

    if(playera.checked) 
        filter += ' "playera" : true, ';
    else
        filter += ' "playera" : false, ';

    if(pantalon.checked) 
        filter += ' "pantalon" : true, ';
    else
        filter += ' "pantalon" : false, ';

    if(chamarra.checked) 
        filter += ' "chamarra" : true, ';
    else
        filter += ' "chamarra" : false, ';
        
    if(sudadera.checked) 
        filter += ' "sudadera" : true, ';
    else
        filter += ' "sudadera" : false, ';
    
    if(abrigo.checked) 
        filter += ' "abrigo" : true, ';
    else
        filter += ' "abrigo" : false, ';

    if(xs.checked) 
        filter += ' "XS" : true, ';
    else
        filter += ' "XS" : false, ';

    if(s.checked) 
        filter += ' "S" : true, ';
    else
        filter += ' "S" : false, ';
        
    if(m.checked) 
        filter += ' "M" : true, ';
    else
        filter += ' "M" : false, ';
        
    if(l.checked) 
        filter += ' "L" : true, ';
    else
        filter += ' "L" : false, ';
        
    if(xl.checked) 
        filter += ' "XL" : true, ';
    else
        filter += ' "XL" : false, ';
        
    filter += ' "minPrice" : ' + iprice + ', ';
    filter += ' "maxPrice" : ' + fprice + ', ';

    if(category != "")
        filter += ' "categoria" : "' + category + '", ';
    else
        filter += ' "categoria" : "null", '; 

    if(rebajas == "true") 
        filter += ' "rebajas" : ' + rebajas + ', ';
    else
        filter += ' "rebajas" : false, ';

    if(lanz == "true") 
        filter += ' "nuevos" : ' + lanz + ', ';
    else
        filter += ' "nuevos" : false, ';

    filter += ' "band" : ' + all + ' }';
    let obj = filter;
    console.log(obj);
    getRequest(obj);
}

function getRequest(data) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Catalogo/recarga_productos.php", true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            document.getElementById('prod').innerHTML = xhr.responseText;
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("json=" + data);
}


function getRequestComment() {
    let com = document.getElementById('newCommentario').value;
    let id = document.getElementById('id_prod').value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Catalogo/new_comment.php", true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('comentarios').innerHTML = xhr.responseText;
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id_prod=" + id + "&newComment=" + com);
}

function masCant() {
    let value = parseInt(document.getElementById('cant').innerHTML);
    console.log(value);
    
    if(value < 10){
        value++;
        document.getElementById('msgCant').innerHTML = ""; 
    }
    else
        document.getElementById('msgCant').innerHTML = "Max 10 articulos por compra";
    
    document.getElementById('CANT').value = value;
    document.getElementById('cant').innerHTML = value;    
}

function menosCant() {
    let value = parseInt(document.getElementById('cant').innerHTML);
    console.log(value);
    
    if(value > 1){
        value--;
        document.getElementById('msgCant').innerHTML = ""; 
    }
    else
        document.getElementById('msgCant').innerHTML = "Min 1 articulos por compra";

    document.getElementById('CANT').value = value;
    document.getElementById('cant').innerHTML = value;      
}

