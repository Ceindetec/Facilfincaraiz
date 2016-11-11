function format(input){
    var num = input.value.replace(/\./g,"");
    if(!isNaN(num)){
        num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
        num = num.split("").reverse().join("").replace(/^[\.]/,"");
        input.value = num;
    }else{
        input.value = input.value.replace(/[^\d\.]*/g,"");
    }
}

function justNumbers(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 8)
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}

function enmascarar(valor){
    valor = valor+'';
    var configurado = "";
    var i= valor.length;
    do{
        i=i-3;
        if (i>0)
            configurado = "." + valor.substring(i, i+3)+configurado;
        else
            configurado = valor.substring(i, i+3)+configurado;
    }while(i>0);
    return(configurado);
}

function desenmascarar(valor){
    valor = valor+'';
    valor = valor.replace(/[.]/gi, "");
    valor = valor.replace("$","");
    return valor;
}

function ucWords(string){
    var arrayWords;
    var returnString = "";
    var len;
    arrayWords = string.split(" ");
    len = arrayWords.length;
    for(i=0;i < len ;i++){
        if(i != (len-1)){
            returnString = returnString+ucFirst(arrayWords[i])+" ";
        }
        else{
            returnString = returnString+ucFirst(arrayWords[i]);
        }
    }
    return returnString;
}

function ucFirst(string){
    return string.substr(0,1).toUpperCase()+string.substr(1,string.length).toLowerCase();
}

function justletters(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    patron =/[A-Za-zñÑ\s]/;
    if (keynum == 8)
        return true;
    te = String.fromCharCode(keynum);
    return patron.test(te);
}

function numerosFloat(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum == 46 || keynum == 44){
        if (e.target.value.indexOf(",") == -1){
            e.target.value=e.target.value+",";
            return false
        }
    }
    if (e.target.value.indexOf(",") != -1){
        if(e.target.value.length - e.target.value.indexOf(",") >2)
            return false;
    }
    if (keynum == 8)
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}