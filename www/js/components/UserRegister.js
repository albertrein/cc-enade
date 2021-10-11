class UserRegister{
    constructor(selector, visibilidadeHandler){
        this.componentSelector = selector;
        this.visibilidade = false;
        this.visibilidadeHandler = visibilidadeHandler;
    }

    cadastrarUsuario(){
        let nome = document.getElementById('nome').value;
        let email = document.getElementById('email').value;
        let tipoAluno = document.getElementById('tipo_aluno');
        let tipoProfessor = document.getElementById('tipo_professor');

        if(this.validaCampos(nome, email, tipoAluno, tipoProfessor)){
            this.insereUsuario(nome, email, (tipoAluno.checked === true) ? 0:1);
            return true;
        }
        //mostra mensagem de erro
        return false;
    }

    validaCampos(nome, email, tipoAluno, tipoProfessor){
        if(tipoProfessor.checked == false && tipoAluno.checked == false){
            this.showErrorMensagemUsuarioCadastro();
            return false;
        }
        if(nome == "" || email == ""){
            this.showErrorMensagemUsuarioCadastro();
            return false;
        }
        return true;
    }

    validaCampoInput(elemento){
        if(elemento.value == ""){
            elemento.style.borderColor = 'red';
        }else{
            elemento.style.borderColor = '';
        }
    }

    usuarioReconhecido(nomeUsuario, emailUsuario, isProfessor){
        localStorage.setItem('nomeusuario', nomeUsuario);
        localStorage.setItem('emailusuario', emailUsuario);
        localStorage.setItem('isprofessor', isProfessor);
        this.visibilidadeHandler.usuarioLogado();
        return true;
    }

    insereUsuario(nome, email, isProfessor){
        let data = new FormData();
        data.append( "json", JSON.stringify({
            "nomeUsuario": nome,
            "emailUsuario": email,
            "isProfessor": isProfessor
        }));

        fetch('../src/Controller/NovoUsuario.php', {
            method: "POST",
            body: data
        }).then((response) => {
            if(response.status === 200){
                this.usuarioReconhecido(nome, email, isProfessor);
                this.hideErrorMensagemUsuarioCadastro();
            }else{
                this.showErrorMensagemUsuarioCadastro();
            }
        })
    }

    hide(){
        this.visibilidade = false;
        document.getElementById(this.componentSelector).style.display = 'none';
    }

    show(){
        this.visibilidade = true;
        document.getElementById(this.componentSelector).style.display = 'block';
    }

    hideErrorMensagemUsuarioCadastro(){
        document.getElementById('errorMensagemUsuarioCadastro').style.display = 'none';
    }

    showErrorMensagemUsuarioCadastro(){
        document.getElementById('errorMensagemUsuarioCadastro').style.display = 'block';
    }

}