const modalContainer=document.querySelector('.modal-container')
const modalTriggers=document.querySelectorAll('.modal-trigger')

modalTriggers.forEach(trigger =>trigger.addEventListener("click",(e)=>{
    e.preventDefault()
    modalContainer.classList.toggle("active")
}))


console.log("bonjour le monde");