//Для кореектной работы стилей(focus) на инпутах
function focusInput(inp, label){
    const INP = document.getElementById(inp)
    const LABEL = document.getElementById(label)
    const VALUE = INP.value
    if(VALUE !== '' && VALUE !== null){
        LABEL.classList.add('focused')
    }
    else{
        LABEL.classList.remove('focused')
    }
}

