const button= document.getElementById('whatsapp');
const whats_num =document.getElementById('whatsapp_number');
const whats_error =document.getElementById('whatsapp_number-error');
const whats_valid =document.getElementById('whatsapp_number-valid');


async function validate_whataApp(x){
    const apiKey='a78c973991mshb664f30c54a6746p14f373jsn279f5b8212ed'
    let initialres = await fetch('https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItWithToken',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'x-rapidapi-host':'whatsapp-number-validator3.p.rapidapi.com',
            'x-rapidapi-key':apiKey
        },
        body:JSON.stringify({
            'phone_number':x
        })
        
    });
    let res= await initialres.json();
    return res
    
}
function validateWhatsapp() {
        if (!whats_num.value.trim()) {
            whats_error.textContent = 'WhatsApp number is required';
            return false;
        }
        if (!/^\+[1-9]\d{7,14}$/.test(whats_num.value)) {
            whats_error.textContent = 'Please enter a valid WhatsApp number with country code';
            return false;
        }
        whats_error.textContent = '';
        return true;
    
    }
whats_num .addEventListener('input', function () {
    whats_valid.innerHTML = '';
});

button.addEventListener("click", async function () {
    button.innerHTML=`<i class="fa-solid fa-spinner fa-spin"></i>`
    const check_whasapp=validateWhatsapp();
    if(!check_whasapp) {
        button.innerHTML='Check WhatsApp Number'
        return;
    }
    let res= await validate_whataApp(whats_num.value.trim())
    if(res.status=='valid'){
        whats_valid.innerHTML='<i class="fa-solid fa-circle-check"></i> Valid WhatsApp Number'
        whats_error.innerHTML=''

    }
    else{
        whats_error.innerHTML='<i class="fa-solid fa-circle-xmark"></i> Invalid WhatsApp Number'
        whats_valid.innerHTML=''
    }
    button.innerHTML='Check WhatsApp Number'
});
