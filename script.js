function progress(){
    let progress = document.querySelector('.progress');
    let step     = 16;
    let loading  = setInterval(move, 50);

    function move(){
        if (step == 400) {
            clearInterval(loading);
            document.location = "auth/login.php";
        }else {
            step += 4;
            progress.style.width = step + 'px';
        }
    }
}

progress();