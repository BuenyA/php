const preisregler = document.querySelector('#regler')
const preisanzeige = document.querySelector('#preisanzeige')

preisregler.addEventListener('change',()=>{
    preisanzeige.value = preisregler.value
})
preisanzeige.addEventListener('change',()=>{
    preisregler.value = preisanzeige.value
})