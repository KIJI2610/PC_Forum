focusInput('name', 'label-name')
focusInput('email', 'label-email')
focusInput('password', 'label-password')
focusInput('password_confirmation', 'label-password_confirmation')

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

function clickDefaultTextLabel(label){
    const LABEL = document.getElementById(label)
    const VALUE = LABEL.textContent.trim()
    if(VALUE !== LABEL.getAttribute('data')){
        LABEL.textContent = LABEL.getAttribute('data')
    }
}
