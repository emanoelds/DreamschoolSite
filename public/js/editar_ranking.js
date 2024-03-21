//Perfil - Aluno
const inputFile = document.querySelector('#upload-foto-aluno');
const imagemAluno = document.querySelector('.prev-pic-aluno');
const faIcon = document.querySelector('.fa-camera');

inputFile.addEventListener('change', function(e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];
    const altura = "200";
    const largura = "200";

    if(file){
        console.log(file);
        const reader = new FileReader();
        reader.addEventListener('load', function(e){
            const readerTarget = e.target;
            const img = document.createElement('img');

            img.src = readerTarget.result;
            img.classList.add('picture-img');
            faIcon.classList = '';
            imagemAluno.appendChild(img);
        });
        
        reader.readAsDataURL(file);
    }    
});