function mostrar(){
    let tipo = document.getElementById("password")
    if(tipo.type == 'password'){
        tipo.type = 'text';
    }else{
        tipo.type = 'password'
    }
}