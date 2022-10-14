    const montant=document.getElementById('montant')
    const mituelle=document.getElementById('mituelle')
    const avance=document.getElementById('avancement')
    const net=document.getElementById('net')

        document.getElementById('mituelle').addEventListener('focusout',(e)=>{
           if(parseFloat(avance.value)>=0){
            net.value=(parseFloat(montant.value)-parseFloat(mituelle.value)-parseFloat(avance.value))
           }
           else{
                avance.value=0
                net.value=(parseFloat(montant.value)-parseFloat(mituelle.value))
           }
        })







