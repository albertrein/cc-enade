class UserLogin{
    constructor(selector, visibilidadeHandler){
        this.componentSelector = selector;
        this.visibilidade = false;
        this.visibilidadeHandler = visibilidadeHandler;
    }
    loginButtonClick(){
        let email_login = document.getElementById('login_email').value;
        this.validaEmail(email_login);
    }

    validaEmail(emailUsuario){
        let data = new FormData();
        data.append( "json", JSON.stringify({
            "emailUsuario": emailUsuario
        }));

        fetch('../src/Controller/ValidaUsuario.php', {
            method: "POST",
            body: data
        }).then((response) => {
            if(response.ok){
                response.json().then(data => {
                    this.usuarioReconhecido(data.nome, emailUsuario, data.isprofessor, data.curso);
                });
            }else{
                this.loginErrorMessage();
            }
        })
    }

    usuarioReconhecido(nomeUsuario, emailUsuario, isProfessor, cursoDoUsuario){
        localStorage.setItem('nomeusuario', nomeUsuario);
        localStorage.setItem('emailusuario', emailUsuario);
        localStorage.setItem('isprofessor', isProfessor);
        localStorage.setItem('curso', cursoDoUsuario);
        this.visibilidadeHandler.usuarioLogado();
        
        return false;
    }

    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    show(){
        this.visibilidade = true;
        document.getElementById(this.componentSelector).style.display = 'block';
    }

    loginErrorMessage(){
        document.getElementById('login_email').style.borderColor = 'red';
        return false;
    }

    insereCursoPadrao(){
        localStorage.setItem('curso', 'cc');
    }
}